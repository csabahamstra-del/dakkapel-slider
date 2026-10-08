/** Checks the sending domain's SPF, DKIM, DMARC and MX records. */
import { promises as dns } from "node:dns";

export interface Resolver {
  resolveTxt(name: string): Promise<string[][]>;
  resolveMx(name: string): Promise<{ exchange: string; priority: number }[]>;
}

export type Level = "ok" | "warn" | "fail";
export interface DnsFinding {
  check: "MX" | "SPF" | "DKIM" | "DMARC";
  level: Level;
  message: string;
}

// Selectors used by common providers; "x" is DirectAdmin (mijn.host).
export const DEFAULT_DKIM_SELECTORS = [
  "x",
  "default",
  "mail",
  "dkim",
  "google",
  "selector1",
  "selector2",
  "k1",
  "s1",
];

async function txt(resolver: Resolver, name: string): Promise<string[]> {
  try {
    return (await resolver.resolveTxt(name)).map((chunks) => chunks.join(""));
  } catch (error) {
    const code = (error as { code?: string }).code;
    if (code === "ENOTFOUND" || code === "ENODATA") return [];
    throw error;
  }
}

export async function checkMailDns(
  domain: string,
  resolver: Resolver = dns,
  dkimSelectors: string[] = DEFAULT_DKIM_SELECTORS,
): Promise<DnsFinding[]> {
  const findings: DnsFinding[] = [];

  const mx = await resolver.resolveMx(domain).catch(() => []);
  findings.push(
    mx.length
      ? { check: "MX", level: "ok", message: mx.map((m) => m.exchange).join(", ") }
      : { check: "MX", level: "fail", message: "geen MX-records" },
  );

  const spf = (await txt(resolver, domain)).filter((r) => r.toLowerCase().startsWith("v=spf1"));
  if (spf.length === 0) {
    findings.push({ check: "SPF", level: "fail", message: "geen SPF-record" });
  } else if (spf.length > 1) {
    findings.push({ check: "SPF", level: "fail", message: "meerdere SPF-records (ongeldig)" });
  } else if (/[+?]all\b/.test(spf[0]!) || !/[~-]all\b/.test(spf[0]!)) {
    findings.push({
      check: "SPF",
      level: "warn",
      message: `eindigt niet op ~all of -all: ${spf[0]}`,
    });
  } else {
    findings.push({ check: "SPF", level: "ok", message: spf[0]! });
  }

  const found: string[] = [];
  for (const selector of dkimSelectors) {
    const records = await txt(resolver, `${selector}._domainkey.${domain}`);
    if (records.some((r) => /v=DKIM1|k=rsa|p=/.test(r))) found.push(selector);
  }
  findings.push(
    found.length
      ? {
          check: "DKIM",
          level: "ok",
          message: `sleutel gevonden voor selector ${found.join(", ")} (controleer in een verzonden mail dat er ook mee getekend wordt)`,
        }
      : {
          check: "DKIM",
          level: "warn",
          message: `geen sleutel gevonden voor de bekende selectors (${dkimSelectors.join(", ")})`,
        },
  );

  const dmarc = (await txt(resolver, `_dmarc.${domain}`)).filter((r) =>
    r.toLowerCase().startsWith("v=dmarc1"),
  );
  if (dmarc.length !== 1) {
    findings.push({
      check: "DMARC",
      level: "fail",
      message:
        dmarc.length === 0
          ? `geen DMARC-record; voeg toe: _dmarc.${domain} TXT "v=DMARC1; p=none; rua=mailto:dmarc@${domain}"`
          : "meerdere DMARC-records (ongeldig)",
    });
  } else {
    const policy = /\bp=(\w+)/i.exec(dmarc[0]!)?.[1]?.toLowerCase();
    findings.push({
      check: "DMARC",
      level: policy ? "ok" : "fail",
      message: policy ? `beleid p=${policy}: ${dmarc[0]}` : `geen p= in record: ${dmarc[0]}`,
    });
  }

  return findings;
}
