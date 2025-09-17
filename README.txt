# Overlay de projet — Admin + LESS + Service Slug
(date: 2025-09-16)

Dézippez **ce dossier** à la RACINE de votre projet **en remplaçant** les fichiers existants.
Ensuite, exécutez les 3 commandes ci-dessous et c’est prêt.

## Étapes (3 commandes)
1) PHP (slugger) :
   ```bash
   composer require symfony/string
   ```
2) BDD (slug unique) :
   ```bash
   php bin/console make:migration
   php bin/console doctrine:migrations:migrate
   ```
3) CSS (LESS -> CSS via Gulp) :
   ```bash
   npm install
   npx gulp less       # build ponctuel
   npx gulp            # watch (optionnel)
   ```

## Ce que l’overlay apporte
- **Service `SlugService`** centralisé, avec unicité (`-2`, `-3`, …).
- **AdminNewsController** mis à jour pour générer le slug + flashs d’erreurs.
- **NewsType** corrigé (`Newspics` avec la bonne casse) + champ `title` prêt.
- **Partiel Twig `alerts.html.twig`** et templates News (index/new/edit) propres.
- **Arbo LESS** complète sous `assets/styles/...` + **gulpfile.js** pour compiler vers `public/assets/css/admin.css`.
- **Aucun Webpack Encore requis** (vous êtes déjà sur Gulp).

## Lien CSS côté Twig
Les pages d’admin incluent `admin.css` ainsi :
```twig
{{% block stylesheets %}}
  {{% parent() %}}
  <link rel="stylesheet" href="{{{{ asset('assets/css/admin.css') }}}}">
{{% endblock %}}
```

> Remarque : si vous avez encore un ancien `crud.css`, vous pouvez le retirer du layout une fois la migration validée.

Bon dev !
