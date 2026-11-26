<?php
// $currentPage est fourni par le Controller (voir app/Controllers/Controller.php)
$currentPage = $currentPage ?? 'admin-dashboard';
$modulePages = array_map(fn($k) => 'admin-' . $k, array_keys(modules()));
?>
<aside class="sidebar" id="sidebar">
  <a class="sb-logo" href="<?= url('admin-dashboard') ?>"><img src="<?= asset('img/logo.png') ?>" alt="AQUINTIQ"></a>
  <nav class="sb-nav">
    <a class="<?= isActive('admin-dashboard', $currentPage) ?>" href="<?= url('admin-dashboard') ?>"><?= icon('grid', 20) ?><span>Tableau de bord</span></a>

    <button type="button" class="sb-group <?= isCollapsed($modulePages, $currentPage) ?>" data-toggle="modules" aria-expanded="<?= groupIsExpanded($modulePages, $currentPage) ?>">
      <span>Modules</span><?= icon('arrow', 14) ?>
    </button>
    <div class="sb-sub <?= isOpen($modulePages, $currentPage) ?>" id="modules">
      <?php foreach (modules() as $k => $m): ?>
        <a class="<?= isActive('admin-' . $k, $currentPage) ?>" href="<?= url('admin-' . $k) ?>"><?= icon($m['icon'], 20) ?><span><?= e($m['label']) ?></span></a>
      <?php endforeach; ?>
    </div>

    <p class="sb-title">Site</p>
    <a href="<?= url('home') ?>"><?= icon('out', 20) ?><span>Voir le Front Office</span></a>
  </nav>
</aside>
