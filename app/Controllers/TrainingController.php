<?php
namespace App\Controllers;

/** Front Office – page « Formations » (module training). Le membre responsable remplace le corps de index() par son CRUD réel. */
class TrainingController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'training';
    protected string $title = 'Formations | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
