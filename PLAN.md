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

---

# Plan v3 (zes pijlers, abonnementen, beweging)

**Uitgangspunt:** het bestaande thema (v2 + premium vormgeving) wordt uitgebreid, niet opnieuw gebouwd.

1. **Prijzen en catalogus** (`inc/quiz/catalog.php`): losse onderdelen werkplek (€1.495 / €2.495), veiligheidscheck (€995), agents; abonnementen Bijblijven €195, Werkplek-onderhoud €10/gebruiker (min. €99), Veilig blijven €149, Onderhoud €150–500; AI-partner €495 / €745 / €995 met 4 / 6 / 10 uur. Rekensom 195 + 100 + 149 = 444 automatisch berekend en getest.
2. **Pagina's**: `/ai-werkplek/`, `/ai-agents/`, `/veilig-ai-gebruik/`, `/ai-training/ai-strategie/`, `/ai-training/zzp/` nieuw; `/ai-op-maat/ai-agents/` vervalt (301 naar `/ai-agents/` als de oude pagina niet bestaat). Blok "Daarna doorlopend" op elke pakketpagina. "Geen IT-bedrijf" op /over-veryo/ en in de FAQ. Blogs 15–17. Homepage in de v3-volgorde.
3. **Menu, instellingen, schema**: mega-menu (Starten / Inrichten / Veilig en doorlopend); instellingen voor animaties, smooth scroll, WhatsApp-knop, klantlogo's, foto oprichter, achternaam; `UnitPriceSpecification` per abonnement.
4. **Beweging**: GSAP 3.15 + ScrollTrigger + SplitText en Lenis 1.3 lokaal in `assets/vendor/`, `assets/js/motion.js` (defer, alleen waar nodig). Alles zichtbaar zonder JS (`.has-motion` op `<html>` pas via JS); reduced motion en de instelling "Animaties" zetten alles uit; mobiel geen pinning.
5. **Testen**: zoals in de DoD, plus JS uit, reduced motion, 375px en screenshots tijdens het scrollen.

**Keuze bij [VUL IN] uit de opdracht:** de eigenaar wil geen zichtbare placeholders voor bezoekers. Daarom:
- het citaat van de oprichter komt uit zijn eigen woorden (eerder in het gesprek);
- fotoplekken tonen een rustig monogram tot er via *Instellingen > Veryo* een foto is gekozen;
- jaarkorting, open zzp-trainingen en opzegtermijn krijgen neutrale tekst zonder cijfer, en staan als open punt in de README.
