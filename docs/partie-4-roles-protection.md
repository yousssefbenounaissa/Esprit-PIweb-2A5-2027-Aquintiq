# Partie 4 – Rôles et protection du Back Office

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `app/Controllers/Controller.php (requireAuth, requireRole, redirect)`
- `app/Controllers/DashboardController.php`
- `app/Controllers/ModuleController.php (back)`
- `FrontOffice/pages/403.php`
- `FrontOffice/includes/navbar.php (bouton Espace admin)`

## Comment ça marche
- `requireAuth()` : pas de session → redirection vers la connexion.
- `requireRole('Administrateur')` : mauvais rôle → réponse HTTP 403 et page 403.
- Le Back Office (dashboard et modules `admin-*`) appelle `requireRole` : la vérification se fait côté serveur à chaque requête, pas seulement à la connexion.
- Le bouton « Espace admin » n'est affiché qu'aux administrateurs, mais l'accès réel est protégé par `requireRole`.

## Questions probables à la validation
- Pourquoi vérifier le rôle à chaque requête et pas seulement à la connexion ?
- Différence entre authentification et autorisation ?
- Que se passe-t-il si un Agriculteur tape l'adresse du Back Office ? (403)

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
