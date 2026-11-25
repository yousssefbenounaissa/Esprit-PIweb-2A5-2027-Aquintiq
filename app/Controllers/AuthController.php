<?php
namespace App\Controllers;

use App\Models\Role;
use App\Models\User;
use PDOException;

/**
 * Connexion / inscription / déconnexion.
 * Routes : index.php?page=login (GET = affichage, POST = envoi des formulaires) et index.php?page=logout
 */
class AuthController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'login';
    protected string $title = 'Connexion | AQUINTIQ';

    public function login(): void
    {
        $this->startSession();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            if (!empty($_SESSION['user'])) $this->redirectByRole($_SESSION['user']['role']);
            $this->show('login');
            return;
        }

        if (!hash_equals($_SESSION['csrf'], (string) ($_POST['csrf'] ?? ''))) {
            $this->show('login', 'Session expirée, veuillez réessayer.');
            return;
        }

        ($_POST['form_type'] ?? 'login') === 'register' ? $this->register() : $this->authenticate();
    }

    public function logout(): void
    {
        $this->startSession();
        $_SESSION = [];
        session_destroy();
        header('Location: ' . url('login'));
        exit;
    }

    private function authenticate(): void
    {
        $email    = strtolower(trim((string) ($_POST['email'] ?? '')));
        $password = (string) ($_POST['password'] ?? '');

        try {
            $user = $email !== '' ? (User::where('email', $email)[0] ?? null) : null;
            $role = $user ? (Role::find((int) $user['role_id'])['name'] ?? 'Agriculteur') : null;
        } catch (PDOException $e) {
            $this->show('login', $this->dbError(), ['email' => $email]);
            return;
        }

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->show('login', 'E-mail ou mot de passe incorrect.', ['email' => $email]);
            return;
        }

        $this->openSession($user, $role);
    }

    private function register(): void
    {
        $name     = trim((string) ($_POST['name'] ?? ''));
        $email    = strtolower(trim((string) ($_POST['email'] ?? '')));
        $password = (string) ($_POST['password'] ?? '');
        $old      = ['name' => $name, 'email' => $email];

        $error = null;
        if (mb_strlen($name) < 2 || mb_strlen($name) > 80)      $error = 'Entrez votre nom complet.';
        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))     $error = 'Entrez une adresse e-mail valide.';
        elseif (mb_strlen($email) > 120)                        $error = 'Adresse e-mail trop longue.';
        elseif (strlen($password) < 8)                          $error = 'Le mot de passe doit contenir au moins 8 caractères.';
        if ($error) { $this->show('register', $error, $old); return; }

        try {
            if (User::where('email', $email)) {
                $this->show('register', 'Cette adresse e-mail est déjà utilisée.', $old);
                return;
            }
            // Le rôle n'est jamais choisi par le formulaire : tout nouveau compte est « Agriculteur ».
            $role = Role::where('name', 'Agriculteur')[0] ?? null;
            if (!$role) {
                $this->show('register', 'Rôles introuvables : importez database/schema.sql.', $old);
                return;
            }
            $id = User::create([
                'role_id'       => (int) $role['id'],
                'name'          => $name,
                'email'         => $email,
                'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            ]);
        } catch (PDOException $e) {
            $this->show('register', ($e->errorInfo[1] ?? 0) === 1062 ? 'Cette adresse e-mail est déjà utilisée.' : $this->dbError(), $old);
            return;
        }

        $this->openSession(['id' => $id, 'name' => $name, 'email' => $email], 'Agriculteur');
    }

    /** Ouvre la session puis redirige selon le rôle. */
    private function openSession(array $user, string $role): void
    {
        session_regenerate_id(true);
        $_SESSION['user'] = ['id' => (int) $user['id'], 'name' => $user['name'], 'email' => $user['email'], 'role' => $role, 'photo' => $user['photo'] ?? null];
        $this->redirectByRole($role);
    }

    private function redirectByRole(string $role): void
    {
        header('Location: ' . url($role === 'Administrateur' ? 'admin-dashboard' : 'home'));
        exit;
    }

    private function startSession(): void
    {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $_SESSION['csrf'] ??= bin2hex(random_bytes(32));
    }

    private function dbError(): string
    {
        return 'Base de données indisponible : vérifiez config.php et l’import de database/schema.sql.';
    }

    /** Affiche la page de connexion seule (sans navbar ni footer). $mode : 'login' ou 'register'. */
    private function show(string $mode, ?string $error = null, array $old = []): void
    {
        $csrf  = $_SESSION['csrf'];
        $title = $this->title;
        require dirname(__DIR__, 2) . '/FrontOffice/pages/login.php';
    }
}
