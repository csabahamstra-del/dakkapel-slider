# Verwerkingsworker

Pakt taken uit de wachtrij (`processing_jobs`), haalt de originele mail en bijlagen uit Supabase
Storage, draait de extractie (`@veryo/core`) en slaat de resultaten op via
`complete_processing_job`. Draait als langlopend Node-proces op een EU-server; meerdere
instanties naast elkaar mogen (taken worden met `FOR UPDATE SKIP LOCKED` geclaimd).

## Gedrag

| Situatie                                      | Uitkomst                                                                                                 |
| --------------------------------------------- | -------------------------------------------------------------------------------------------------------- |
| Extractie gelukt, alles plausibel             | rapporten opgeslagen; tot objectmatching (2d) bestaat altijd `needs_review` met reden `site_not_matched` |
| Extractie twijfelachtig of mislukt            | rapporten (indien aanwezig) met `needs_review`; bericht in de controlebak                                |
| Fout bij opslag, API of database              | nieuwe poging na 1, 2, 4, 8 … minuten (max 60); na `max_attempts` (5) status `failed` → controlebak      |
| Worker crasht midden in een taak              | na 15 minuten pakt een andere worker de taak opnieuw op                                                  |
| Opnieuw verwerken (`requeue_inbound_message`) | vervangt alleen machine-resultaten; geweigerd als een mens de rapporten al reviewde                      |

Logs bevatten alleen id's, aantallen, tokens en foutmeldingen — nooit inhoud van rapporten.

## Draaien

    cp services/worker/.env.example services/worker/.env   # invullen
    docker build -f services/worker/Dockerfile -t veryo-worker .
    docker run --env-file services/worker/.env --restart unless-stopped veryo-worker

Lokaal zonder Docker: `pnpm --filter @veryo/worker start` (met de variabelen in de omgeving).
