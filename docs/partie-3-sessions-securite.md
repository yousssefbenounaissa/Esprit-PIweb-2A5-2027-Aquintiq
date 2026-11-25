# Partie 3 – Sessions et sécurité

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `index.php`
- `app/helpers.php (csrfToken, csrfField, csrfValid, flash, destroySession)`
- `AuthController::logout`

## Comment ça marche
- `index.php` envoie les en-têtes : `X-Frame-Options: DENY`, `X-Content-Type-Options: nosniff`, `Referrer-Policy`, `Content-Security-Policy`.
- Session durcie : `use_strict_mode`, cookies `HttpOnly` + `SameSite=Lax`, `use_only_cookies`.
- Expiration après 30 minutes d'inactivité via `$_SESSION['last_activity']`.
- CSRF : un jeton aléatoire en session, champ caché dans chaque formulaire POST, comparé avec `hash_equals`.
- Déconnexion : POST + jeton CSRF ; `destroySession()` vide `$_SESSION`, supprime le cookie `PHPSESSID` et détruit la session.

## Questions probables à la validation
- Qu'est-ce qu'une attaque CSRF et comment le jeton l'empêche ?
- Pourquoi `hash_equals` plutôt que `==` ?
- À quoi servent HttpOnly et SameSite ?
- Pourquoi la déconnexion est un POST et pas un simple lien ?

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
