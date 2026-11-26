<?php
namespace App\Controllers;

abstract class Controller
{
    protected string $area  = 'front';          // 'front' (Front Office) ou 'back' (Back Office)
    protected string $page  = 'home';           // clé de page courante (menu actif)
    protected string $title = 'AQUINTIQ';

    /** Exige une session ouverte, sinon redirection vers la connexion. */
    protected function requireAuth(): array
    {
        if (empty($_SESSION['user'])) { header('Location: ' . url('login')); exit; }
        return $_SESSION['user'];
    }

    /** Exige un rôle précis, sinon réponse HTTP 403. */
    protected function requireRole(string $role): array
    {
        $u = $this->requireAuth();
        if (($u['role'] ?? '') !== $role) {
            http_response_code(403);
            $this->area = 'front'; $this->page = '403'; $this->title = '403 | AQUINTIQ';
            $this->render('403');
            exit;
        }
        return $u;
    }

    protected function redirect(string $page): never { header('Location: ' . url($page)); exit; }

    protected function capture(string $file, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        ob_start(); require $file; return (string) ob_get_clean();
    }

    /** Rend {FrontOffice|BackOffice}/pages/{view}.php dans {FrontOffice|BackOffice}/layout.php */
    protected function render(string $view, array $data = [], ?string $scriptsView = null): void
    {
        $base         = dirname(__DIR__, 2) . '/' . ($this->area === 'back' ? 'BackOffice' : 'FrontOffice');
        $content      = $this->capture("$base/pages/$view.php", $data);
        $extraScripts = $scriptsView ? $this->capture("$base/pages/$scriptsView.php", $data) : '';
        $title        = $this->title;
        $currentPage  = $this->page;
        require_once "$base/layout.php";
    }
}
