<?php
namespace App\Controllers;

/** Front Office – page « Fermes & Parcelles » (module farms). Le membre responsable remplace le corps de index() par son CRUD réel. */
class FarmsController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'farms';
    protected string $title = 'Fermes & Parcelles | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
