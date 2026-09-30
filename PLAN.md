# Plan: Veryo WordPress-thema

Doel: één installeerbare `veryo.zip` (map `veryo/` in de root) die na activatie een complete site klaarzet: pagina's, menu's, AI-scan, leads, SEO-basis.

## Repo-indeling

```
veryo/            het thema (bron van de zip)
tools/            build- en testscripts (komen niet in de zip)
veryo.zip         opgeleverd thema
PLAN.md           dit plan
```

## Bestandsstructuur thema

```
veryo/
  style.css, theme.json, functions.php (alleen includes), screenshot.png
  index.php, front-page.php, page.php, single.php, archive.php, search.php, 404.php
  header.php, footer.php
  template-parts/   page-header, breadcrumbs, card (berichten), cases
  inc/setup.php     theme supports, menu-locaties, assets, preload fonts, block-stijlen, pattern-categorie
  inc/helpers.php   instellingen-getter, logo, iconen, bedrijfsgegevens
  inc/nav.php       walker voor toegankelijk dropdownmenu en footerkolommen
  inc/activation.php idempotente setup (pagina's, menu's, blog-concepten, permalinks, site-icoon, notice)
  inc/content/      blocks.php (block-markup helpers), sections.php (terugkerende secties),
                    pages-*.php (inhoud + SEO per pagina), posts-blog.php (concepten)
  inc/seo.php       metabox, title/meta/canonical/robots/OG, JSON-LD @graph, breadcrumbs,
                    sitemap-uitsluitingen, robots.txt, /llms.txt, Yoast/Rank Math-detectie
  inc/quiz/         catalog.php, scoring.php, rest.php, report.php (Anthropic + fallback),
                    mail.php, leads.php (CPT + admin), privacy.php, forms.php, shortcodes.php
  inc/admin/        settings.php (Instellingen > Veryo), tools.php (Extra > Veryo-inhoud)
  patterns/         hero, cta-scan, diensten, prijsladder, faq, stappenplan, branches, regio
  assets/css/main.css, assets/css/editor.css, assets/js/{nav,scan,forms,admin}.js
  assets/fonts, assets/logo, assets/images (og-default, icon-512)
  README-INSTALL.md
```

## Bouwvolgorde

1. Fundament: style.css, theme.json v3 (palet, fonts self-hosted, spacing), setup, templates, header/footer, CSS.
2. Block-markup helpers en secties (dezelfde code voedt patterns én paginainhoud, zodat alles in de editor aanpasbaar is).
3. Dienstencatalogus (`inc/quiz/catalog.php`) als bron voor dienstpagina's én AI-scan.
4. Inhoud: alle pagina's uit §5 (unieke teksten, FAQ, interne links), juridische concepten, blogconcepten.
5. Activatie-routine (idempotent) + Extra-knop + admin-notice met `[VUL IN]`-lijst.
6. SEO-laag.
7. AI-scan: REST, berekening, leads, rapport (API + fallback), e-mails, cron, privacy, admin-lijst, exports.
8. Instellingenpagina + testknoppen.
9. JavaScript: menu, quiz, formulieren.

## Testaanpak

- WordPress 6.9 lokaal op SQLite (Composer + SQLite-integratie, WP-CLI), `WP_DEBUG_LOG` aan.
- `php -l` op alle bestanden, PHPCS (WordPress-standaard) voor security/escaping.
- Script dat alle pagina's afloopt (URL, parent, SEO-title ≤ 60, description 140–155, woordenaantal).
- Twee keer activeren → geen dubbele pagina's/menu's.
- Quiz end-to-end via REST: zonder sleutel, met ongeldige sleutel, rate limit; mails onderscheppen via `pre_wp_mail` in een test-mu-plugin.
- Payload-test: geen naam/bedrijf/e-mail/telefoon in de API-payload.
- HTML-validatie (html-validate), JSON-LD parsen, check op externe URL's.
- Lighthouse mobiel (Chromium via Playwright) op home, /ai-automatisering/, /waar-begin-ik-met-ai/.
- screenshot.png via Playwright; zip bouwen met `tools/build.sh`.
