# Intégration – correspondance avec l'atelier

| Étape atelier | Où dans le projet |
|---|---|
| Structure MVC + point d'entrée | `index.php`, `config.php`, `app/` |
| Assets déplacés dans `assets/` | `assets/{css,js,img,lib}` ; `asset()` dans `helpers.php` |
| Front : blocs communs → `includes/` | `FrontOffice/includes/{head,spinner,navbar,footer,scripts}.php` |
| Front : `layout.php` assemble les includes | `FrontOffice/layout.php` |
| Menu actif (`navActive`) | `helpers.php`, `includes/navbar.php` |
| Back : blocs communs → `partials/` | `BackOffice/partials/{head,sidebar,header,footer,scripts}.php` |
| Back : `layout.php` | `BackOffice/layout.php` |
| Fonctions sidebar `isActive`, `isOpen`, `isCollapsed`, `groupIsExpanded` | `helpers.php`, `partials/sidebar.php` (groupe « Modules » repliable) |
| Contrôleur de base `render()` | `app/Controllers/Controller.php` |
| 1 page = 1 vue + 1 contrôleur (les 13 pages « module » partagent `ModuleController`) | `app/Controllers/*Controller.php`, `FrontOffice/pages/ et BackOffice/pages/` |
| Routes | `app/routes.php` (liste explicite, `?page=dashboard` fonctionne) |
| Modèles | `app/Models/Model.php` (CRUD générique) + 1 classe par entité |
| Base de données | `database/schema.sql` |

## Pour chaque membre
1. Dans votre contrôleur (ex. `FarmsController`, `AdminFarmsController`) : remplacez le corps de `index()` par vos appels aux modèles (`Farm::all()`, `Plot::where('farm_id', $id)`…).
2. Créez vos vues dans `FrontOffice/pages/` et `BackOffice/pages/` (uniquement le HTML spécifique, jamais head/footer).
3. Pour une nouvelle page : vue + contrôleur (`$area`, `$page`, `$title`) + une ligne dans `routes.php`.
4. Importez `database/schema.sql` dans phpMyAdmin.
