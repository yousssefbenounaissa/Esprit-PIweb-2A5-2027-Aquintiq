<?php
namespace App\Controllers;

class AboutController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'about';
    protected string $title = 'À propos | AQUINTIQ';

    public function index(): void { $this->render('about'); }
}
