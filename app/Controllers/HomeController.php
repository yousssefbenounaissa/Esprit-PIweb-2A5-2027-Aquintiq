<?php
namespace App\Controllers;

class HomeController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'home';
    protected string $title = 'Accueil | AQUINTIQ';

    public function index(): void { $this->render('home'); }

    public function notFound(): void { $this->page = '404'; $this->title = '404 | AQUINTIQ'; $this->render('404'); }
}
