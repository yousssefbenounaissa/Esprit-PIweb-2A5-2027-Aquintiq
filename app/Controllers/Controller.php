<?php
namespace App\Controllers;

abstract class Controller
{
    protected string $area  = 'front';          // 'front' (Front Office) ou 'back' (Back Office)
    protected string $page  = 'home';           // clé de page courante (menu actif)
    protected string $title = 'AQUINTIQ';

    protected function capture(string $file, array $data = []): string
    {
        extract($data, EXTR_SKIP);
        ob_start(); require $file; return (string) ob_get_clean();
    }

    /** Rend Views/{area}/pages/{view}.php dans Views/{area}/layout.php */
    protected function render(string $view, array $data = [], ?string $scriptsView = null): void
    {
        $base         = __DIR__ . '/../Views/' . $this->area;
        $content      = $this->capture("$base/pages/$view.php", $data);
        $extraScripts = $scriptsView ? $this->capture("$base/pages/$scriptsView.php", $data) : '';
        $title        = $this->title;
        $currentPage  = $this->page;
        require_once "$base/layout.php";
    }
}
