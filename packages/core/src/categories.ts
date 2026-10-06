/**
 * Default incident categories. Codes are stable identifiers stored in the database;
 * labels are the Dutch texts shown in reports and the dashboard.
 * Per-organization configurable categories follow in phase 2 (`incident_categories`).
 */
export const DEFAULT_INCIDENT_CATEGORIES = [
  { code: "burglary", label: "Inbraak / insluiping" },
  { code: "alarm_response", label: "Alarmopvolging" },
  { code: "fire", label: "Brand / brandalarm" },
  { code: "vandalism", label: "Vandalisme" },
  { code: "nuisance", label: "Overlast" },
  { code: "suspicious_situation", label: "Verdachte situatie" },
  { code: "medical", label: "Medisch" },
  { code: "technical_failure", label: "Technische storing" },
  { code: "open_door_window", label: "Open deur / raam" },
  { code: "other", label: "Overig" },
] as const;

export type IncidentCategoryCode = (typeof DEFAULT_INCIDENT_CATEGORIES)[number]["code"];

export const INCIDENT_CATEGORY_CODES = DEFAULT_INCIDENT_CATEGORIES.map((c) => c.code) as [
  IncidentCategoryCode,
  ...IncidentCategoryCode[],
];

export const SHIFT_TYPES = [
  { code: "static_guarding", label: "Objectbeveiliging" },
  { code: "mobile_patrol", label: "Mobiele surveillance" },
  { code: "alarm_response", label: "Alarmopvolging" },
  { code: "event", label: "Evenementenbeveiliging" },
  { code: "reception", label: "Receptie / host(ess)" },
  { code: "other", label: "Overig" },
] as const;

export type ShiftTypeCode = (typeof SHIFT_TYPES)[number]["code"];

export const SHIFT_TYPE_CODES = SHIFT_TYPES.map((s) => s.code) as [
  ShiftTypeCode,
  ...ShiftTypeCode[],
];

/** Roles that replace person names in extracted text (hard rule 6). */
export const PERSON_ROLES = [
  { code: "reporter", label: "melder" },
  { code: "suspect", label: "verdachte" },
  { code: "guard", label: "beveiliger" },
  { code: "client_employee", label: "medewerker klant" },
  { code: "police", label: "politie" },
  { code: "fire_department", label: "brandweer" },
  { code: "ambulance", label: "ambulance" },
  { code: "other", label: "overig" },
] as const;

export type PersonRoleCode = (typeof PERSON_ROLES)[number]["code"];

export const PERSON_ROLE_CODES = PERSON_ROLES.map((r) => r.code) as [
  PersonRoleCode,
  ...PersonRoleCode[],
];

export const SEVERITIES = ["low", "medium", "high"] as const;
export type Severity = (typeof SEVERITIES)[number];
