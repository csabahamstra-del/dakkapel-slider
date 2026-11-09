# Redirects (301)

Het thema voert deze redirects zelf uit (`veryo_redirects()` in `veryo/inc/seo-extra.php`, uitbreidbaar met het filter `veryo_redirects`). De oude pagina's staan na de update op **concept**; je kunt ze na een paar maanden in de prullenbak gooien. De redirect blijft werken, want die zit in het thema.

| Oude URL | Nieuwe URL | Reden |
|---|---|---|
| `/ai-op-maat/interne-assistent/` | `/veryo-collega/` | Zelfde onderwerp als Veryo Collega (kannibalisatie op "interne AI-assistent") |
| `/ai-automatisering/kennis-en-documenten/` | `/veryo-collega/` | Zelfde onderwerp als Veryo Collega (kennisbank op eigen documenten) |

Automatisch geregeld door het thema:

- **Bijlagepagina's** gaan met een 301 naar de pagina of het bericht waar de bijlage bij hoort, anders naar het bestand zelf.

Niet als redirect, wel als noindex, follow (pagina blijft bereikbaar voor bezoekers):

- `/ai-automatisering/marketing/`
- `/bedankt/`, `/cookieverklaring/`, `/algemene-voorwaarden/` (tot ze juridisch zijn gecontroleerd), de landingspagina's
- zoekresultaten, auteur-, tag- en datumarchieven en lege categorieën

## Rank Math

Rank Math heeft een eigen redirectmodule. Zet deze twee redirects daar **niet** nog een keer in; dubbel kan een redirect-lus geven. Wil je ze toch liever in Rank Math beheren, haal ze dan uit het thema met:

```php
add_filter( 'veryo_redirects', '__return_empty_array' );
```

## Controle na livegang

```
curl -I https://veryo.nl/ai-op-maat/interne-assistent/
curl -I https://veryo.nl/ai-automatisering/kennis-en-documenten/
```

Beide moeten `301` geven met `Location: https://veryo.nl/veryo-collega/`.
