<header class="topbar">
  <button id="menu-toggle" class="icon-btn" type="button" aria-label="Menu"><?= icon('menu', 22) ?></button>
  <label class="tb-search"><?= icon('search', 18) ?><input type="text" placeholder="Rechercher..."></label>
  <div class="tb-right">
    <details class="menu"><summary class="icon-btn" aria-label="Notifications"><?= icon('bell', 22) ?><i class="dot"></i></summary>
      <div class="menu-box"><p><b>Sol trop sec</b><br>Parcelle B, Ferme Ben Salah</p><p><b>Batterie faible</b><br>Pompe solaire 2</p><p><b>Capteur hors ligne</b><br>Parcelle C</p></div></details>
    <details class="menu"><summary class="user"><span class="avatar"><?= e(initials($_SESSION['user']['name'] ?? 'AD')) ?></span><span class="uname"><?= e($_SESSION['user']['name'] ?? 'Administrateur') ?></span></summary>
      <div class="menu-box"><a href="<?= url('home') ?>">Front Office</a><form method="post" action="<?= e(url('logout')) ?>" class="logout-form"><?= csrfField() ?><button type="submit">Déconnexion</button></form></div></details>
  </div>
</header>
