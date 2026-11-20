<?php
namespace App\Controllers;

class ContactController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'contact';
    protected string $title = 'Contact | AQUINTIQ';

    public function index(): void { $this->render('contact'); }
}
