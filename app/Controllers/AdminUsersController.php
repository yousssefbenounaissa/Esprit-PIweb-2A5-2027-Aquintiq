<?php
namespace App\Controllers;

/** Back Office – gestion du module « Utilisateurs » : 2 entités liées par clé étrangère. */
class AdminUsersController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-users';
    protected string $title = 'Admin – Utilisateurs | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => 'users', 'm' => modules()['users']]);
    }
}
