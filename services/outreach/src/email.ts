/** Email address helpers. Only business addresses on the company's own domain are mailed. */

// Consumer and ISP mailboxes: never a business address in the sense of the outreach rules.
export const FREEMAIL_DOMAINS = new Set([
  "aol.com",
  "casema.nl",
  "chello.nl",
  "gmail.com",
  "gmx.com",
  "gmx.net",
  "googlemail.com",
  "hetnet.nl",
  "home.nl",
  "hotmail.com",
  "hotmail.nl",
  "icloud.com",
  "kpnmail.nl",
  "kpnplanet.nl",
  "live.com",
  "live.nl",
  "me.com",
  "msn.com",
  "online.nl",
  "outlook.com",
  "outlook.nl",
  "planet.nl",
  "proton.me",
  "protonmail.com",
  "quicknet.nl",
  "solcon.nl",
  "tele2.nl",
  "upcmail.nl",
  "xs4all.nl",
  "yahoo.com",
  "yahoo.nl",
  "zeelandnet.nl",
  "ziggo.nl",
]);

const EMAIL = /^[^\s@<>()",;:]+@([a-z0-9-]+\.)+[a-z]{2,}$/;
const DOMAIN = /^([a-z0-9-]+\.)+[a-z]{2,}$/;

export function normalizeEmail(input: string): string | undefined {
  const email = input.trim().toLowerCase();
  return EMAIL.test(email) ? email : undefined;
}

export function normalizeDomain(input: string): string | undefined {
  const domain = input
    .trim()
    .toLowerCase()
    .replace(/^https?:\/\//, "")
    .replace(/^www\./, "")
    .replace(/[/?#].*$/, "");
  return DOMAIN.test(domain) ? domain : undefined;
}

export function domainOf(email: string): string {
  return email.slice(email.lastIndexOf("@") + 1);
}

/** The domain itself and its parents down to the registrable level (sales.x.nl → x.nl). */
export function domainAndParents(domain: string): string[] {
  const labels = domain.split(".");
  const result: string[] = [];
  for (let i = 0; i <= labels.length - 2; i++) result.push(labels.slice(i).join("."));
  return result;
}

export function isFreemail(email: string): boolean {
  return FREEMAIL_DOMAINS.has(domainOf(email));
}
