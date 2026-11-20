<?php
$currentPage = $currentPage ?? '';
$frontModules = array_filter(modules(), fn($m) => $m['front']);
$inModules = array_key_exists($currentPage, $frontModules);
?>
<!-- Navbar Start -->
<header class="nav">
  <div class="wrap nav-in">
    <a class="brand" href="<?= url('home') ?>"><img src="<?= asset('front/img/logo.png') ?>" alt="AQUINTIQ"></a>
    <button class="nav-toggle" type="button" aria-label="Menu" aria-expanded="false"><?= icon('menu') ?></button>
    <nav class="nav-links" id="navLinks">
      <a class="<?= navActive('home', $currentPage) ?>" href="<?= url('home') ?>">Accueil</a>
      <div class="has-sub">
        <a class="<?= $inModules ? 'active' : '' ?>" href="#" tabindex="0">Modules <span class="caret">▾</span></a>
        <div class="sub">
          <?php foreach ($frontModules as $k => $m): ?>
            <a class="<?= navActive($k, $currentPage) ?>" href="<?= url($k) ?>"><?= icon($m['icon'], 18) ?><?= e($m['label']) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <a class="<?= navActive('about', $currentPage) ?>" href="<?= url('about') ?>">À propos</a>
      <a class="<?= navActive('contact', $currentPage) ?>" href="<?= url('contact') ?>">Contact</a>
      <a class="nav-cta" href="<?= url('admin-dashboard') ?>">Espace admin</a>
    </nav>
  </div>
</header>
<!-- Navbar End -->
