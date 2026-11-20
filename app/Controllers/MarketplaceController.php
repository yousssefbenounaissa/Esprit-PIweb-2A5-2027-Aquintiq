<?php
namespace App\Controllers;

/** Front Office – page « Marketplace » (module marketplace). Le membre responsable remplace le corps de index() par son CRUD réel. */
class MarketplaceController extends Controller
{
    protected string $area  = 'front';
    protected string $page  = 'marketplace';
    protected string $title = 'Marketplace | AQUINTIQ';

    public function index(): void
    {
        $this->render('module', ['key' => $this->page, 'm' => modules()[$this->page]]);
    }
}
