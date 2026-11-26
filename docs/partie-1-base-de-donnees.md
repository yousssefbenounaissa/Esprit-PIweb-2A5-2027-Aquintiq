# Partie 1 – Base de données et modèles

**Auteur :** _(votre nom)_  
**Branche :** _(votre branche)_

## Fichiers de cette partie
- `database/schema.sql`
- `database/seed_admin.sql`
- `database/add_photo.sql`
- `app/Models/Model.php`
- `app/Models/User.php`
- `app/Models/Role.php`

## Comment ça marche
- La base `aquintiq` contient la table `role` (Agriculteur=1, Technicien=2, Administrateur=3) et la table `user` (role_id, name, email, password_hash, phone, photo). L'e-mail est unique.
- `seed_admin.sql` / fin de `schema.sql` : crée l'administrateur par défaut. Le mot de passe est stocké haché (`password_hash`), jamais en clair.
- `Model.php` : connexion PDO + CRUD générique (`all`, `find`, `where`, `create`, `update`, `delete`). `ATTR_EMULATE_PREPARES => false` pour de vraies requêtes préparées ; `ERRMODE_EXCEPTION` pour lever les erreurs.
- `$fillable` limite les colonnes écrites : on ne peut pas modifier une colonne non prévue.

## Questions probables à la validation
- Pourquoi des requêtes préparées ? (injection SQL : les valeurs sont envoyées séparément du SQL)
- Pourquoi `role` est une table et non un ENUM ? (rôles extensibles, clé étrangère)
- Pourquoi stocker un hash ? (une fuite de la base ne révèle pas les mots de passe)

## Ma part de travail et l'usage de l'IA
_À compléter par l'auteur : ce que j'ai fait, ce que l'IA a proposé, ce que j'ai relu, corrigé ou adapté._
