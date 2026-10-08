/**
 * Command line for setup and checks. Usage: pnpm --filter @veryo/outreach cli <command> [...]
 *
 *   doctor                       config, database, DNS and Notion in one overview
 *   dns-check [domain]           SPF, DKIM, DMARC and MX of the sending domain
 *   notion:setup                 create Veryo Leads + Afmeldlijst under NOTION_PARENT_PAGE_ID
 *   notion:verify                check that both Notion databases have the expected columns
 *   suppress <email|domain> [reason...]   add to the unsubscribe list (and sync to Notion)
 *   suppression:sync             merge the unsubscribe list between Notion and the database
 *   check-send <email> [--first] dry run of the send guard for one address
 */
import { Client } from "@notionhq/client";
import { createAudit } from "./audit.js";
import { describeConfig, loadConfig, type OutreachConfig } from "./config.js";
import { getState, openDb } from "./db.js";
import { domainOf } from "./email.js";
import { checkMailDns } from "./dns-check.js";
import { checkSend, SUPPRESSION_SYNCED_AT } from "./guard.js";
import { createLogger } from "./log.js";
import { NotionWorkspace } from "./notion/workspace.js";
import { addSuppression, listSuppressions } from "./suppression.js";
import { syncSuppressions } from "./suppression-sync.js";

const ICON = { ok: "✓", warn: "!", fail: "✗" } as const;

function notionFor(config: OutreachConfig): NotionWorkspace {
  if (!config.notion.token) throw new Error("NOTION_TOKEN ontbreekt");
  return new NotionWorkspace(new Client({ auth: config.notion.token }));
}

function requireIds(config: OutreachConfig) {
  const { leadsDataSourceId: leads, suppressionDataSourceId: suppression } = config.notion;
  if (!leads || !suppression) {
    throw new Error(
      "NOTION_LEADS_DATA_SOURCE_ID en NOTION_SUPPRESSION_DATA_SOURCE_ID zijn nodig (zie notion:setup)",
    );
  }
  return { leads, suppression };
}

async function dnsCheck(domain: string): Promise<boolean> {
  const findings = await checkMailDns(domain);
  console.log(`Mail-DNS voor ${domain}:`);
  for (const f of findings) console.log(`  ${ICON[f.level]} ${f.check.padEnd(5)} ${f.message}`);
  return findings.every((f) => f.level !== "fail");
}

async function main(argv: string[]): Promise<number> {
  const [command, ...args] = argv;
  const config = loadConfig();
  const log = createLogger();
  const db = openDb(config.dbPath);
  const audit = createAudit(db, log);

  switch (command) {
    case "doctor": {
      console.log("Configuratie:", JSON.stringify(describeConfig(config), null, 2));
      console.log(
        `Database: ${config.dbPath}, afmeldlijst ${listSuppressions(db).length} regels,`,
        `laatste sync ${getState(db, SUPPRESSION_SYNCED_AT) ?? "nooit"}`,
      );
      let ok = await dnsCheck(domainOf(config.sender.email));
      if (
        config.notion.token &&
        config.notion.leadsDataSourceId &&
        config.notion.suppressionDataSourceId
      ) {
        const problems = (await notionFor(config).verifyAll(requireIds(config))).flat();
        console.log(
          problems.length
            ? `Notion:\n  ✗ ${problems.join("\n  ✗ ")}`
            : "Notion: ✓ beide databases kloppen",
        );
        ok &&= problems.length === 0;
      } else {
        console.log("Notion: ! nog niet gekoppeld (NOTION_TOKEN / data source ids)");
        ok = false;
      }
      return ok ? 0 : 1;
    }
    case "dns-check":
      return (await dnsCheck(args[0] ?? domainOf(config.sender.email))) ? 0 : 1;
    case "notion:setup": {
      if (!config.notion.parentPageId) throw new Error("NOTION_PARENT_PAGE_ID ontbreekt");
      const ids = await notionFor(config).setup(config.notion.parentPageId);
      audit({ action: "notion.setup", outcome: "ok", details: ids });
      console.log(
        `Aangemaakt. Zet in .env:\nNOTION_LEADS_DATA_SOURCE_ID=${ids.leads}\nNOTION_SUPPRESSION_DATA_SOURCE_ID=${ids.suppression}`,
      );
      return 0;
    }
    case "notion:verify": {
      const problems = (await notionFor(config).verifyAll(requireIds(config))).flat();
      console.log(problems.length ? `✗ ${problems.join("\n✗ ")}` : "✓ beide databases kloppen");
      return problems.length ? 1 : 0;
    }
    case "suppress": {
      const [value, ...reason] = args;
      if (!value) throw new Error("Gebruik: suppress <email|domein> [reden]");
      const added = addSuppression(db, {
        value,
        reason: reason.join(" ") || undefined,
        source: "manual",
      });
      audit({
        action: "suppression.add",
        subject: value,
        outcome: added ? "ok" : "skipped",
        reason: added ? undefined : "stond er al op",
      });
      console.log(added ? `Toegevoegd: ${value}` : `Stond er al op: ${value}`);
      if (config.notion.token && config.notion.suppressionDataSourceId) {
        const r = await syncSuppressions(
          db,
          notionFor(config),
          config.notion.suppressionDataSourceId,
          audit,
        );
        console.log(`Notion gesynchroniseerd (${r.pushed} naar Notion, ${r.pulled} uit Notion).`);
      } else {
        console.log("Let op: Notion niet gekoppeld, alleen lokaal opgeslagen.");
      }
      return 0;
    }
    case "suppression:sync": {
      const r = await syncSuppressions(
        db,
        notionFor(config),
        requireIds(config).suppression,
        audit,
      );
      console.log(
        `✓ ${r.pulled} uit Notion, ${r.pushed} naar Notion` +
          (r.invalid.length ? `, ongeldig overgeslagen: ${r.invalid.join(", ")}` : ""),
      );
      return 0;
    }
    case "check-send": {
      const [to] = args;
      if (!to) throw new Error("Gebruik: check-send <email> [--first]");
      const result = checkSend(db, config, { to, isFirstContact: args.includes("--first") });
      console.log(
        result.allowed
          ? "✓ zou verstuurd mogen worden"
          : `✗ geblokkeerd:\n  - ${result.reasons.join("\n  - ")}`,
      );
      return result.allowed ? 0 : 1;
    }
    default:
      console.log(
        "Commando's: doctor, dns-check, notion:setup, notion:verify, suppress, suppression:sync, check-send",
      );
      return command ? 2 : 0;
  }
}

main(process.argv.slice(2)).then(
  (code) => process.exit(code),
  (error: unknown) => {
    console.error(error instanceof Error ? error.message : error);
    process.exit(1);
  },
);
