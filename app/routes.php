<?php
// Atelier étape 11 : une page = une clé => [Contrôleur, méthode]
return [
  // ---------- Front Office ----------
  'home'    => ['HomeController', 'index'],
  'about'   => ['AboutController', 'index'],
  'contact' => ['ContactController', 'index'],
  '404'     => ['HomeController', 'notFound'],
  'farms' => ['FarmsController', 'index'],
  'irrigation' => ['IrrigationController', 'index'],
  'marketplace' => ['MarketplaceController', 'index'],
  'planting' => ['PlantingController', 'index'],
  'training' => ['TrainingController', 'index'],
  'equipment' => ['EquipmentController', 'index'],
  // ---------- Back Office ----------
  'dashboard'       => ['DashboardController', 'index'],   // atelier : index.php?page=dashboard
  'admin-dashboard' => ['DashboardController', 'index'],
  'admin-users' => ['AdminUsersController', 'index'],
  'admin-farms' => ['AdminFarmsController', 'index'],
  'admin-irrigation' => ['AdminIrrigationController', 'index'],
  'admin-marketplace' => ['AdminMarketplaceController', 'index'],
  'admin-planting' => ['AdminPlantingController', 'index'],
  'admin-training' => ['AdminTrainingController', 'index'],
  'admin-equipment' => ['AdminEquipmentController', 'index'],
];
