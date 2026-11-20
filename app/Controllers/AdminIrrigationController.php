<?php
namespace App\Controllers;

/** Back Office – gestion du module « Irrigation » : 2 entités liées par clé étrangère. */
class AdminIrrigationController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-irrigation';
    protected string $title = 'Admin – Irrigation | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'irrigation', 'm' => modules()['irrigation']]);
    }
}
