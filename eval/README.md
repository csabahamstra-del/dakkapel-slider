# /eval — extractiekwaliteit meten

Het harnas draait de extractie op voorbeeldrapporten en vergelijkt de uitkomst per veld met een
handmatig gecontroleerd gold-label.

## Werkwijze

1. Zet echte rapporten (`.pdf`, `.docx`, `.txt`) in `/samples` (staat in `.gitignore`).
2. Genereer conceptlabels met een sterker model (`EVAL_LABEL_MODEL`, standaard claude-opus-5-5):

       pnpm eval:label

   Dit schrijft per bestand `<bestand>.expected.json` met `"reviewed": false`.

3. Corrigeer elk concept en zet `"reviewed": true`. Let vooral op:
   - tijden (`YYYY-MM-DDTHH:mm`, lokale tijd; nachtdienst eindigt op de volgende dag)
   - categorie en ernst van elk incident
   - `expected_status`: moet dit document naar de controlebak (`needs_review`) of niet (`ok`)?
   - `pii_terms`: alle namen, kentekens en telefoonnummers uit de bron. De eval controleert dat
     geen ervan in de output terechtkomt.
   - `received_at` (optioneel): ontvangstmoment, zodat een ontbrekend jaar afgeleid kan worden.
4. Draai de eval:

       pnpm eval              # /samples
       pnpm eval -v           # met alle afwijkingen per veld
       pnpm eval --dir eval/fixtures
       pnpm eval --model claude-sonnet-5-5 --only nachtdienst

Resultaten komen in `eval/results/` (git-ignored, kan echte data bevatten).

## Wat wordt gemeten

| Veld                                          | Regel                                             |
| --------------------------------------------- | ------------------------------------------------- |
| `status`                                      | `ok`/`needs_review` gelijk aan het label          |
| `site_name`, `site_address`                   | gelijk na normalisatie, of de ene bevat de andere |
| `shift_start`, `shift_end`                    | binnen 15 minuten                                 |
| `incident_recall` / `incident_precision`      | incidenten gevonden / geen onterechte incidenten  |
| `incident_category`, `incident_severity`      | exact gelijk                                      |
| `incident_reported_at`, `incident_arrived_at` | binnen 5 minuten                                  |
| `no_pii_leak`                                 | geen enkele `pii_terms`-waarde in de output       |

Samenvattingen en bijzonderheden worden niet automatisch gescoord; die beoordeel je bij de review.
