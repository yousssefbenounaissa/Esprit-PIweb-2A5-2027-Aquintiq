<?php
/** Pastille de profil en haut à droite : photo, sinon initiales. Lit la session ($_SESSION['user']). */
$me = $_SESSION['user'] ?? null;
?>
<?php if ($me): ?>
<details class="user-menu" id="userMenu">
  <summary class="avatar-btn" aria-label="Mon compte : <?= e($me['name']) ?>"><?= avatarHtml($me) ?></summary>
  <div class="user-pop">
    <div class="user-pop-head">
      <?= avatarHtml($me, 'lg') ?>
      <div>
        <strong><?= e($me['name']) ?></strong>
        <small><?= e($me['email']) ?></small>
        <?= chip($me['role']) ?>
      </div>
    </div>
    <a href="<?= e(url('account')) ?>"><?= icon('users', 18) ?> Paramètres du compte</a>
    <?php if (($me['role'] ?? '') === 'Administrateur'): ?>
      <a href="<?= e(url('admin-dashboard')) ?>"><?= icon('grid', 18) ?> Espace admin</a>
    <?php endif; ?>
    <form method="post" action="<?= e(url('logout')) ?>" class="logout-form"><?= csrfField() ?><button type="submit"><?= icon('out', 18) ?> Déconnexion</button></form>
  </div>
</details>
<script src="<?= asset('js/avatar.js') ?>" defer></script>
<?php else: ?>
<a class="btn-login" href="<?= e(url('login')) ?>">Connexion</a>
<?php endif; ?>
