<?php
namespace App\Controllers;

/** Back Office – gestion du module « Formations » : 2 entités liées par clé étrangère. */
class AdminTrainingController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-training';
    protected string $title = 'Admin – Formations | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'training', 'm' => modules()['training']]);
    }
}
