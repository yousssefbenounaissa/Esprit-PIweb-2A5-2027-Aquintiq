# Partie 6 – Validation PHP/JS et formulaire Contact

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `assets/js/validate.js`
- `app/Controllers/ContactController.php`
- `FrontOffice/pages/contact.php`
- `app/Models/ContactMessage.php`

## Comment ça marche
- `validate.js` : validation générique côté client pour les formulaires `data-validate` (obligatoire, min/max, e-mail, téléphone) avec messages sous les champs.
- `ContactController` : vérifie le jeton CSRF, valide nom (2–80), e-mail, objet (≤ 120), message (10–2000), puis enregistre dans la table `contact_message`.
- En cas d'erreur, la page est réaffichée avec les valeurs saisies et les messages ; en cas de succès : message flash + redirection.
- Règle clé : le JS est un confort, la vraie validation est celle de PHP.

## Questions probables à la validation
- Pourquoi valider côté serveur alors que le JS valide déjà ?
- Comment sont évitées l'injection SQL et le XSS dans ce formulaire ?
- Que fait `novalidate` sur le formulaire ?

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
