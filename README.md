# NIMA + PARTNERS — Site vitrine

Site web vitrine du groupe **NIMA REAL ESTATE** et de ses entités (Infinite Sky Blue Design, TKD Construction, Vintage Clean). Objectif : générer des contacts qualifiés, crédibiliser le groupe et présenter le portfolio comme un atelier d'architecte en ligne.

> Ce fichier sert à la fois de README projet et de contexte pour **Claude Code**. Lis-le en entier avant toute tâche.

---

## 1. Stack technique (imposée par le cahier des charges)

| Couche | Choix |
|---|---|
| Backend | Laravel 11 (PHP 8.3) |
| Base de données | MySQL 8 |
| Front | Blade + Livewire 3 |
| CSS | Tailwind CSS v4 |
| Build | Vite |
| Animations | GSAP 3 |
| Hébergement | Hostinger + Cloudflare CDN |
| Domaine | nimarealestate.com |
| Analytics | GA4 + Consent Mode v2 |
| Multilingue | FR / EN |

**Ne pas substituer la stack sans validation.** Pas de framework JS lourd (React/Vue) côté front : le rendu est server-side via Blade + Livewire.

---

## 2. Cibles de qualité (non négociables)

- **Lighthouse > 90** sur les 4 axes (Performance, Accessibilité, Bonnes pratiques, SEO).
- **Core Web Vitals** : LCP < 2,5 s · INP < 200 ms · CLS < 0,1.
- **Poids page max : 2 Mo.** Images en WebP/AVIF, `lazy-loading`, `srcset`.
- **Mobile-first**, breakpoints : 360 / 768 / 1024 / 1440 / 1920 px.
- **WCAG 2.1 AA** : contraste ≥ 4,5:1, navigation clavier complète, `alt` descriptifs, structure `h1→h6` cohérente, compatible NVDA/VoiceOver.
- **Sécurité** : HTTPS partout, en-têtes (HSTS, CSP, X-Frame-Options, Referrer-Policy), protection XSS/CSRF/injection SQL, 2FA sur l'admin.

Chaque tâche doit être évaluée à l'aune de ces cibles. Si une fonctionnalité les compromet (ex. GSAP qui dégrade le CLS), signale-le avant de l'implémenter.

---

## 3. Démarrage local

```bash
# Prérequis : PHP 8.3, Composer, Node 20+, MySQL 8
composer install
npm install
cp .env.example .env
php artisan key:generate
# configurer DB_* dans .env, puis :
php artisan migrate --seed
npm run dev          # build assets en watch
php artisan serve    # http://localhost:8000
```

Production : `npm run build` puis déploiement Hostinger (voir section 9).

---

## 4. Architecture du repo (cible)

```
app/
  Http/
    Controllers/        # controllers fins, logique dans des services
  Livewire/             # composants Livewire (formulaire contact, filtre portfolio, sélecteur devise)
  Models/               # Entreprise, Projet, Article, Categorie, Lead, Temoignage
  Services/             # logique métier (conversion devise, scoring lead, envoi mail)
database/
  migrations/
  seeders/
resources/
  views/
    layouts/            # app.blade.php (head, meta, GA4)
    components/         # composants Blade réutilisables (hero, card-projet, cta)
    pages/              # une vue par page de l'arborescence (section 5)
    livewire/
  css/app.css           # Tailwind v4
  js/app.js             # init GSAP, Livewire hooks
routes/
  web.php               # routes localisées FR/EN
lang/
  fr/  en/              # traductions
public/
  build/                # assets compilés (Vite)
```

Conventions :
- **Controllers fins**, métier dans `app/Services`.
- Composants UI mutualisés dans `resources/views/components`.
- Pas de logique dans les vues au-delà de l'affichage.
- Routes localisées via préfixe (`/fr/...`, `/en/...`) ou middleware de langue.

---

## 5. Arborescence fonctionnelle du site

Priorité : **I** = indispensable, **R** = recommandé, **O** = optionnel.

| Page | Contenu | Prio |
|---|---|---|
| Accueil | Hero plein écran, accès aux univers, preuves sociales, CTA contact | I |
| Entités (×4) | Une page par société : NIMA Real Estate, Infinite Sky Blue Design, TKD Construction, Vintage Clean | I |
| Réalisations / Portfolio | Grille filtrable (typologie, lieu, surface, année, entité) | I |
| Fiche projet (gabarit) | Galerie HD, plans, fiche technique, parti pris, témoignage, coût (FCFA/EUR/USD) | I |
| Services / Expertises | Prestations par entité + processus en étapes | I |
| Processus / Méthode | Contact → étude → APS/APD → permis → chantier → livraison | R |
| Actualités / Blog | Articles SEO, catégories, tags | R |
| Investir au Cameroun | Marché, rendements, cadre juridique, FAQ investisseurs, contact dédié | I |
| Contact | Formulaire qualifié (type projet, surface, budget, lieu), carte, RDV | I |
| Mentions légales / RGPD | Mentions, confidentialité, cookies | I |

**Données chiffrées de la page « Investir »** (déficit de logements, croissance PIB, rendements) : à traiter comme **contenu éditable en base ou en config**, jamais en dur dans le code, et à faire valider/sourcer côté client. Ne pas inventer de chiffres.

---

## 6. Fonctionnalités à développer

**Indispensables**
- [ ] Galerie de réalisations filtrable (Livewire) — filtres : typologie, lieu, surface, année, entité.
- [ ] Fiche projet enrichie : galerie HD, plans, fiche technique, témoignage.
- [ ] Sélecteur de devise FCFA/EUR/USD sur les fiches projet. **Taux de change configurable** (pas codé en dur ; champ admin ou API de taux à cadrer avec le client).
- [ ] Formulaire de contact qualifié, champs conditionnels + scoring/lead en base.
- [ ] Carte interactive (agence / chantiers).
- [ ] Newsletter avec double opt-in.
- [ ] Multilingue FR / EN.
- [ ] Bouton WhatsApp Business flottant sur chaque page.
- [ ] Bandeau cookies conforme RGPD + loi camerounaise + recommandations ANTIC.
- [ ] `sitemap.xml`, page sitemap HTML, `robots.txt`.

**Recommandées**
- [ ] Module blog (catégories, tags).
- [ ] Carrousel témoignages (home).
- [ ] Téléchargement plaquette PDF contre email.
- [ ] Slider avant/après (rénovations).
- [ ] Visite virtuelle (Matterport / vidéo drone).
- [ ] Prise de RDV en ligne (Calendly ou équivalent).

**Optionnelles**
- [ ] Espace client / extranet projet.
- [ ] Configurateur de devis (estimation au m²).
- [ ] Feed Instagram.

---

## 7. Modèles de données (point de départ)

- **Entreprise** : nom, slug, description, logo, couleur d'accent, services liés.
- **Projet** : titre, slug, entité, typologie, lieu, surface, année, budget (montant + devise de base), galerie, plans, parti_pris, statut (réalisé / à vendre / en cours), témoignage lié.
- **Article** : titre, slug, contenu, catégories, tags, meta SEO, statut publication.
- **Lead** : type_projet, surface, budget, lieu, message, source, score, locale.
- **Temoignage** : auteur, fonction, contenu, projet lié, autorisation (bool).

Toute table doit prévoir les champs de traduction FR/EN (ou table de traductions dédiée).

---

## 8. SEO & accessibilité (à intégrer dès le départ, pas en fin de projet)

- URLs propres et signifiantes, localisées.
- `meta title` / `meta description` éditables par page.
- Données structurées schema.org : `LocalBusiness`, `Project` (pour les fiches), `BreadcrumbList`.
- Open Graph + Twitter Cards.
- `sitemap.xml` et `robots.txt` générés automatiquement.
- Lien Google Business Profile.

L'accessibilité (section 2) se vérifie **à chaque composant**, pas en recette finale.

---

## 9. Déploiement (Hostinger)

À cadrer avant la phase 4 :
- Pipeline de build (`npm run build`) et upload assets.
- Variables d'environnement de prod (`.env`).
- Migrations en prod (`php artisan migrate --force`).
- Cloudflare : DNS, cache, règles de purge.
- Sauvegardes automatiques quotidiennes, rétention 30 jours.
- Monitoring uptime (objectif 99,9 %).

> Point de vigilance : le cahier des charges exige l'**hébergement des données dans l'UE** (clause RGPD). Vérifier que la localisation Hostinger choisie le permet — sinon la clause est en contradiction avec l'offre.

---

## 10. Découpage pour Claude Code (ordre recommandé)

Donne les tâches **une par une**, dans cet ordre, et valide chaque étape avant la suivante :

1. Squelette Laravel 11 + Livewire 3 + Tailwind v4 + Vite, layout de base, routing localisé FR/EN.
2. Modèles + migrations + seeders (Entreprise, Projet, Article, Lead, Temoignage).
3. Layout global : head, meta dynamiques, GA4 + Consent Mode v2, header/footer, bouton WhatsApp flottant.
4. Page Accueil (hero, univers, preuves sociales, CTA).
5. Pages Entités (gabarit unique paramétré par société).
6. Portfolio filtrable (Livewire) + gabarit fiche projet + sélecteur de devise.
7. Page Services + page Processus.
8. Page Contact (formulaire qualifié + scoring lead + carte) + newsletter double opt-in.
9. Page « Investir au Cameroun » (contenu éditable, données à valider client).
10. Blog (modèle + listing + article + catégories/tags).
11. Mentions légales / RGPD + bandeau cookies (RGPD/ANTIC).
12. SEO technique : sitemap, robots, schema.org, OG.
13. Passe accessibilité WCAG AA + passe performance (Lighthouse, WebP/AVIF, lazy-loading).
14. Sécurité : en-têtes, 2FA admin, durcissement.

---

## 11. Règles pour Claude Code

- Respecter la stack imposée (section 1) — pas de substitution sans accord.
- Code commenté en français, conventions Laravel (PSR-12).
- Tester chaque composant Livewire isolément.
- Ne jamais coder en dur : taux de change, données de marché, coordonnées, textes longs → en base ou config.
- Signaler tout conflit entre une demande et les cibles qualité (section 2) avant d'implémenter.
- Ne pas inventer de contenu factuel (chiffres marché, rendements, références projet) : laisser des placeholders explicites à remplir par le client.

---

## 12. Contexte projet

- **Client / MOA** : NIMA REAL ESTATE — Stéphane TSANGA.
- **Prestataire** : KAPTUE Yann Mael (ingénieur informatique).
- **Mise en ligne cible** : septembre 2026.
- **Planning** : 8 phases, ~6 à 10 semaines de développement (cf. cahier des charges §10).
