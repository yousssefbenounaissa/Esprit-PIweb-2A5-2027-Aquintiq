# Partie 7 – Compte utilisateur et intégration

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `app/Controllers/AccountController.php`
- `FrontOffice/pages/account.php`
- `FrontOffice/includes/avatar.php`
- `assets/js/avatar.js, assets/css/avatar.css`
- `BackOffice/partials/header.php`
- `README.md`

## Comment ça marche
- Page « Paramètres du compte » : modifier le nom et le téléphone, ajouter ou supprimer la photo de profil.
- Upload sécurisé : contrôle du type réel avec `getimagesize`, taille maximale, redimensionnement GD, stockage dans `uploads/avatars` (dossier non exécutable via `.htaccess`).
- Avatar : photo si elle existe, sinon initiales ; menu avec Paramètres, Espace admin (admin) et Déconnexion (POST + CSRF).
- `README.md` : installation XAMPP, configuration de `config.php`, import de `schema.sql`, comptes de démonstration.

## Questions probables à la validation
- Pourquoi contrôler le type réel du fichier et pas seulement l'extension ?
- Pourquoi interdire l'exécution de PHP dans `uploads` ?
- Comment lancer le projet sur une autre machine ?

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
