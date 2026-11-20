<?php
namespace App\Controllers;

/** Back Office – gestion du module « Partage d\'équipements » : 2 entités liées par clé étrangère. */
class AdminEquipmentController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-equipment';
    protected string $title = 'Admin – Partage d\'équipements | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'equipment', 'm' => modules()['equipment']]);
    }
}
