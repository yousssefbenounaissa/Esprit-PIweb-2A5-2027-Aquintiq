<?php
namespace App\Controllers;

/** Back Office – gestion du module « Fermes & Parcelles » : 2 entités liées par clé étrangère. */
class AdminFarmsController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-farms';
    protected string $title = 'Admin – Fermes & Parcelles | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'farms', 'm' => modules()['farms']]);
    }
}
