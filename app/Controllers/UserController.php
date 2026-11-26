<?php
namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use PDOException;

/**
 * Back Office – gestion des utilisateurs (CRUD + changement de rôle). Réservé aux Administrateurs.
 * Route : index.php?page=admin-users  (GET = liste / formulaire, POST action = create | update | delete | role)
 */
class UserController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-users';
    protected string $title = 'Admin – Utilisateurs | AQUINTIQ';

    public function index(): void
    {
        $me = $this->requireRole('Administrateur');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!csrfValid()) { flash('err', 'Session expirée, veuillez réessayer.'); $this->redirect('admin-users'); }
            $this->handle($me);   // redirige toujours (POST → Redirect → GET)
        }

        try {
            $roles = Role::all('id');
            $users = User::all('id');
            $edit  = isset($_GET['edit']) ? User::find((int) $_GET['edit']) : null;
        } catch (PDOException $e) {
            $roles = $users = []; $edit = null;
            flash('err', 'Base de données indisponible : vérifiez config.php et l’import de database/schema.sql.');
        }
        $roleName = array_column($roles, 'name', 'id');
        $this->render('users', ['roles' => $roles, 'users' => $users, 'edit' => $edit, 'roleName' => $roleName,
                                'me' => $me, 'flash' => takeFlash(), 'old' => $_SESSION['old'] ?? [], 'errors' => $_SESSION['errors'] ?? []]);
        unset($_SESSION['old'], $_SESSION['errors']);
    }

    private function handle(array $me): void
    {
        $action = (string) ($_POST['action'] ?? '');
        $id     = (int) ($_POST['id'] ?? 0);
        try {
            match ($action) {
                'create' => $this->save(null),
                'update' => $this->save($id),
                'delete' => $this->delete($id, $me),
                'role'   => $this->changeRole($id, (int) ($_POST['role_id'] ?? 0), $me),
                default  => flash('err', 'Action inconnue.'),
            };
        } catch (PDOException $e) {
            flash('err', ($e->errorInfo[1] ?? 0) === 1062 ? 'Cette adresse e-mail est déjà utilisée.'
                : (($e->errorInfo[1] ?? 0) === 1451 ? 'Suppression impossible : cet utilisateur possède des données liées.' : 'Erreur base de données.'));
        }
        $this->redirect('admin-users');
    }

    /** Validation PHP (la même que le JS) puis INSERT / UPDATE. */
    private function save(?int $id): void
    {
        $d = [
            'name'    => trim((string) ($_POST['name'] ?? '')),
            'email'   => strtolower(trim((string) ($_POST['email'] ?? ''))),
            'phone'   => trim((string) ($_POST['phone'] ?? '')),
            'role_id' => (int) ($_POST['role_id'] ?? 0),
        ];
        $password = (string) ($_POST['password'] ?? '');
        $e = [];
        if (mb_strlen($d['name']) < 2 || mb_strlen($d['name']) > 80)  $e['name'] = 'Nom : 2 à 80 caractères.';
        if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($d['email']) > 120) $e['email'] = 'Adresse e-mail invalide.';
        if ($d['phone'] !== '' && !preg_match('/^[0-9+\s().-]{8,20}$/', $d['phone'])) $e['phone'] = 'Numéro de téléphone invalide.';
        if (!Role::find($d['role_id']))                               $e['role_id'] = 'Rôle invalide.';
        if ($id === null && strlen($password) < 8)                    $e['password'] = 'Mot de passe : 8 caractères minimum.';
        if ($id !== null && $password !== '' && strlen($password) < 8) $e['password'] = 'Mot de passe : 8 caractères minimum.';
        if ($id !== null && !User::find($id))                         $e['name'] = 'Utilisateur introuvable.';
        if (!isset($e['email'])) {
            foreach (User::where('email', $d['email']) as $other) {
                if ((int) $other['id'] !== (int) $id) { $e['email'] = 'Cette adresse e-mail est déjà utilisée.'; break; }
            }
        }
        if ($e) {
            $_SESSION['old'] = $d; $_SESSION['errors'] = $e;
            flash('err', 'Formulaire invalide : corrigez les champs en rouge.');
            $this->redirect($id ? 'admin-users&edit=' . $id : 'admin-users');
        }

        $d['phone'] = $d['phone'] === '' ? null : $d['phone'];
        if ($id === null) {
            User::create($d + ['password_hash' => password_hash($password, PASSWORD_DEFAULT)]);
            flash('ok', 'Utilisateur créé.');
        } else {
            if ($password !== '') $d['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
            User::update($id, $d);
            if ($id === (int) $_SESSION['user']['id']) {   // met à jour la session de l'admin lui-même
                $_SESSION['user']['name'] = $d['name']; $_SESSION['user']['email'] = $d['email'];
                $_SESSION['user']['role'] = Role::find($d['role_id'])['name'];
            }
            flash('ok', 'Utilisateur modifié.');
        }
    }

    private function delete(int $id, array $me): void
    {
        $u = User::find($id);
        if (!$u)                          { flash('err', 'Utilisateur introuvable.'); return; }
        if ($id === (int) $me['id'])      { flash('err', 'Vous ne pouvez pas supprimer votre propre compte.'); return; }
        if ($this->isLastAdmin($u))       { flash('err', 'Impossible de supprimer le dernier administrateur.'); return; }
        User::delete($id);
        flash('ok', 'Utilisateur supprimé.');
    }

    private function changeRole(int $id, int $roleId, array $me): void
    {
        $u = User::find($id); $r = Role::find($roleId);
        if (!$u || !$r)                   { flash('err', 'Utilisateur ou rôle invalide.'); return; }
        if ($id === (int) $me['id'] && $r['name'] !== 'Administrateur') { flash('err', 'Vous ne pouvez pas retirer votre propre rôle d’administrateur.'); return; }
        if ($r['name'] !== 'Administrateur' && $this->isLastAdmin($u)) { flash('err', 'Il doit rester au moins un administrateur.'); return; }
        User::update($id, ['role_id' => $roleId]);
        flash('ok', 'Rôle de ' . $u['name'] . ' : ' . $r['name'] . '.');
    }

    private function isLastAdmin(array $u): bool
    {
        $admin = Role::where('name', 'Administrateur')[0] ?? null;
        if (!$admin || (int) $u['role_id'] !== (int) $admin['id']) return false;
        return count(User::where('role_id', (int) $admin['id'])) <= 1;
    }
}
