# Partie 5 – CRUD utilisateurs (Back Office)

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `app/Controllers/UserController.php`
- `BackOffice/pages/users.php`
- `assets/js/users.js`

## Comment ça marche
- Route `admin-users` : GET = liste + formulaire ; POST avec `action` = `create`, `update`, `delete` ou `role`.
- Validation PHP : nom 2–80, e-mail valide et unique, téléphone au bon format, rôle existant, mot de passe ≥ 8 (obligatoire à la création, facultatif à la modification).
- Règles métier : on ne peut pas supprimer son propre compte, ni retirer son propre rôle d'administrateur, ni supprimer ou rétrograder le dernier administrateur.
- Après un POST : redirection vers la liste (POST → Redirect → GET) avec un message flash.
- Sortie échappée avec `e()` (htmlspecialchars) dans la vue : protection XSS. `users.js` : envoi du changement de rôle et confirmation avant suppression.

## Questions probables à la validation
- Pourquoi empêcher la suppression du dernier administrateur ?
- Pourquoi rediriger après un POST ?
- Comment la vue évite-t-elle le XSS ?

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
