<?php
namespace App\Controllers;

/** Back Office – gestion du module « Plans de plantation » : 2 entités liées par clé étrangère. */
class AdminPlantingController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-planting';
    protected string $title = 'Admin – Plans de plantation | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'planting', 'm' => modules()['planting']]);
    }
}
