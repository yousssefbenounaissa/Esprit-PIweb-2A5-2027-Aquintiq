<?php
namespace App\Controllers;

/** Front Office – page « Irrigation » (module irrigation). Le membre responsable remplace le corps de index() par son CRUD réel. */
class IrrigationController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'irrigation';
    protected string $title = 'Irrigation | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
