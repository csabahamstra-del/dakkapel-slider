# Inventaris: verwijzingen naar trainingen (19 november 2026)

Zoektermen: training, trainingen, workshop, cursus, basiscursus, in-company, opleiding, leren (los woord), masterclass, module, lanceerprijs, academy. Alleen thema-code (`veryo/`); de GSAP-bibliotheken zijn overgeslagen (vals positief op "module"). Regelnummers in branch `claude/veryo-wordpress-theme-016jd1`, commit 6874a6f.

Totaal: 471 regels in 36 bestanden.

| Voorstel | Aantal |
|---|---|
| Weghalen | 258 |
| Herschrijven | 154 |
| Weghalen of omleggen | 45 |
| Vraag | 8 |
| Laten staan / gelijktrekken | 5 |
| Laten staan | 1 |

## 404.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 19 | — | Weghalen of omleggen — link naar vervallen pagina | <li><a href="<?php echo esc_url( veryo_url( 'ai-training' ) ); ?>"><?php esc_html_e( 'AI-trainingen en workshops', 'very |

## archive-kennis.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 14 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | <p class="veryo-lead kennis-archive__intro"><?php esc_html_e( 'Praktische kennis over AI voor het mkb: heldere uitleg, s |

## assets/js/forms.js

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 1 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | /* Veryo: contactformulier en Academy-wachtlijst. */ |

## inc/activation.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 512 | — | Weghalen — menu-item/upgrade naar vervallen pagina | __( 'AI-trainingen', 'veryo' ), |
| 513 | — | Weghalen — menu-item/upgrade naar vervallen pagina | 'ai-training', |
| 515 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-training voor bedrijven', 'veryo' ), 'ai-training' ), |
| 516 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-workshop voor bedrijven', 'veryo' ), 'ai-workshop' ), |
| 517 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-geletterdheid (AI Act)', 'veryo' ), 'ai-training/ai-geletterdheid' ), |
| 518 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'ChatGPT-training voor verkopers', 'veryo' ), 'ai-training/chatgpt-training-verkopers' ), |
| 519 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-strategie voor directie en MT', 'veryo' ), 'ai-training/ai-strategie' ), |
| 520 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-training voor zzp’ers', 'veryo' ), 'ai-training/zzp' ), |
| 521 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'Veryo Academy (online)', 'veryo' ), 'academy' ), |
| 573 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-training', 'veryo' ), 'ai-training' ), |
| 574 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-workshop', 'veryo' ), 'ai-workshop' ), |
| 575 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'ChatGPT-training verkopers', 'veryo' ), 'ai-training/chatgpt-training-verkopers' ), |
| 576 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'AI-geletterdheid', 'veryo' ), 'ai-training/ai-geletterdheid' ), |
| 579 | — | Weghalen — menu-item/upgrade naar vervallen pagina | array( __( 'Veryo Academy', 'veryo' ), 'academy' ), |
| 1081 | — | Herschrijven | return array( '', 'ai-automatisering/offertes-en-calculaties', 'oplossingen/ai-calculatie-offerte-factuur', 'ai-automati |
| 1092 | — | Herschrijven — vervangtabel AI-geletterdheid (oude upgrade, alleen tekst) | 'De training is een concrete stap om te zorgen voor voldoende AI-geletterdheid, zoals artikel 4 van de AI Act vraagt.' = |
| 1093 | — | Herschrijven — vervangtabel AI-geletterdheid (oude upgrade, alleen tekst) | 'De workshop is een concrete stap om te zorgen voor voldoende AI-geletterdheid, zoals artikel 4 van de AI Act vraagt.' = |
| 1095 | — | Herschrijven — vervangtabel AI-geletterdheid (oude upgrade, alleen tekst) | 'Wel verplicht de AI Act sinds 2 februari 2025 organisaties die AI inzetten om te zorgen voor voldoende AI-geletterdheid |
| 1138 | — | Herschrijven | // 2. /academy/ op noindex, follow (ook in Rank Math). |
| 1139 | — | Weghalen — menu-item/upgrade naar vervallen pagina | $academy = veryo_find_page( 'academy' ); |
| 1140 | — | Weghalen — menu-item/upgrade naar vervallen pagina | if ( $academy && isset( $defs['academy'] ) ) { |
| 1141 | — | Weghalen — menu-item/upgrade naar vervallen pagina | veryo_apply_page_meta( $academy->ID, $defs['academy'] ); |

## inc/admin/settings.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 96 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | 'academy_waitlist' => array( 'checkbox', __( 'Toon Academy als "binnenkort/wachtlijst"', 'veryo' ), __( 'De Academy-pagi |

## inc/admin/tools.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 201 | — | Weghalen of omleggen — link naar vervallen pagina | return array( 'ai-automatisering', 'ai-training', 'ai-implementatie-mkb', 'ai-agents', 'ai-training/ai-geletterdheid', ' |

## inc/blog.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 37 | — | Weghalen of omleggen — link naar vervallen pagina | 'posts' => array( 'wat-kost-ai-automatisering', 'wat-kost-een-ai-chatbot', 'slim-subsidie-ai-training', 'wbso-voor-ai-pr |

## inc/collega-config.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 74 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'training' => array( |
| 75 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'label' => __( 'Training team', 'veryo' ), |

## inc/content/collega.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 737 | — | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-workshops en trainingen', 'veryo' ), __( 'Zo werken jullie collega’s er goed mee', 'veryo' |
| 739 | — | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Zo haal je er het meeste uit', 'veryo' ) ), |

## inc/content/pages-automatisering.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 244 | ai-automatisering/werkprocessen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Moeten de monteurs een nieuwe app leren?', 'veryo' ), __( 'Liefst niet. Als jullie al een werkbon- of planni |
| 313 | ai-automatisering/marketing | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Training en automatisering', 'veryo' ) ), |

## inc/content/pages-branches.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 26 | branches/installatie | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo installatiebedrijven', 'veryo' ), __( 'Monteurs en binnendienst vragen hun eigen ke |
| 86 | branches/installatie | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'price' => array( 'steps' => array( 'startpakket', 'training', 'quickwin', 'project', 'maatwerk' ) ), |
| 92 | branches/installatie | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is een training voor ons team ook mogelijk?', 'veryo' ), __( 'Ja. Vraag een gratis offerte aan.', 'veryo' )  |
| 119 | branches/bouw | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo bouwbedrijven', 'veryo' ), __( 'Bestekken, eerdere calculaties en projectdossiers o |
| 188 | branches/bouw | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Kunnen uitvoerders dit zonder training?', 'veryo' ), __( 'Inspreken en fotograferen kan iedereen. We geven e |
| 216 | branches/agri | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo agrarische bedrijven', 'veryo' ), __( 'De kennis van ervaren monteurs en de handlei |
| 257 | branches/agri | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Op locatie, met voorbeelden uit de agri', 'veryo'  |
| 279 | branches/makelaardij | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo makelaarskantoren', 'veryo' ), __( 'Woningdossiers, procedures en eerdere vragen va |
| 380 | branches/zakelijke-dienstverlening | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo accountants en adviesbureaus', 'veryo' ), __( 'Dossiers, procedures en vakkennis do |
| 417 | branches/zakelijke-dienstverlening | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'price' => array( 'steps' => array( 'startpakket', 'training', 'quickwin', 'maatwerk' ) ), |
| 422 | branches/zakelijke-dienstverlening | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is een AI-training voor ons kantoor zinvol?', 'veryo' ), __( 'Vaak de beste eerste stap. Het team leert veil |
| 427 | branches/zakelijke-dienstverlening | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training', 'veryo' ), __( 'Voor het hele kantoor', 'veryo' ) ), |
| 438 | branches/horeca-retail | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Wat AI doet in horeca en retail: reserveringen, roosters, teamtraining en kennis die blijft. Met voorbeel |
| 448 | branches/horeca-retail | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo horeca en retail', 'veryo' ), __( 'Recepten, procedures en afspraken doorzoekbaar v |
| 449 | branches/horeca-retail | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'extra' => array( __( 'Waar je begint', 'veryo' ), array( __( 'De meeste horecazaken beginnen met een korte AI-workshop  |
| 490 | branches/horeca-retail | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor je team', 'veryo' ), __( 'Praktisch, op locatie', 'veryo' ) ), |
| 511 | branches/transport | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo transportbedrijven', 'veryo' ), __( 'Afspraken met klanten, routes en procedures do |
| 607 | branches/recruitment | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo werving en recruitment', 'veryo' ), __( 'Kennis over functies, vacatures en kandida |
| 675 | branches/schoonmaak | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo schoonmaakbedrijven', 'veryo' ), __( 'Werkinstructies, objectafspraken en procedure |
| 740 | branches/beveiliging | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'help' => array( __( 'Zo helpt Veryo beveiligingsbedrijven', 'veryo' ), __( 'Procedures, objectinstructies en afspraken  |

## inc/content/pages-legal.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 37 | $veryo_privacy | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Om u te informeren als de Veryo Academy beschikbaar is, als u zich op de wachtlijst heeft gezet.', 'veryo' ), |
| 110 | $veryo_terms | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( '<strong>Diensten</strong>: trainingen, kansensessies, automatiseringen, AI op maat, onderhoud en abonnementen.', 'v |
| 132 | $veryo_terms | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Opdrachtgever blijft eigenaar van zijn gegevens. Automatiseringen in accounts van opdrachtgever worden na vo |
| 179 | algemene-voorwaarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Algemene voorwaarden van Veryo voor trainingen, automatiseringen, AI op maat en abonnementen: offertes, u |

## inc/content/pages-main.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 16 | $veryo_home_faq | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Moeten wij zelf technisch zijn?', 'veryo' ), __( 'Nee. Wij adviseren, richten in en koppelen. Jij en je team |
| 17 | $veryo_home_faq | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Wat is de AI-geletterdheidsplicht?', 'veryo' ), __( 'Artikel 4 van de Europese AI Act geldt sinds 2 februari |
| 18 | $veryo_home_faq | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Werken jullie ook buiten Noord-Nederland?', 'veryo' ), __( 'Ja. We zitten in Leeuwarden en komen in Frieslan |
| 128 | $veryo_home | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Van advies tot partner.', 'veryo' ) . '</strong> ' . __( 'Advies, training, invoering en een vaste vra |
| 221 | $veryo_scan | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Als je eerst zelf wilt snappen hoe het werkt', ' |
| 371 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'AI implementeren in het mkb is meer dan een tool aanzetten: het is een traject van inventarisatie, prio |
| 389 | $veryo_impl | Laten staan / gelijktrekken — "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( '5. Training.', 'veryo' ) . '</strong> ' . __( 'Collega’s leren ermee werken en weten wat wel en niet m |
| 413 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Een training voor het team en een deelnameoverzicht.', 'veryo' ), |
| 426 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Week 5–6:', 'veryo' ) . '</strong> ' . __( 'training en uitrol naar het team.', 'veryo' ), |
| 443 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'p' => __( 'Dat hangt af van het aantal toepassingen, de systemen die gekoppeld moeten worden en hoeveel training en beg |
| 457 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Kansensessie, training en beleid in één', 'veryo' ) ) |
| 459 | $veryo_impl | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Zodat je team ermee kan werken', 'veryo' ) ), |
| 461 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'leeuwarden', __( 'AI in Leeuwarden', 'veryo' ), __( 'Training en advies vanuit Leeuwarden', 'veryo' ) ), |
| 467 | $veryo_impl | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | * AI-training |
| 469 | $veryo_training | Weghalen — pagina vervalt (301) | $veryo_training = veryo_page_standard( |
| 471 | $veryo_training | Weghalen — pagina vervalt (301) | 'answer_cta' => array( __( 'Vraag een training aan', 'veryo' ), '#vraag', 'amber' ), |
| 473 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'Vraag een training aan', 'veryo' ), |
| 475 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'Bijvoorbeeld: training voor 10 mensen op kantoor, de meesten hebben nog nooit ChatGPT gebruikt.', 'veryo' ), |
| 477 | $veryo_training | Weghalen — pagina vervalt (301) | 'answer' => __( 'Veryo geeft AI-training voor bedrijven: een praktische incompany training of AI-workshop voor teams tot |
| 479 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Waarom een AI-training voor jullie team?', 'veryo' ), |
| 482 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'Een goede AI-training haalt iedereen op hetzelfde niveau. Niet met theorie over neurale netwerken, maar met de vraa |
| 485 | $veryo_training | Weghalen — pagina vervalt (301) | 'photo' => array( __( 'team van een mkb-bedrijf rond een tafel met laptops tijdens een workshop', 'veryo' ), __( 'AI-tra |
| 488 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Voor wie is de training bedoeld?', 'veryo' ), |
| 512 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'We stemmen de training af op de tools die jullie gebruiken of willen gaan gebruiken. Werken jullie in Microsoft 365 |
| 516 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Incompany AI-workshop: programma en opzet', 'veryo' ), |
| 519 | $veryo_training | Weghalen — pagina vervalt (301) | /* translators: %s: link naar de AI-workshop. */ |
| 520 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'Een <a href="%s">AI-workshop voor bedrijven</a> is de compacte vorm: een dagdeel waarin jullie team direct aan de s |
| 521 | $veryo_training | Weghalen — pagina vervalt (301) | esc_url( veryo_link( 'ai-workshop' ) ) |
| 533 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Welke training past bij jullie team?', 'veryo' ), |
| 535 | $veryo_training | Weghalen — pagina vervalt (301) | '<a href="' . esc_url( veryo_link( 'ai-workshop' ) ) . '">' . esc_html__( 'AI-workshop voor bedrijven', 'veryo' ) . '</a |
| 536 | $veryo_training | Weghalen — pagina vervalt (301) | '<a href="' . esc_url( veryo_link( 'ai-training/ai-geletterdheid' ) ) . '">' . esc_html__( 'AI-geletterdheid training',  |
| 537 | $veryo_training | Weghalen — pagina vervalt (301) | '<a href="' . esc_url( veryo_link( 'ai-training/chatgpt-training-verkopers' ) ) . '">' . esc_html__( 'ChatGPT-training v |
| 538 | $veryo_training | Weghalen — pagina vervalt (301) | '<a href="' . esc_url( veryo_link( 'ai-training/ai-strategie' ) ) . '">' . esc_html__( 'AI-strategie training', 'veryo'  |
| 547 | $veryo_training | Weghalen — pagina vervalt (301) | __( 'Artikel 4 van de Europese AI Act geldt sinds 2 februari 2025. Sinds de wijziging door de Digital Omnibus op 27 juli |
| 548 | $veryo_training | Weghalen — pagina vervalt (301) | esc_url( veryo_link( 'ai-training/ai-geletterdheid' ) ) |
| 553 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Na de training', 'veryo' ), |
| 559 | $veryo_training | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat kost een zakelijke AI-training?', 'veryo' ), |
| 560 | $veryo_training | Weghalen — pagina vervalt (301) | 'steps' => array( 'startpakket', 'training', 'academy' ), |
| 564 | $veryo_training | Weghalen — pagina vervalt (301) | array( __( 'Voor wie is de AI-training bedoeld?', 'veryo' ), __( 'Voor iedereen in jullie bedrijf die met AI werkt of ga |
| 566 | $veryo_training | Weghalen — pagina vervalt (301) | array( __( 'Wat is het verschil tussen een AI-training en een AI-workshop?', 'veryo' ), __( 'Een workshop is een dagdeel |
| 567 | $veryo_training | Weghalen — pagina vervalt (301) | array( __( 'Voldoen we na de training aan de AI-geletterdheidsplicht?', 'veryo' ), __( 'De training is een concrete maat |
| 568 | $veryo_training | Weghalen — pagina vervalt (301) | array( __( 'Kunnen we de training online volgen?', 'veryo' ), __( 'Ja. Op locatie werkt meestal beter voor de interactie |
| 569 | $veryo_training | Weghalen — pagina vervalt (301) | array( __( 'Wat gebeurt er nadat we een training aanvragen?', 'veryo' ), __( 'Binnen één werkdag nemen we contact op. We |
| 572 | $veryo_training | Weghalen — pagina vervalt (301) | 'cta' => array( __( 'Een AI-training voor jullie team?', 'veryo' ), __( 'Plan een gratis kennismaking. We bespreken waar |
| 574 | $veryo_training | Weghalen — pagina vervalt (301) | array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Specifiek voor de AI Act', 'very |
| 575 | $veryo_training | Weghalen — pagina vervalt (301) | array( 'ai-workshop', __( 'AI-workshop voor bedrijven', 'veryo' ), __( 'De basis in een dagdeel', 'veryo' ) ), |
| 576 | $veryo_training | Weghalen — pagina vervalt (301) | array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Training, beleid en een eerste toepassing', 'veryo' ) |
| 577 | $veryo_training | Weghalen — pagina vervalt (301) | array( 'contact', __( 'Contact', 'veryo' ), __( 'Vraag een training aan', 'veryo' ) ), |
| 590 | $veryo_literacy | Weghalen — pagina vervalt (301) | __( 'Bijvoorbeeld: moeten ook onze buitendienstmensen een training volgen?', 'veryo' ), |
| 592 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'answer_cta' => array( __( 'Vraag de training aan', 'veryo' ), '#vraag', 'amber' ), |
| 593 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'answer' => __( 'De AI-geletterdheid training van Veryo helpt jullie aantoonbaar werk te maken van artikel 4 van de AI A |
| 601 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'photo' => array( __( 'trainer legt aan een kleine groep uit hoe je AI-antwoorden controleert', 'veryo' ), __( 'AI-gelet |
| 604 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'h' => __( 'Voor wie is de training?', 'veryo' ), |
| 613 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat de AI-geletterdheid training behandelt', 'veryo' ), |
| 625 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'h' => __( 'AI Act training voor medewerkers, zonder bangmakerij', 'veryo' ), |
| 627 | $veryo_literacy | Weghalen — pagina vervalt (301) | __( 'We houden het nuchter. De AI Act is geen reden om AI te laten liggen, maar wel een goede aanleiding om het goed te  |
| 628 | $veryo_literacy | Weghalen — pagina vervalt (301) | __( 'Je krijgt een deelnameoverzicht, de trainingsinhoud en een opzet voor een AI-beleid. Daarmee kun je laten zien welk |
| 633 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'p' => array( __( 'Na de training krijgen jullie een deelnameoverzicht met namen, datum, duur en de behandelde onderwerp |
| 636 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat de training wel en niet garandeert', 'veryo' ), |
| 652 | $veryo_literacy | Weghalen — pagina vervalt (301) | __( 'Kun je laten zien welke training of uitleg medewerkers hebben gehad?', 'veryo' ), |
| 657 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'steps' => array( 'startpakket', 'training', 'academy' ), |
| 658 | $veryo_literacy | Weghalen — pagina vervalt (301) | 'p' => __( 'Mogelijk is er subsidie via de SLIM-regeling voor trainingen; openstellingsperiodes en voorwaarden wisselen, |
| 664 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( __( 'Hoe vaak moet de training herhaald worden?', 'veryo' ), __( 'De wet noemt geen termijn. Omdat AI-tools snel  |
| 665 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( __( 'Kunnen jullie ook een AI-beleid opstellen?', 'veryo' ), __( 'We leveren een opzet die je in de training met  |
| 668 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Training plus AI-beleid op maat', 'veryo' ) ), |
| 669 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alle trainingsvormen', 'veryo' ) ), |
| 670 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( 'academy', __( 'Online AI-cursus', 'veryo' ), __( 'Voor nieuwe medewerkers, binnenkort', 'veryo' ) ), |
| 671 | $veryo_literacy | Weghalen — pagina vervalt (301) | array( 'ai-adviseur-drenthe', __( 'AI-adviseur in Drenthe', 'veryo' ), __( 'Training op locatie in Drenthe', 'veryo' ) ) |
| 677 | $veryo_literacy | Weghalen — pagina vervalt (301) | * Academy |
| 679 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy = veryo_sec_answer( __( 'De Veryo Academy wordt een online AI-cursus voor beginners: korte modules van 10 |
| 680 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_sec_text( |
| 681 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'Een online AI-cursus voor je hele team', 'veryo' ), |
| 683 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'Niet iedereen kan tegelijk een dag vrijmaken voor een training. Met de online AI-cursus leert iedereen in zijn eige |
| 684 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'De cursus is ook voor losse deelnemers: ondernemers, kantoormedewerkers, planners en iedereen die AI wil gebruiken  |
| 687 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_sec_text( |
| 688 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'Hoe de AI-cursus voor beginners eruitziet', 'veryo' ), |
| 691 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'Korte modules van 10 tot 15 minuten, zodat het tussen het werk door past.', 'veryo' ), |
| 692 | $veryo_academy | Weghalen — pagina vervalt (301) | __( 'Elke module met een oefening die je direct in je eigen werk kunt doen.', 'veryo' ), |
| 699 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_sec_photo( __( 'laptop op een keukentafel met een module van de online cursus in beeld', 'veryo' |
| 700 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_b_group( |
| 702 | $veryo_academy | Weghalen — pagina vervalt (301) | . veryo_b_p( __( 'Je krijgt één bericht zodra de cursus beschikbaar is. Geef aan met hoeveel medewerkers je wilt deelnem |
| 703 | $veryo_academy | Weghalen — pagina vervalt (301) | . veryo_b_shortcode( '[veryo_form type="academy"]' ), |
| 706 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_sec_faq( |
| 708 | $veryo_academy | Weghalen — pagina vervalt (301) | array( __( 'Wanneer is de cursus beschikbaar?', 'veryo' ), __( 'We werken eraan. Wie op de wachtlijst staat, hoort het a |
| 709 | $veryo_academy | Weghalen — pagina vervalt (301) | array( __( 'Wat gaat de online AI-cursus kosten?', 'veryo' ), __( 'Dat maken we bekend zodra de cursus klaar is. Voor te |
| 710 | $veryo_academy | Weghalen — pagina vervalt (301) | array( __( 'Kan mijn hele team de cursus volgen?', 'veryo' ), __( 'Ja, daar is hij juist voor bedoeld. Je neemt een lice |
| 711 | $veryo_academy | Weghalen — pagina vervalt (301) | array( __( 'Is de cursus geschikt voor de AI-geletterdheidsplicht?', 'veryo' ), __( 'De cursus behandelt de basis van ve |
| 712 | $veryo_academy | Weghalen — pagina vervalt (301) | array( __( 'Is dit een cursus voor programmeurs?', 'veryo' ), __( 'Nee. De cursus is voor beginners zonder technische ac |
| 715 | $veryo_academy | Weghalen — pagina vervalt (301) | $veryo_academy .= veryo_sec_links( |
| 717 | $veryo_academy | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Incompany, met je eigen team', 'veryo' ) ), |
| 718 | $veryo_academy | Weghalen — pagina vervalt (301) | array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Training, beleid en een eerste toepassing', 'veryo' ) |
| 719 | $veryo_academy | Weghalen — pagina vervalt (301) | array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Voor de AI Act', 'veryo' ) ), |
| 821 | $veryo_prices | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Wel:', 'veryo' ) . '</strong> ' . __( 'advies, inrichten, testen met echte gegevens, de training die e |
| 852 | $veryo_about | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $veryo_about = veryo_sec_answer( __( 'Veryo is de onafhankelijke AI-partner uit Leeuwarden voor het MKB in Noord-Nederla |
| 881 | $veryo_about | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Veryo is onafhankelijk: we verkopen geen eigen software en hebben geen belang bij een bepaalde leverancier. Daardoo |
| 902 | $veryo_about | Weghalen of omleggen — link naar vervallen pagina | '<a href="' . esc_url( veryo_link( 'ai-training' ) ) . '">' . __( 'Training', 'veryo' ) . '</a>: ' . __( 'in-company tra |
| 920 | $veryo_about | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Van leren naar doen bij één partij.', 'veryo' ) . '</strong> ' . __( 'Advies, training, invoering en e |
| 940 | $veryo_about | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'leeuwarden', __( 'AI-training in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ), |
| 948 | $veryo_contact | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $veryo_contact = veryo_b_p( __( 'Heb je een vraag, wil je een training plannen of eerst even sparren? Stuur een bericht  |
| 1024 | $veryo_thanks | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Nuchtere AI-partner uit Leeuwarden: AI-training, automatisering en een lokale AI-assistent voor het mkb i |
| 1054 | ai-implementatie-mkb | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'AI implementeren in 5 stappen: inventarisatie, toolkeuze, pilot, training en uitrol, met afspraken over p |
| 1063 | ai-training | Weghalen — pagina vervalt (301) | 'ai-training' => array( |
| 1064 | ai-training | Weghalen — pagina vervalt (301) | 'title' => __( 'AI-training voor bedrijven: leer AI praktisch inzetten op de werkvloer', 'veryo' ), |
| 1066 | ai-training | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'AI-training voor bedrijven: praktisch en op locatie \| Veryo', 'veryo' ), |
| 1067 | ai-training | Weghalen — pagina vervalt (301) | 'desc' => __( 'Een trainingstraject waarin je team AI leert inzetten in het eigen werk: van basis tot geavanceerd, met o |
| 1068 | ai-training | Weghalen — pagina vervalt (301) | 'kw' => 'ai training voor bedrijven', |
| 1075 | ai-training | Weghalen — pagina vervalt (301) | 'content' => $veryo_training, |
| 1077 | ai-training/ai-geletterdheid | Weghalen — pagina vervalt (301) | 'ai-training/ai-geletterdheid' => array( |
| 1078 | ai-training/ai-geletterdheid | Weghalen — pagina vervalt (301) | 'title' => __( 'AI-geletterdheid: training voor jullie team', 'veryo' ), |
| 1079 | ai-training/ai-geletterdheid | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'AI-geletterdheid training voor teams (AI Act) \| Veryo', 'veryo' ), |
| 1080 | ai-training/ai-geletterdheid | Weghalen — pagina vervalt (301) | 'desc' => __( 'AI-geletterdheid training voor teams: praktisch en verantwoord AI-gebruik, gericht op artikel 4 van de AI |
| 1081 | ai-training/ai-geletterdheid | Weghalen — pagina vervalt (301) | 'kw' => 'ai geletterdheid training', |
| 1090 | academy | Weghalen — pagina vervalt (301) | 'academy' => array( |
| 1091 | academy | Weghalen — pagina vervalt (301) | 'title' => __( 'Veryo Academy: online AI-cursus', 'veryo' ), |
| 1092 | academy | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'Online AI-cursus voor beginners: wachtlijst \| Veryo', 'veryo' ), |
| 1093 | academy | Weghalen — pagina vervalt (301) | 'desc' => __( 'Online AI-cursus voor beginners van de Veryo Academy: korte modules van 10–15 minuten met oefeningen. Bin |
| 1094 | academy | Weghalen — pagina vervalt (301) | 'kw' => 'ai cursus online', |
| 1097 | academy | Weghalen — pagina vervalt (301) | 'content' => $veryo_academy, |
| 1129 | contact | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Neem contact op met Veryo, AI voor het MKB, uit Leeuwarden. Stel je vraag over AI-automatisering, trainin |

## inc/content/pages-pijlers.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 3 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | * Pijlers: de AI-werkplek, AI-agents, veilig AI-gebruik, plus AI-strategie en AI-training voor zzp'ers. |
| 20 | $veryo_werkplek | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'Veryo richt Copilot in voor het MKB, of Gemini als je met Google Workspace werkt: welke licenties je no |
| 37 | $veryo_werkplek | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Korte teamtraining.', 'veryo' ) . '</strong> ' . __( 'Anderhalf uur met voorbeelden uit jullie eigen w |
| 66 | $veryo_werkplek | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Inclusief licentieadvies, rechten, instellingen en de teamtraining. De licenties zelf betaal je aan Microsoft of Go |
| 75 | $veryo_werkplek | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Hoe lang duurt de inrichting?', 'veryo' ), __( 'Meestal twee tot drie weken, afhankelijk van hoe de rechten  |
| 79 | $veryo_werkplek | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Een uitgebreidere training voor je team', 'veryo |
| 271 | $veryo_veilig | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Een typisch voorbeeld van een actie: zakelijke accounts voor de AI-tool die het team al gebruikt, met de instelling |
| 297 | $veryo_veilig | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'p' => __( 'De check is een vast bedrag. Wil je meteen ook training en een beleid, dan is het AI-Startpakket de logische |
| 302 | $veryo_veilig | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is een AI-beleid verplicht?', 'veryo' ), __( 'Niet als apart document. Wel vraagt artikel 4 van de AI Act or |
| 308 | $veryo_veilig | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'ai-startpakket', __( 'Het AI-Startpakket', 'veryo' ), __( 'Training, beleid en een quick win', 'veryo' ) ), |
| 310 | $veryo_veilig | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Wat de AI Act vraagt', 'veryo' ) |
| 317 | $veryo_veilig | Weghalen of omleggen — link naar vervallen pagina | * AI-strategie: /ai-training/ai-strategie/ |
| 326 | $veryo_strategie | Weghalen — pagina vervalt (301) | 'answer' => __( 'De AI-strategie training van Veryo is een halve dag voor eigenaar, directie of MT: wat betekent AI voor |
| 330 | $veryo_strategie | Weghalen — pagina vervalt (301) | __( 'In veel MKB-bedrijven gebeurt AI van onderop. Een medewerker ontdekt ChatGPT, een ander probeert Copilot, en de dir |
| 336 | $veryo_strategie | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat er in de AI-strategie training aan bod komt', 'veryo' ), |
| 354 | $veryo_strategie | Weghalen — pagina vervalt (301) | 'h' => __( 'AI masterclass voor ondernemers, of liever meteen aan de slag?', 'veryo' ), |
| 364 | $veryo_strategie | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat kost de AI-strategie training?', 'veryo' ), |
| 368 | $veryo_strategie | Weghalen — pagina vervalt (301) | array( __( 'Wat is het verschil met de AI-training voor het team?', 'veryo' ), __( 'De teamtraining gaat over het dageli |
| 374 | $veryo_strategie | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor het hele team', 'veryo' ) ), |
| 381 | $veryo_strategie | Weghalen — pagina vervalt (301) | * AI-training voor zzp'ers: /ai-training/zzp/ |
| 385 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'answer' => __( 'AI-training voor zzp’ers en eenmanszaken: leer in korte online modules hoe je ChatGPT, Claude of Copilo |
| 390 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'Een in-company training is voor één persoon te duur, en de meeste online cursussen zijn óf te technisch óf te vaag. |
| 395 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat je leert in de AI cursus voor zzp’ers', 'veryo' ), |
| 406 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'h' => __( 'ChatGPT cursus voor zzp’ers: hoe de training werkt', 'veryo' ), |
| 408 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'De training bestaat uit korte modules van tien tot vijftien minuten, met een video met slides en uitleg, en een oef |
| 409 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'De Academy is nog in ontwikkeling. Op de wachtlijst hoor je als eerste wanneer hij opengaat, en wat de introductiep |
| 413 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'h' => __( 'Open groepstrainingen', 'veryo' ), |
| 415 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'Liever een dagdeel met andere ondernemers? We organiseren ook open groepstrainingen in Leeuwarden. Data, locatie en |
| 416 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'Een in-company training bieden we op deze pagina bewust niet aan; die is bedoeld voor teams. Werk je met een paar m |
| 420 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'h' => __( 'Voor wie is de AI-training voor zzp’ers?', 'veryo' ), |
| 422 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'Voor zelfstandigen en eenmanszaken in elke branche: van installateur en schilder tot coach, fotograaf, boekhouder o |
| 423 | $veryo_zzp | Weghalen — pagina vervalt (301) | __( 'Werk je af en toe samen met een of twee anderen, dan kun je de training samen volgen. Vanaf tien deelnemers geldt e |
| 436 | $veryo_zzp | Weghalen — pagina vervalt (301) | . veryo_b_shortcode( '[veryo_form type="academy"]' ), |
| 440 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'steps' => array( 'academy', 'scan' ), |
| 441 | $veryo_zzp | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat kost de AI-training voor zzp’ers?', 'veryo' ), |
| 444 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( __( 'Wanneer start de online training?', 'veryo' ), __( 'De Academy is in ontwikkeling. Op de wachtlijst hoor je  |
| 445 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( __( 'Heb ik technische kennis nodig?', 'veryo' ), __( 'Nee. Als je kunt mailen en een document kunt maken, kun je |
| 446 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( __( 'Welke AI-tool gebruik ik in de training?', 'veryo' ), __( 'De oefeningen werken met ChatGPT, Claude of Copil |
| 447 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( __( 'Is de training aftrekbaar?', 'veryo' ), __( 'Scholingskosten voor je onderneming zijn meestal zakelijke kost |
| 450 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( 'academy', __( 'Veryo Academy', 'veryo' ), __( 'Online AI-cursus voor beginners', 'veryo' ) ), |
| 451 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor teams', 'veryo' ) ), |
| 452 | $veryo_zzp | Weghalen — pagina vervalt (301) | array( 'leeuwarden', __( 'AI-training in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ), |
| 461 | ai-werkplek | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Copilot inrichten voor het MKB, of Gemini: licentieadvies, toegangsrechten, de juiste instellingen en een |
| 495 | ai-training/ai-strategie | Weghalen — pagina vervalt (301) | 'ai-training/ai-strategie' => array( |
| 496 | ai-training/ai-strategie | Weghalen — pagina vervalt (301) | 'title' => __( 'AI-strategie: training voor directie en MT', 'veryo' ), |
| 497 | ai-training/ai-strategie | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'AI-strategie training voor directie en management \| Veryo', 'veryo' ), |
| 498 | ai-training/ai-strategie | Weghalen — pagina vervalt (301) | 'desc' => __( 'AI-strategie training voor directie en MT: een halve dag over kansen, keuzes en verantwoordelijkheid, met |
| 499 | ai-training/ai-strategie | Weghalen — pagina vervalt (301) | 'kw' => 'ai strategie training', |
| 508 | ai-training/zzp | Weghalen — pagina vervalt (301) | 'ai-training/zzp' => array( |
| 509 | ai-training/zzp | Weghalen — pagina vervalt (301) | 'title' => __( 'AI-training voor zzp’ers', 'veryo' ), |
| 510 | ai-training/zzp | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'AI-training voor zzp’ers: praktisch en betaalbaar \| Veryo', 'veryo' ), |
| 511 | ai-training/zzp | Weghalen — pagina vervalt (301) | 'desc' => __( 'AI-training voor zzp’ers: korte online modules over offertes, mail, administratie en marketing met AI. Bi |
| 512 | ai-training/zzp | Weghalen — pagina vervalt (301) | 'kw' => 'ai training zzp', |

## inc/content/pages-producten.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 15 | $veryo_sp_parts | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'AI-training voor het hele team', 'veryo' ) . '</strong><br>' . __( 'Een halve dag praktisch aan de sla |
| 16 | $veryo_sp_parts | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'AI-beleid op maat', 'veryo' ) . '</strong><br>' . __( 'Een beleid van één à twee pagina’s dat het team |
| 21 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $veryo_startpakket = veryo_sec_answer( __( 'Het Veryo AI-Startpakket is de manier om AI in één keer goed en veilig in je |
| 29 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $veryo_startpakket .= veryo_sec_photo( __( 'team van een MKB-bedrijf tijdens een AI-training aan tafel', 'veryo' ), __(  |
| 55 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'De inhoud is voor iedereen gelijk; bij een groter team gaan de training, het beleid en de nazorg over meer mensen.' |
| 59 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Je betaalt het pakket één keer; er zit geen software aan vast. Mogelijk is er subsidie via de SLIM-regeling voor he |
| 69 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'De wet schrijft geen vast programma voor. De training en het AI-beleid uit het Startpakket zijn concrete stappen om |
| 91 | $veryo_startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Hoe lang duurt het?', 'veryo' ), __( 'Meestal een paar weken, afhankelijk van jullie agenda. De kansensessie |
| 110 | $veryo_startpakket | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alleen de training, zonder de rest', 'veryo' ) ) |
| 111 | $veryo_startpakket | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Meer over de AI Act', 'veryo' )  |
| 124 | $veryo_partner | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'De training was goed, het beleid staat op papier en de eerste toepassing draait. Maar dan komt het gewone werk weer |
| 133 | $veryo_partner | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Bijblijven.', 'veryo' ) . '</strong> ' . __( 'Elk kwartaal een update-sessie, nieuwe medewerkers krijg |
| 192 | ai-startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'seo_title' => __( 'AI-Startpakket: advies, training en beleid \| Veryo', 'veryo' ), |
| 193 | ai-startpakket | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Het AI-startpakket voor het MKB: kansensessie, teamtraining, AI-beleid op maat, één quick win en 30 dagen |

## inc/content/pages-regio.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 32 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'AI-adviseur in Friesland: Veryo uit Leeuwarden helpt het Friese mkb met AI-training, automatisering en ee |
| 44 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'Veryo is een AI-adviseur in Friesland, gevestigd in Leeuwarden. We helpen Friese MKB-bedrijven met AI-a |
| 70 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Voor de meeste Friese mkb-bedrijven is de eerste stap klein: een AI-workshop voor het team, of één automatisering v |
| 78 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Trainingen en workshops op jullie locatie, of in Leeuwarden.', 'veryo' ), |
| 85 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Vanuit Leeuwarden zijn we snel in heel Friesland. We werken voor bedrijven in Leeuwarden, Drachten, Heerenveen en S |
| 93 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'price' => array( 'steps' => array( 'scan', 'startpakket', 'training', 'quickwin' ) ), |
| 95 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Werken jullie ook in Drachten, Heerenveen en Sneek?', 'veryo' ), __( 'Ja. Drachten, Heerenveen en Sneek ligg |
| 97 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Kunnen jullie een AI-training in Friesland geven?', 'veryo' ), __( 'Ja, bij jou op locatie of in Leeuwarden. |
| 105 | ai-adviseur-friesland | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( 'leeuwarden', __( 'AI-training en automatisering in Leeuwarden', 'veryo' ), __( 'Onze thuisbasis', 'veryo' ) ), |
| 108 | ai-adviseur-friesland | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Incompany, halve of hele dag', 'veryo' ) ), |
| 119 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'seo_title' => __( 'AI-adviseur Groningen: workshops en automatisering \| Veryo', 'veryo' ), |
| 120 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'AI-adviseur in Groningen: AI-workshops, training en automatisering voor het mkb in de stad en de provinci |
| 131 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'Veryo is een AI-adviseur voor het MKB in Groningen, in de stad en de provincie. Vanuit Leeuwarden komen |
| 150 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'h' => __( 'AI-training in Groningen', 'veryo' ), |
| 152 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Veel Groningse bedrijven beginnen met een training. Dat is logisch: als je team snapt wat AI kan en wat niet, komen |
| 153 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Een voorbeeld: een ingenieursbureau in de stad kan een halve dag training combineren met een kansensessie in de mid |
| 157 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'h' => __( 'AI-workshop in Groningen', 'veryo' ), |
| 160 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | /* translators: %s: link naar de AI-workshop. */ |
| 161 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Wil je eerst het hele team laten kennismaken met AI? Een <a href="%s">AI-workshop</a> van een dagdeel geven we bij  |
| 162 | ai-adviseur-groningen | Weghalen of omleggen — link naar vervallen pagina | esc_url( veryo_link( 'ai-workshop' ) ) |
| 175 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'price' => array( 'steps' => array( 'scan', 'startpakket', 'training', 'project' ) ), |
| 177 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Werken jullie ook in Leek en Winschoten?', 'veryo' ), __( 'Ja. Leek ligt aan de kant van Friesland, Winschot |
| 178 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Komen jullie ook in de stad Groningen?', 'veryo' ), __( 'Ja, in de stad en in de hele provincie. Voor een ka |
| 181 | ai-adviseur-groningen | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Kunnen jullie een AI-training in Groningen geven?', 'veryo' ), __( 'Ja, bij jou op locatie of online. Vraag  |
| 199 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'AI-adviseur in Drenthe: automatisering en AI-training voor bedrijven in Assen, Emmen, Meppel en Hoogeveen |
| 210 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'Veryo is een AI-adviseur voor het MKB in Drenthe. We helpen bedrijven in Assen, Emmen, Hoogeveen, Meppe |
| 211 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'extra' => array( __( 'AI-training in Drenthe', 'veryo' ), array( __( 'Veel Drentse bedrijven beginnen met een training  |
| 241 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Assen ligt op ongeveer een uur rijden van Leeuwarden, Emmen iets verder. We werken voor bedrijven in Assen, Emmen e |
| 251 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Komen jullie in heel Drenthe?', 'veryo' ), __( 'Ja. We komen in Assen, Emmen, Hoogeveen, Meppel en alles daa |
| 252 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is Veryo een AI-consultancy voor Drentse bedrijven?', 'veryo' ), __( 'Ja, maar dan praktisch: we adviseren n |
| 255 | ai-adviseur-drenthe | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Kunnen we beginnen met een training?', 'veryo' ), __( 'Ja, dat is vaak een goede eerste stap. Vraag een grat |
| 269 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'title' => __( 'AI-training en automatisering in Leeuwarden', 'veryo' ), |
| 270 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'seo_title' => __( 'AI-training en automatisering in Leeuwarden \| Veryo', 'veryo' ), |
| 271 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Veryo is gevestigd in Leeuwarden en komt bij je langs: AI-training, workshops en automatisering voor bedr |
| 283 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'answer' => __( 'Veryo geeft AI-training in Leeuwarden en helpt bedrijven in de stad met AI-automatisering. Leeuwarden i |
| 291 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'photo' => array( __( 'trainingsruimte in Leeuwarden met een groep deelnemers en een scherm', 'veryo' ), __( 'AI-trainin |
| 294 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'h' => __( 'AI-training in Leeuwarden: op locatie of bij jou', 'veryo' ), |
| 296 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'De training is praktisch: je team werkt met ChatGPT, Claude of Copilot aan taken uit jullie eigen werk. Mail, offer |
| 297 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'We geven de training bij jou op kantoor, of op onze trainingslocatie in Leeuwarden (op aanvraag) als je team liever |
| 302 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'p' => array( __( 'Na een training willen veel bedrijven direct iets toepassen. Een voorbeeld: een administratiekantoor  |
| 309 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Trainingen bij jullie op kantoor of op een trainingslocatie in de stad.', 'veryo' ), |
| 311 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Na de training direct een eerste toepassing, zodat het geleerde blijft hangen.', 'veryo' ), |
| 324 | leeuwarden | Weghalen of omleggen — link naar vervallen pagina | 'price' => array( 'steps' => array( 'startpakket', 'academy', 'training', 'quickwin' ) ), |
| 326 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Waar in Leeuwarden geven jullie de training?', 'veryo' ), __( 'Bij jou op kantoor, of op onze trainingslocat |
| 329 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Wat kost een AI-training in Leeuwarden?', 'veryo' ), __( 'Mogelijk is er subsidie via de SLIM-regeling; open |
| 330 | leeuwarden | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is er ook een open training voor losse deelnemers?', 'veryo' ), __( 'Op dit moment niet. Voor losse deelneme |
| 336 | leeuwarden | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Alle trainingsvormen', 'veryo' ) ), |

## inc/content/pages-tools.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 52 | $veryo_tools_page | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'AI-trainingen', 'veryo' ), __( 'Jullie team leert veilig werken met AI', 'veryo' ) ), |

## inc/content/pages-training.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 3 | — | Weghalen — pagina vervalt (301) | * Trainingen: de AI-workshop voor bedrijven en de ChatGPT-training voor verkopers. |
| 11 | — | Weghalen — pagina vervalt (301) | * AI-workshop voor bedrijven |
| 13 | $veryo_workshop | Weghalen — pagina vervalt (301) | $veryo_workshop = veryo_page_standard( |
| 16 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Een AI-workshop voor jullie team?', 'veryo' ), |
| 18 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Bijvoorbeeld: workshop voor 12 collega’s in Groningen, de helft gebruikt al ChatGPT.', 'veryo' ), |
| 20 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'answer' => __( 'Een AI-workshop voor bedrijven is een praktische sessie van een dagdeel waarin jullie team met AI aan d |
| 22 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'Waarom een AI-workshop, en geen lange cursus?', 'veryo' ), |
| 25 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Een workshop is de snelste manier om het hele team op hetzelfde startpunt te krijgen. In een dagdeel ontdekken coll |
| 28 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'photo' => array( __( 'team van een MKB-bedrijf rond een tafel met laptops tijdens een workshop', 'veryo' ), __( 'AI-wor |
| 31 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'Wat jullie doen in de AI-workshop', 'veryo' ), |
| 42 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'Zo ziet een workshop eruit', 'veryo' ), |
| 43 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'p' => array( __( 'Een workshop duurt een dagdeel, ongeveer drie tot vier uur. We stemmen de opzet af op jullie team:',  |
| 51 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'AI-workshop in Friesland, Groningen of Drenthe', 'veryo' ), |
| 53 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'We komen bij jullie op locatie. Vanuit Leeuwarden zijn we snel in heel Friesland, in de stad Groningen en de rest v |
| 54 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Werken jullie verspreid over meerdere vestigingen, of zit het team buiten Noord-Nederland? Dan geven we de workshop |
| 58 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'Voor welke teams is een AI-workshop geschikt?', 'veryo' ), |
| 61 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Verkoopteams die offertes en opvolgmails maken. Daarvoor is er ook een aparte ChatGPT-training voor verkopers.', 'v |
| 68 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'ChatGPT-workshop of Copilot-workshop?', 'veryo' ), |
| 69 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'p' => array( __( 'De workshop werkt met de tools die jullie gebruiken. Werken jullie in Microsoft 365, dan ligt een Cop |
| 72 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'h' => __( 'Workshop of training?', 'veryo' ), |
| 75 | $veryo_workshop | Weghalen — pagina vervalt (301) | /* translators: %s: link naar AI-training. */ |
| 76 | $veryo_workshop | Weghalen — pagina vervalt (301) | __( 'Een workshop is een eerste kennismaking in een dagdeel. Een <a href="%s">AI-training</a> gaat dieper, duurt een hal |
| 77 | $veryo_workshop | Weghalen — pagina vervalt (301) | esc_url( veryo_link( 'ai-training' ) ) |
| 83 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'steps' => array( 'training', 'startpakket' ), |
| 84 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'p' => __( 'Een workshop is een vast bedrag per sessie. Mogelijk is er subsidie via de SLIM-regeling voor trainingen; op |
| 87 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( __( 'Hoe lang duurt een AI-workshop?', 'veryo' ), __( 'Een dagdeel, ongeveer drie tot vier uur. Zo blijft er geno |
| 89 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( __( 'Geven jullie ook een AI-workshop in Groningen?', 'veryo' ), __( 'Ja. We komen in de stad Groningen en de res |
| 91 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( __( 'Telt de workshop mee voor de AI-geletterdheid uit de AI Act?', 'veryo' ), __( 'De workshop is een concrete m |
| 92 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( __( 'Kan de workshop online?', 'veryo' ), __( 'Ja, voor teams buiten Noord-Nederland of op meerdere vestigingen.  |
| 95 | $veryo_workshop | Weghalen — pagina vervalt (301) | 'cta' => array( __( 'Een AI-workshop voor jullie team plannen?', 'veryo' ), __( 'Plan een gratis kennismaking van 15 min |
| 97 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Een halve of hele dag, dieper', 'veryo' ) ), |
| 98 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( 'ai-training/chatgpt-training-verkopers', __( 'ChatGPT-training voor verkopers', 'veryo' ), __( 'Voor sales en ac |
| 99 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid training', 'veryo' ), __( 'Wat de AI Act vraagt', 'veryo' ) |
| 101 | $veryo_workshop | Weghalen — pagina vervalt (301) | array( 'ai-adviseur-groningen', __( 'AI-adviseur in Groningen', 'veryo' ), __( 'Workshops in stad en provincie', 'veryo' |
| 107 | $veryo_workshop | Weghalen — pagina vervalt (301) | * ChatGPT-training voor verkopers |
| 112 | $veryo_sales | Weghalen — pagina vervalt (301) | __( 'Een ChatGPT-training voor jullie verkopers?', 'veryo' ), |
| 116 | $veryo_sales | Weghalen — pagina vervalt (301) | 'answer' => __( 'De ChatGPT-training voor verkopers van Veryo leert jullie salesteam hoe je AI gebruikt voor het werk ro |
| 121 | $veryo_sales | Weghalen — pagina vervalt (301) | __( 'Veel verkopers gebruiken ChatGPT al op eigen houtje. Dat levert soms mooie resultaten op, en soms teksten die klink |
| 126 | $veryo_sales | Weghalen — pagina vervalt (301) | 'h' => __( 'AI voor sales: wat jullie verkopers leren', 'veryo' ), |
| 138 | $veryo_sales | Weghalen — pagina vervalt (301) | 'h' => __( 'Zo werkt de training', 'veryo' ), |
| 141 | $veryo_sales | Weghalen — pagina vervalt (301) | '<strong>' . __( 'De training.', 'veryo' ) . '</strong> ' . __( 'Een dagdeel, op locatie of online. Steeds kort uitleg e |
| 147 | $veryo_sales | Weghalen — pagina vervalt (301) | 'p' => array( __( 'AI verkoopt niet voor je. Een klant koopt van een mens die hij vertrouwt. AI helpt alleen met het voo |
| 152 | $veryo_sales | Weghalen — pagina vervalt (301) | __( 'De training werkt met de tools die jullie gebruiken: ChatGPT, Copilot in Microsoft 365 of Gemini. Werken jullie met |
| 157 | $veryo_sales | Weghalen — pagina vervalt (301) | 'steps' => array( 'training' ), |
| 158 | $veryo_sales | Weghalen — pagina vervalt (301) | 'p' => __( 'De training is een vast bedrag per sessie. Mogelijk is er subsidie via de SLIM-regeling voor trainingen; ope |
| 161 | $veryo_sales | Weghalen — pagina vervalt (301) | array( __( 'Voor wie is de ChatGPT-training voor verkopers?', 'veryo' ), __( 'Voor verkopers, accountmanagers, binnendie |
| 162 | $veryo_sales | Weghalen — pagina vervalt (301) | array( __( 'Mogen we klantgegevens in ChatGPT zetten?', 'veryo' ), __( 'Dat hangt af van de versie en de afspraken. In d |
| 163 | $veryo_sales | Weghalen — pagina vervalt (301) | array( __( 'Werkt het met ons CRM?', 'veryo' ), __( 'De training gaat over het werken met AI zelf. Wil je daarna verslag |
| 164 | $veryo_sales | Weghalen — pagina vervalt (301) | array( __( 'Hoe lang duurt de training?', 'veryo' ), __( 'Een dagdeel. Voor teams die meer willen, plannen we een vervol |
| 165 | $veryo_sales | Weghalen — pagina vervalt (301) | array( __( 'Kan de training online?', 'veryo' ), __( 'Ja. Op locatie werkt meestal beter, maar online kan prima voor ver |
| 170 | $veryo_sales | Weghalen — pagina vervalt (301) | array( 'ai-training', __( 'AI-training voor bedrijven', 'veryo' ), __( 'Voor het hele team', 'veryo' ) ), |
| 171 | $veryo_sales | Weghalen — pagina vervalt (301) | array( 'ai-workshop', __( 'AI-workshop voor bedrijven', 'veryo' ), __( 'Een dagdeel, praktisch', 'veryo' ) ), |
| 179 | ai-workshop | Weghalen — pagina vervalt (301) | 'ai-workshop' => array( |
| 180 | ai-workshop | Weghalen — pagina vervalt (301) | 'title' => __( 'AI-workshop voor bedrijven', 'veryo' ), |
| 181 | ai-workshop | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'AI-workshop voor teams: één dagdeel, eigen taken \| Veryo', 'veryo' ), |
| 183 | ai-workshop | Weghalen — pagina vervalt (301) | 'kw' => 'ai workshop bedrijven', |
| 189 | ai-workshop | Weghalen — pagina vervalt (301) | 'content' => $veryo_workshop, |
| 191 | ai-training/chatgpt-training-verkopers | Weghalen — pagina vervalt (301) | 'ai-training/chatgpt-training-verkopers' => array( |
| 192 | ai-training/chatgpt-training-verkopers | Weghalen — pagina vervalt (301) | 'title' => __( 'ChatGPT-training voor verkopers', 'veryo' ), |
| 193 | ai-training/chatgpt-training-verkopers | Weghalen — pagina vervalt (301) | 'seo_title' => __( 'ChatGPT-training voor verkopers: AI voor sales \| Veryo', 'veryo' ), |
| 194 | ai-training/chatgpt-training-verkopers | Weghalen — pagina vervalt (301) | 'desc' => __( 'ChatGPT-training voor verkopers: offertes, opvolgmails en gespreksverslagen sneller met AI, veilig en in  |
| 195 | ai-training/chatgpt-training-verkopers | Weghalen — pagina vervalt (301) | 'kw' => 'chatgpt training verkopers', |

## inc/content/posts-artikelen.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 471 | wat-kost-ai-automatisering | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Voor het automatiseren zelf is er geen algemene subsidie. Voor het trainen van je team kan de SLIM-regeling interes |
| 510 | wat-kost-ai-automatisering | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Is AI-automatisering subsidiabel?', 'veryo' ), __( 'Voor het automatiseren zelf is er geen algemene regeling |

## inc/content/posts-blog.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 170 | ai-geletterdheid-ai-act-mkb | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Checklist voor het MKB', 'veryo' ), __( 'Vijf vragen: welke tools, welke gegevens, wie controleert, wie is v |
| 183 | ai-beleid-bedrijf-template | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'desc' => __( 'Een AI-beleid voor je bedrijf opstellen? Gebruik deze template met wat in een beleid hoort: tools, gegeve |
| 196 | ai-beleid-bedrijf-template | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Verantwoordelijkheid en training', 'veryo' ), __( 'Wie is aanspreekpunt, hoe wordt het team getraind.', 'ver |
| 253 | is-chatgpt-veilig-ai-en-avg | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Vijf praktische regels voor je team', 'veryo' ), __( 'Geen klantnamen in gratis tools, zakelijke accounts, i |
| 292 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | 'slim-subsidie-ai-training' => array( |
| 293 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | 'title' => __( 'SLIM-subsidie voor AI-training: zo werkt het', 'veryo' ), |
| 294 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | 'seo_title' => __( 'SLIM-subsidie voor AI-training: zo werkt het \| Veryo', 'veryo' ), |
| 295 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | 'desc' => __( 'SLIM-subsidie voor AI-training: wat de regeling is, voor wie ze mogelijk geschikt is en waar je op let. P |
| 296 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | 'kw' => 'slim subsidie ai training', |
| 300 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | array( __( 'Kan AI-training eronder vallen?', 'veryo' ), __( 'Mogelijk, afhankelijk van de voorwaarden van de openstelli |
| 309 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | array( __( 'Wat Veryo wel en niet doet', 'veryo' ), __( 'Veryo geeft de training en levert de gegevens die je nodig hebt |
| 313 | slim-subsidie-ai-training | Weghalen — concept over subsidie voor trainingen | array( __( 'Vraagt Veryo de subsidie aan?', 'veryo' ), __( 'Nee. We leveren wel de informatie over de training.', 'veryo |
| 389 | ai-beleid-medewerkers | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Uitleggen en herhalen', 'veryo' ), __( 'Bespreek het beleid in een korte training en neem het mee bij nieuwe |
| 446 | copilot-veilig-inrichten | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Instellingen', 'veryo' ), __( 'Welke functies aan, welke uit, en dat bedrijfsgegevens niet voor training wor |
| 494 | ai-voor-hr | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'kw' => 'ai en hr training', |
| 500 | ai-voor-hr | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'HR en de AI Act', 'veryo' ), __( 'Feitelijk: AI-geletterdheid sinds 2 februari 2025. Benoem dat HR vaak de t |
| 501 | ai-voor-hr | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Een training voor HR', 'veryo' ), __( 'Verwijs naar de AI-training voor bedrijven en het AI-Startpakket.', ' |
| 506 | ai-voor-hr | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Wie organiseert de AI-training?', 'veryo' ), __( 'Vaak HR, samen met de directie.', 'veryo' ) ), |
| 572 | wat-kost-een-eigen-ai-assistent | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | array( __( 'Waar betaal je voor?', 'veryo' ), __( 'Splits de kosten op: intake, installatie, kennis verzamelen, koppelin |

## inc/content/posts-gidsen.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 59 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | __( 'Kort antwoord: artikel 4 van de Europese AI-verordening, de AI Act, geldt sinds 2 februari 2025. Sinds de wijziging |
| 91 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | __( 'De Europese Commissie heeft in een vraag-en-antwoorddocument laten weten dat een certificaat niet nodig is en dat e |
| 109 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | '<strong>' . __( 'Leg vast wat je hebt gedaan en herhaal het.', 'veryo' ) . '</strong> ' . __( 'Noteer wie wanneer welke |
| 129 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | '<strong>' . __( 'Iedereen dezelfde training geven.', 'veryo' ) . '</strong> ' . __( 'Wie met persoonsgegevens werkt, he |
| 137 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | /* translators: 1: link naar de AI-geletterdheid training, 2: link naar de AI-workshop. */ |
| 139 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | $veryo_g_link( 'ai-training/ai-geletterdheid', __( 'training AI-geletterdheid', 'veryo' ) ), |
| 140 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | $veryo_g_link( 'ai-workshop', __( 'praktische AI-workshop', 'veryo' ) ) |
| 151 | ai-geletterdheid-ai-act-mkb | Vraag — concept: training als oplossing eruit, AI Act-uitleg houden? | array( __( 'Moet ik een certificaat AI-geletterdheid hebben?', 'veryo' ), __( 'Nee. De AI Act vraagt geen certificaat. J |
| 176 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | __( 'Hieronder staan tien toepassingen die we in trainingen het vaakst zien werken bij verkopers in het mkb: accountmana |
| 185 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | '<strong>' . __( 'Geen klantgegevens in een gratis account.', 'veryo' ) . '</strong> ' . __( 'Gebruik een zakelijk abonn |
| 260 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | /* translators: 1: link naar de ChatGPT-training voor verkopers, 2: link naar AI-geletterdheid. */ |
| 262 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | $veryo_g_link( 'ai-training/chatgpt-training-verkopers', __( 'ChatGPT-training voor verkopers', 'veryo' ) ), |
| 263 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | $veryo_g_link( 'ai-training/ai-geletterdheid', __( 'AI-geletterdheid', 'veryo' ) ) |
| 279 | chatgpt-voor-verkopers | Weghalen — concept promoot de verkoperstraining | veryo_sec_cta_demo( __( 'Jullie verkoopteam sneller met AI', 'veryo' ), __( 'Plan een gratis kennismaking voor de ChatGP |
| 358 | ai-kennisbank-opzetten | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | /* translators: 1: link naar Veryo Collega, 2: link naar de AI-training. */ |
| 359 | ai-kennisbank-opzetten | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | __( 'Wil je zien hoe dat eruitziet met jullie eigen documenten? Plan een demo van %1$s. Wil je eerst je team leren werke |
| 361 | ai-kennisbank-opzetten | Weghalen of omleggen — link naar vervallen pagina | $veryo_g_link( 'ai-training', __( 'AI-training', 'veryo' ) ) |

## inc/content/registry.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 31 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | foreach ( array( 'pages-main', 'pages-training', 'pages-tools', 'pages-collega', 'pages-producten', 'pages-oplossingen', |

## inc/content/sections.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 208 | — | Laten staan / gelijktrekken — "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Invoeren en bouwen', 'veryo' ) . '</strong><br>' . __( 'Eerst richten we software in die je al hebt of |
| 321 | — | Weghalen of omleggen — link naar vervallen pagina | foreach ( array( 'kansensessie', 'training', 'werkplek', 'veiligheidscheck', 'agents', 'academy' ) as $key ) { |
| 424 | — | Laten staan / gelijktrekken — "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'Inrichten en trainen.', 'veryo' ) . '</strong> ' . __( 'We zetten de juiste functies aan, of kiezen sa |
| 591 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $intro = $intro ? $intro : __( 'Veryo zit in Leeuwarden. In Friesland, Groningen en Drenthe komen we gewoon langs: aan d |
| 596 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<a href="' . esc_url( veryo_link( 'leeuwarden' ) ) . '">' . __( 'AI-training en automatisering in Leeuwarden', 'veryo'  |
| 662 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $training = veryo_b_h( __( 'Training', 'veryo' ), 3 ); |
| 663 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $training .= veryo_b_p( __( 'Een halve of hele dag met je eigen team. Praktisch, met voorbeelden uit jullie werk, en je  |
| 664 | — | Weghalen of omleggen — link naar vervallen pagina | $training .= veryo_b_buttons( array( array( __( 'Over de training', 'veryo' ), veryo_link( 'ai-training' ), 'link' ) ) ) |
| 696 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'inner' => veryo_b_group( $training, array( 'className' => 'veryo-service-plain' ) ) . veryo_b_group( $invoering, array( |
| 720 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | '<strong>' . __( 'AI-Startpakket', 'veryo' ) . '</strong><br>' . __( 'Kansensessie, teamtraining, AI-beleid, één quick w |
| 759 | — | Weghalen of omleggen — link naar vervallen pagina | '<strong><a href="' . esc_url( veryo_link( 'ai-training' ) ) . '">' . esc_html__( 'AI-training en workshops', 'veryo' )  |
| 1108 | — | Weghalen of omleggen — link naar vervallen pagina | array( 'ai-training', __( 'Training', 'veryo' ), __( 'In-company, AI-geletterdheid en straks de online Academy.', 'veryo |

## inc/helpers.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 59 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | 'academy_waitlist' => 1, |
| 170 | — | Weghalen of omleggen — link naar vervallen pagina | * @param string $path Pad zonder slashes, bv. "ai-training/ai-geletterdheid". |

## inc/kennis.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 67 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training' => __( 'AI-training voor bedrijven', 'veryo' ), |
| 68 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-workshop' => __( 'AI-workshop', 'veryo' ), |
| 69 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/ai-geletterdheid' => __( 'AI-geletterdheid training', 'veryo' ), |
| 70 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/chatgpt-training-verkopers' => __( 'ChatGPT-training voor verkopers', 'veryo' ), |

## inc/photos.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 25 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'training' => __( 'Groep tijdens een training', 'veryo' ), |
| 49 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | 'training' => 'team', |

## inc/quiz/catalog.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 146 | — | Laten staan — gaat over certificaten/opleidingen van medewerkers van de klant | 'certificaten' => array( 'hr-en-werving', 'Certificaten bijhouden', 'VCA, keuringen en opleidingen bijhouden.', '1–2 u/m |
| 218 | — | Herschrijven — training als onderdeel na oplevering | array( __( 'AI-training voor het hele team', 'veryo' ), __( 'Een halve dag praktisch aan de slag met ChatGPT, Claude of  |
| 298 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'academy' => array( |
| 300 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'dienst' => __( 'Online AI-training, Veryo Academy (binnenkort)', 'veryo' ), |
| 301 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'wat' => __( 'Korte modules van 10 tot 15 minuten met oefeningen, per medewerker, met staffelkorting vanaf 10 personen.' |
| 302 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'voor' => __( 'Voor teams die zelfstandig willen leren, en voor losse deelnemers.', 'veryo' ), |
| 306 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'path' => 'academy', |
| 311 | — | Herschrijven — training als onderdeel na oplevering | 'wat' => __( 'AI-scan en kansensessie, teamtraining, AI-beleid op maat, één quick win ingericht en 30 dagen nazorg.', 'v |
| 321 | — | Herschrijven — training als onderdeel na oplevering | 'wat' => __( 'Een workshop en een rapport met prioriteiten en de verwachte opbrengst per kans.', 'veryo' ), |
| 328 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'training' => array( |
| 330 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'dienst' => __( 'In-company AI-training tot 20 personen', 'veryo' ), |
| 336 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'path' => 'ai-training', |
| 341 | — | Herschrijven — training als onderdeel na oplevering | 'wat' => __( 'Microsoft 365 met Copilot of Google Workspace met Gemini: licentieadvies, toegangsrechten, instellingen en |
| 433 | — | Weghalen — training/Academy uit het dienstenoverzicht (prijsladder) | 'inhoud' => __( 'Elk kwartaal een update-sessie (wat is er nieuw en wat heb je eraan), nieuwe medewerkers krijgen toegan |

## inc/quiz/leads.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 33 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | 'academy' => __( 'Academy-wachtlijst', 'veryo' ), |
| 98 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | * @param string $source ai-scan\|academy\|contact. |

## inc/quiz/report.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 612 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | * Webhook voor niet-scan-leads (contact, academy) direct, niet-blokkerend. |

## inc/quiz/rest.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 3 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | * REST-endpoints: AI-scan, formulieren (contact, academy) en een verse nonce. |
| 289 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | if ( ! in_array( $type, array( 'contact', 'academy', 'demo' ), true ) ) { |
| 305 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | if ( 'academy' === $type ) { |
| 372 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | 'message' => 'demo' === $type ? __( 'Dank je! We nemen binnen één werkdag contact op om de demo te plannen.', 'veryo' )  |
| 373 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | ? __( 'Je staat op de wachtlijst. We sturen je één bericht zodra de cursus beschikbaar is.', 'veryo' ) |

## inc/quiz/shortcodes.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 254 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | * Contactformulier of Academy-wachtlijst. |
| 271 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | $type = in_array( $atts['type'], array( 'academy', 'demo' ), true ) ? $atts['type'] : 'contact'; |
| 273 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | if ( 'academy' === $type && ! veryo_setting( 'academy_waitlist' ) ) { |
| 308 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | if ( 'academy' === $type ) { |
| 391 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | $consent = 'academy' === $type |
| 393 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | ? __( 'Ik ga akkoord dat Veryo mijn gegevens bewaart om mij te laten weten wanneer de cursus beschikbaar is, zoals besch |
| 398 | — | Weghalen — Academy-wachtlijst (formulier, REST, lead-type, instelling) | $label = 'academy' === $type ? __( 'Zet me op de wachtlijst', 'veryo' ) : __( 'Verstuur bericht', 'veryo' ); |
| 557 | — | Herschrijven — volgende stap scan: kennismaking/demo i.p.v. Startpakket | $out .= '<p>' . esc_html__( 'Kansensessie, teamtraining, AI-beleid op maat, één quick win ingericht en 30 dagen nazorg.' |

## inc/seo.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 277 | — | Herschrijven — bouwen en inrichten | return __( 'Praktische kennis over AI voor het mkb: uitleg, stappenplannen en voorbeelden over automatisering, AI-traini |
| 286 | — | Herschrijven — bouwen en inrichten | return veryo_brand_line() . '. ' . __( 'AI-automatiseringen, trainingen en AI op maat voor het MKB in Noord-Nederland.', |
| 876 | — | Weghalen — Course-schema | // Training: Course, met de vormen waarin hij gegeven wordt (op locatie en/of online). |
| 1108 | — | Herschrijven — bouwen en inrichten | __( 'Veryo is de onafhankelijke AI-partner voor het mkb (teams tot ongeveer 50 mensen), gevestigd in %s. Veryo is geen s |
| 1130 | — | Weghalen — trainingen uit llms.txt | $out[] = '## ' . __( 'AI-trainingen en workshops', 'veryo' ); |
| 1132 | — | Weghalen — trainingen uit llms.txt | foreach ( array( 'ai-training', 'ai-workshop', 'ai-training/ai-geletterdheid', 'ai-training/chatgpt-training-verkopers', |

## inc/tools-registry.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 112 | — | Laten staan / gelijktrekken — "Na de oplevering leren we jullie team ermee werken." | 'copilot' => $t( 'Microsoft Copilot', 'ai-modellen', __( 'AI in Word, Outlook, Excel en Teams: we stellen de rechten goe |
| 382 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | $training = array( __( 'Praktische trainingen waarin jullie team leert veilig en slim met AI te werken.', 'veryo' ), 'cl |
| 388 | — | Laten staan / gelijktrekken — "Na de oplevering leren we jullie team ermee werken." | 'ai-werkplek' => array( __( 'We helpen jullie het juiste AI-abonnement kiezen, stellen het veilig in en leren het team e |
| 392 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training' => $training, |
| 393 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-workshop' => $training, |
| 394 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/ai-geletterdheid' => $training, |
| 395 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/chatgpt-training-verkopers' => array( __( 'Jullie verkopers leren offertes, opvolgmails en gespreksverslage |
| 396 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/ai-strategie' => $training, |
| 397 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training/zzp' => $training, |
| 599 | — | Weghalen of omleggen — link naar vervallen pagina | 'ai-training' => sprintf( |
| 600 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | /* translators: 1: link zzp-training, 2: link AI-strategie. */ |
| 602 | — | Weghalen of omleggen — link naar vervallen pagina | $l( 'ai-training/zzp', __( 'AI-training voor zzp’ers', 'veryo' ) ), |
| 603 | — | Weghalen of omleggen — link naar vervallen pagina | $l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en management', 'veryo' ) ) |
| 605 | — | Weghalen of omleggen — link naar vervallen pagina | 'academy' => sprintf( |
| 606 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | /* translators: %s: link zzp-training. */ |
| 607 | — | Weghalen — cursus | __( 'Ben je zzp’er en wil je niet wachten op de online cursus? Bekijk de %s, met korte modules over offertes, mail en ad |
| 608 | — | Weghalen of omleggen — link naar vervallen pagina | $l( 'ai-training/zzp', __( 'AI-training voor zzp’ers', 'veryo' ) ) |
| 613 | — | Weghalen of omleggen — link naar vervallen pagina | $l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en MT', 'veryo' ) ) |
| 618 | — | Weghalen of omleggen — link naar vervallen pagina | $l( 'ai-training/ai-strategie', __( 'AI-strategie training voor directie en management', 'veryo' ) ) |

## patterns/hero.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 14 | — | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | echo veryo_sec_hero( __( 'AI die echt werkt.', 'veryo' ), __( 'Automatiseringen, trainingen en AI op maat voor het MKB i |

## single.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 61 | — | Weghalen of omleggen — link naar vervallen pagina | <a class="btn btn--link" href="<?php echo esc_url( veryo_link( 'ai-training' ) ); ?>"><?php esc_html_e( 'AI-trainingen', |

## template-parts/author-box.php

| Regel | Pagina/blok | Voorstel | Tekst |
|---|---|---|---|
| 31 | $veryo_linkedin | Herschrijven — training niet meer als dienst; hooguit "Na de oplevering leren we jullie team ermee werken." | <p><?php esc_html_e( 'Helpt mkb-bedrijven uit Noord-Nederland met AI die in het dagelijkse werk past: Veryo Collega, de  |
