<?php
namespace App\Controllers;

/**
 * Pages « module » du Front Office (farms, irrigation…) et du Back Office (admin-farms, admin-irrigation…).
 * Un seul contrôleur pour les 13 pages : la clé du module est lue dans l'URL (?page=farms ou ?page=admin-farms).
 * Quand un membre de l'équipe écrit le vrai CRUD de son module, il crée son propre contrôleur
 * et remplace la ligne correspondante dans app/routes.php.
 */
class ModuleController extends Controller
{
    public function front(): void { $this->show('front', ''); }

    public function back(): void { $this->requireRole('Administrateur'); $this->show('back', 'admin-'); }

    private function show(string $area, string $prefix): void
    {
        $page = preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['page'] ?? ''));
        $key  = ($prefix !== '' && str_starts_with($page, $prefix)) ? substr($page, strlen($prefix)) : $page;
        $all  = modules();

        if (!isset($all[$key]) || ($area === 'front' && empty($all[$key]['front']))) {
            http_response_code(404);
            (new HomeController())->notFound();
            return;
        }

        $this->area  = $area;
        $this->page  = $page;
        $this->title = ($area === 'back' ? 'Admin – ' : '') . $all[$key]['label'] . ' | AQUINTIQ';
        $this->render('module', ['key' => $key, 'm' => $all[$key]]);
    }
}
