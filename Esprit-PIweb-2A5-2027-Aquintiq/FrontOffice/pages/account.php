<?php /** Paramètres du compte. Variables : $u (ligne user), $csrf, $flash */ ?>
<section class="page-head">
  <div class="wrap">
    <p class="kicker"><?= icon('users', 16) ?> Mon compte</p>
    <h1>Paramètres du compte</h1>
    <p class="lead">Changez votre photo de profil et vos informations.</p>
  </div>
</section>

<div class="wrap">
  <?php if (!empty($flash)): ?>
    <div class="flash <?= e($flash['type']) ?>" role="status"><?= e($flash['text']) ?></div>
  <?php endif; ?>

  <form class="form acct" method="post" action="<?= e(url('account')) ?>" enctype="multipart/form-data" data-validate novalidate>
    <input type="hidden" name="csrf" value="<?= e($csrf) ?>">

    <div class="acct-photo">
      <div id="avatarPreview"><?= avatarHtml($u, 'xl') ?></div>
      <label for="photoInput">Photo de profil</label>
      <input type="file" id="photoInput" name="photo" accept="image/jpeg,image/png,image/webp">
      <p class="acct-hint" id="photoMsg">JPG, PNG ou WebP, 2 Mo maximum. Sans photo, vos initiales s’affichent.</p>
      <?php if (!empty($u['photo'])): ?>
        <label class="acct-check"><input type="checkbox" name="remove_photo" value="1"> Supprimer ma photo</label>
      <?php endif; ?>
    </div>

    <div class="acct-fields">
      <label>Nom complet
        <input type="text" name="name" required maxlength="80" data-label="Le nom" data-min="2" data-max="80" value="<?= e($u['name'] ?? '') ?>" autocomplete="name">
      </label>
      <label>Adresse e-mail
        <input type="email" value="<?= e($u['email'] ?? '') ?>" disabled>
      </label>
      <label>Téléphone (facultatif)
        <input type="tel" name="phone" maxlength="20" data-label="Le téléphone" data-type="phone" value="<?= e($u['phone'] ?? '') ?>" autocomplete="tel">
      </label>
      <button class="btn btn-green" type="submit">Enregistrer</button>
    </div>
  </form>
</div>
<script src="<?= asset('js/validate.js') ?>" defer></script>
