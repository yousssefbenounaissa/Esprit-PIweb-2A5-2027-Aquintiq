# Partie 2 – Inscription et connexion

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `app/Controllers/AuthController.php (login, register, authenticate, openSession)`
- `FrontOffice/pages/login.php`
- `assets/js/login.js`
- `assets/js/login-scene.js`
- `assets/css/login.css`

## Comment ça marche
- `login()` : GET affiche la page ; POST vérifie le jeton CSRF puis appelle `register()` ou `authenticate()`.
- `authenticate()` : cherche l'utilisateur par e-mail, vérifie `password_verify`, message d'erreur identique si l'e-mail ou le mot de passe est faux.
- `register()` : valide nom (2–80), e-mail, mot de passe (≥ 8), refuse un e-mail déjà utilisé, hache avec `password_hash`. Le rôle est toujours forcé à « Agriculteur » : pas d'auto-promotion en admin.
- `openSession()` : `session_regenerate_id(true)` (contre la fixation de session), puis `$_SESSION['user']` = id, nom, e-mail, rôle, photo. Redirection selon le rôle (admin → Back Office, sinon Front Office).
- `login.js` : validation JS (e-mail, nom ≥ 2, mot de passe ≥ 8) avant l'envoi ; PHP refait les mêmes contrôles.

## Questions probables à la validation
- Pourquoi `session_regenerate_id` ?
- Pourquoi le même message d'erreur pour e-mail ou mot de passe faux ?
- Pourquoi valider aussi côté PHP alors que le JS existe ?

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
