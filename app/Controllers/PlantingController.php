<?php
namespace App\Controllers;

/** Front Office – page « Plans de plantation » (module planting). Le membre responsable remplace le corps de index() par son CRUD réel. */
class PlantingController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'planting';
    protected string $title = 'Plans de plantation | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
