# Tools & koppelingen: registry

Alles staat op één plek: `veryo/inc/tools-registry.php`. De logostrook op de homepage, de "Werkt met"-blokken en de pagina `/tools-koppelingen/` lezen allemaal daaruit.

## Tool toevoegen

1. Zet een regel in `veryo_tools()` in de juiste categorie:
   ```php
   'lightspeed' => $t( 'Lightspeed', 'communicatie', __( 'Kassa en bestellingen gekoppeld aan jullie administratie.', 'veryo' ), 'https://www.lightspeedhq.nl' ),
   ```
   Velden: slug (sleutel), naam, categorie, omschrijving (één zin, jullie-vorm) en url (optioneel; opent in een nieuw tabblad met `rel="noopener nofollow"`).
2. Logo (optioneel): zet `veryo/assets/logos/lightspeed.svg` neer (bestandsnaam = slug). Zonder logo verschijnt automatisch een tekstbadge met de naam.
3. Klaar: de tool staat direct op `/tools-koppelingen/`, in de juiste categorie en filter.

## Tool verwijderen

Haal de regel weg uit `veryo_tools()`. Overal waar de tool stond (homepage, "Werkt met"-blokken, overzicht), valt hij vanzelf weg. Het logobestand mag blijven staan of weg.

## Waar de logo's verschijnen

- **Homepage-strook:** `veryo_tools_strip_rows()`, twee rijen met slugs.
- **"Werkt met" per pagina:** `veryo_page_tools()`, met per pad een korte omschrijving en de slugs. Bij een update krijgen alleen pagina's die je niet zelf hebt aangepast het blok automatisch.
- **Zelf ergens plaatsen:** shortcode in een shortcodeblok, bijvoorbeeld `[veryo_werkt_met tools="claude,make,snelstart"]`.

## Categorieën en filters

`veryo_tool_categories()` bepaalt de koppen (H2) op de toolspagina en bij welke filterknop een categorie hoort. De knoppen staan in `veryo_tool_filters()`.
