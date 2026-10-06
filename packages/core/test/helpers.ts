import type { Incident, ShiftReport } from "../src/index.js";

export const thresholds = { minConfidence: 0.7, maxShiftHours: 16 };

export function makeIncident(overrides: Partial<Incident> = {}): Incident {
  return {
    category: "alarm_response",
    reported_at: "2026-03-12T23:10",
    arrived_at: "2026-03-12T23:25",
    severity: "low",
    summary: "Inbraakalarm, geen sporen van braak aangetroffen.",
    involved_roles: ["guard"],
    ...overrides,
  };
}

export function makeReport(overrides: Partial<ShiftReport> = {}): ShiftReport {
  return {
    site_name: "Distributiecentrum Noord",
    site_address: "Industrieweg 12, Zwolle",
    client_name: "Logistiek BV",
    shift_start: "2026-03-12T22:00",
    shift_end: "2026-03-13T06:00",
    shift_type: "static_guarding",
    guard_refs: ["beveiliger_1"],
    summary: "Rustige nachtdienst met één alarmopvolging.",
    remarks: [],
    incidents: [makeIncident()],
    confidence: 0.9,
    uncertainties: [],
    ...overrides,
  };
}
