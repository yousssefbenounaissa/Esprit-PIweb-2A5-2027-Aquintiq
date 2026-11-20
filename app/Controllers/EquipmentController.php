<?php
namespace App\Controllers;

/** Front Office – page « Partage d\'équipements » (module equipment). Le membre responsable remplace le corps de index() par son CRUD réel. */
class EquipmentController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'equipment';
    protected string $title = 'Partage d\'équipements | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
