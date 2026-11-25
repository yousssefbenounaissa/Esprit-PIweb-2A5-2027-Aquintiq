<?php
// Atelier étape 11 : une page = une clé => [Contrôleur, méthode]
return [
  // ---------- Front Office ----------
  'home'    => ['HomeController', 'index'],
  'about'   => ['AboutController', 'index'],
  'contact' => ['ContactController', 'index'],
  '404'     => ['HomeController', 'notFound'],
  'farms' => ['ModuleController', 'front'],
  'irrigation' => ['ModuleController', 'front'],
  'marketplace' => ['ModuleController', 'front'],
  'planting' => ['ModuleController', 'front'],
  'training' => ['ModuleController', 'front'],
  'equipment' => ['ModuleController', 'front'],
  'login'   => ['AuthController', 'login'],
  'logout'  => ['AuthController', 'logout'],
  'account' => ['AccountController', 'index'],
  // ---------- Back Office ----------
  'dashboard'       => ['DashboardController', 'index'],   // atelier : index.php?page=dashboard
  'admin-dashboard' => ['DashboardController', 'index'],
  'admin-users' => ['UserController', 'index'],
  'admin-farms' => ['ModuleController', 'back'],
  'admin-irrigation' => ['ModuleController', 'back'],
  'admin-marketplace' => ['ModuleController', 'back'],
  'admin-planting' => ['ModuleController', 'back'],
  'admin-training' => ['ModuleController', 'back'],
  'admin-equipment' => ['ModuleController', 'back'],
];
