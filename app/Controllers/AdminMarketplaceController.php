<?php
namespace App\Controllers;

/** Back Office – gestion du module « Marketplace » : 2 entités liées par clé étrangère. */
class AdminMarketplaceController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-marketplace';
    protected string $title = 'Admin – Marketplace | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'marketplace', 'm' => modules()['marketplace']]);
    }
}
