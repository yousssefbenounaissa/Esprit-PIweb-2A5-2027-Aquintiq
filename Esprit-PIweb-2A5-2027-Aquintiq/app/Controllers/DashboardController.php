<?php
namespace App\Controllers;

class DashboardController extends Controller
{
    protected string $area  = 'back';
    protected string $page  = 'admin-dashboard';
    protected string $title = 'Tableau de bord | AQUINTIQ';

    public function index(): void { $this->requireRole('Administrateur'); $this->render('dashboard', [], 'dashboard_scripts'); }
}
