# CLAUDE.md — Site vitrine NIMA + PARTNERS

Instructions persistantes pour Claude Code. À respecter à chaque session.

---

## Stack imposée — ne pas substituer

- Backend : **Laravel 11** (PHP 8.3)
- Front : **Blade + Livewire 3** (rendu server-side, pas de React/Vue)
- CSS : **Tailwind CSS v4**
- Build : **Vite**
- Animations : **GSAP 3**
- BDD : **MySQL 8**
- Multilingue : **FR / EN**
- Hébergement : Hostinger + Cloudflare CDN · Domaine : nimarealestate.com
- Analytics : GA4 + Consent Mode v2

Toute déviation de cette stack doit être proposée et validée avant d'écrire du code.

---

## Cibles qualité — non négociables

- Lighthouse **> 90** sur les 4 axes (Perf, Accessibilité, Bonnes pratiques, SEO).
- Core Web Vitals : LCP < 2,5 s · INP < 200 ms · CLS < 0,1.
- Poids page max **2 Mo** · images WebP/AVIF · lazy-loading · srcset.
- Mobile-first · breakpoints 360 / 768 / 1024 / 1440 / 1920 px.
- Accessibilité **WCAG 2.1 AA** : contraste ≥ 4,5:1, navigation clavier complète, `alt` descriptifs, hiérarchie `h1→h6`, compatible NVDA/VoiceOver, rien signifié par la seule couleur.
- Sécurité : HTTPS, en-têtes (HSTS, CSP, X-Frame-Options, Referrer-Policy), protection XSS/CSRF/injection SQL, 2FA admin.

**Si une demande compromet une de ces cibles (ex. animation GSAP qui dégrade le CLS), le signaler AVANT d'implémenter.**

---

## Conventions de code

- PSR-12. Conventions Laravel standard.
- Controllers fins : logique métier dans `app/Services`.
- Composants UI mutualisés dans `resources/views/components`. Pas de logique dans les vues au-delà de l'affichage.
- Composants Livewire pour l'interactif (filtre portfolio, formulaire contact, sélecteur devise).
- Routes localisées FR/EN. Tout texte affiché passe par les fichiers `lang/`.
- Modèles avec champs de traduction FR/EN (ou table de traductions dédiée).
- Commentaires en français.
- Tester chaque composant Livewire isolément.

---

## Règles strictes

1. **Ne jamais coder en dur** : taux de change FCFA/EUR/USD, données de marché (page « Investir »), coordonnées, textes longs, chiffres clés → en base de données ou en config, jamais dans le code ou les vues.
2. **Ne pas inventer de contenu factuel.** Chiffres marché (déficit logements, PIB, rendements locatifs), références de projets, témoignages : laisser des placeholders explicites à remplir par le client. Ne pas générer de fausses données.
3. **SEO et accessibilité s'intègrent dès chaque composant**, pas en fin de projet.
4. **Une tâche à la fois.** Terminer et faire valider une étape avant de passer à la suivante (voir ordre ci-dessous).
5. Avant de modifier un fichier existant, le lire en entier.

---

## Points de vigilance ouverts (à clarifier avec le client, ne pas trancher seul)

- **Hébergement des données dans l'UE** exigé par la clause RGPD, mais hébergement Hostinger : vérifier la localisation avant de s'engager techniquement.
- **Données de la page « Investir au Cameroun »** : exiger des sources avant de les afficher (responsabilité engagée).
- **Taux de change** : décider source (saisie admin manuelle vs API de taux) avant d'implémenter le sélecteur de devise.

---

## Ordre de développement recommandé

1. Squelette Laravel 11 + Livewire 3 + Tailwind v4 + Vite + routing localisé FR/EN.
2. Modèles + migrations + seeders (Entreprise, Projet, Article, Lead, Temoignage).
3. Layout global : head, meta dynamiques, GA4 + Consent Mode v2, header/footer, bouton WhatsApp flottant.
4. Page Accueil.
5. Pages Entités (gabarit unique paramétré : NIMA Real Estate, Infinite Sky Blue Design, TKD Construction, Vintage Clean).
6. Portfolio filtrable + gabarit fiche projet + sélecteur de devise.
7. Pages Services + Processus.
8. Page Contact (formulaire qualifié + scoring lead + carte) + newsletter double opt-in.
9. Page « Investir au Cameroun » (contenu éditable, données à valider client).
10. Blog (modèle + listing + article + catégories/tags).
11. Mentions légales / RGPD + bandeau cookies (RGPD + loi camerounaise + ANTIC).
12. SEO technique : sitemap.xml, robots.txt, schema.org (LocalBusiness, Project, BreadcrumbList), Open Graph.
13. Passe accessibilité WCAG AA + passe performance (Lighthouse, images, lazy-loading).
14. Sécurité : en-têtes, 2FA admin, durcissement.

---

## Modèles de données — point de départ

- **Entreprise** : nom, slug, description, logo, couleur d'accent, services.
- **Projet** : titre, slug, entité, typologie, lieu, surface, année, budget (montant + devise base), galerie, plans, parti_pris, statut (réalisé / à vendre / en cours), témoignage lié.
- **Article** : titre, slug, contenu, catégories, tags, meta SEO, statut.
- **Lead** : type_projet, surface, budget, lieu, message, source, score, locale.
- **Temoignage** : auteur, fonction, contenu, projet lié, autorisation (bool).
