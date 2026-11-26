<?php /** Variables : $old, $errors, $flash */ $old = $old ?? []; $errors = $errors ?? []; ?>
<header class="page-head"><div class="wrap"><p class="kicker"><?= icon('mail', 18) ?> Écrivez-nous</p><h1>Contact</h1></div></header>
<section class="wrap contact">
  <form class="form" method="post" action="<?= e(url('contact')) ?>" data-validate novalidate>
    <?php if (!empty($flash)): ?><div class="flash <?= e($flash['type']) ?>" role="status"><?= e($flash['text']) ?></div><?php endif; ?>
    <?php if (!empty($errors['form'])): ?><div class="flash err" role="alert"><?= e($errors['form']) ?></div><?php endif; ?>
    <?= csrfField() ?>
    <div class="row2">
      <label>Votre nom
        <input name="name" value="<?= e($old['name'] ?? '') ?>" required data-label="Le nom" data-min="2" data-max="80" class="<?= isset($errors['name']) ? 'invalid' : '' ?>">
        <?php if (isset($errors['name'])): ?><span class="field-error"><?= e($errors['name']) ?></span><?php endif; ?></label>
      <label>Votre e-mail
        <input type="email" name="email" value="<?= e($old['email'] ?? '') ?>" required data-label="L’e-mail" data-type="email" data-max="120" class="<?= isset($errors['email']) ? 'invalid' : '' ?>">
        <?php if (isset($errors['email'])): ?><span class="field-error"><?= e($errors['email']) ?></span><?php endif; ?></label>
    </div>
    <label>Objet (facultatif)
      <input name="subject" value="<?= e($old['subject'] ?? '') ?>" data-label="L’objet" data-max="120" class="<?= isset($errors['subject']) ? 'invalid' : '' ?>">
      <?php if (isset($errors['subject'])): ?><span class="field-error"><?= e($errors['subject']) ?></span><?php endif; ?></label>
    <label>Message
      <textarea name="message" rows="5" required data-label="Le message" data-min="10" data-max="2000" class="<?= isset($errors['message']) ? 'invalid' : '' ?>"><?= e($old['message'] ?? '') ?></textarea>
      <?php if (isset($errors['message'])): ?><span class="field-error"><?= e($errors['message']) ?></span><?php endif; ?></label>
    <button class="btn btn-green" type="submit">Envoyer</button>
  </form>
  <aside class="contact-side">
    <p class="ico-line"><?= icon('pin', 20) ?> Esprit School of Engineering<br>Tunis, Tunisie</p>
    <p class="ico-line"><?= icon('mail', 20) ?> contact@aquintiq.tn</p>
  </aside>
</section>
<script src="<?= asset('js/validate.js') ?>" defer></script>
