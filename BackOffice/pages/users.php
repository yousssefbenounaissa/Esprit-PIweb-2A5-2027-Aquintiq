<?php /** Variables : $roles, $users, $edit, $roleName, $me, $flash, $old, $errors */
$f = fn(string $k) => $old[$k] ?? ($edit[$k] ?? '');
$err = fn(string $k) => isset($errors[$k]) ? '<span class="field-error">' . e($errors[$k]) . '</span>' : '';
$cls = fn(string $k) => isset($errors[$k]) ? 'invalid' : '';
?>
<section class="content">
<div class="page-title mod-title"><span class="mod-ic"><?= icon('users', 28) ?></span><div><h1>Utilisateurs</h1><p>Créer, modifier, supprimer les comptes et changer les rôles.</p></div></div>
<?php if (!empty($flash)): ?><div class="flash <?= e($flash['type']) ?>" role="status"><?= e($flash['text']) ?></div><?php endif; ?>

<section class="card tcard">
  <div class="tcard-head"><h2><?= $edit ? 'Modifier l’utilisateur #' . (int) $edit['id'] : 'Ajouter un utilisateur' ?></h2>
    <?php if ($edit): ?><a class="btn-sec" href="<?= e(url('admin-users')) ?>">Annuler</a><?php endif; ?></div>
  <form class="bform" method="post" action="<?= e(url('admin-users')) ?>" data-validate novalidate>
    <?= csrfField() ?>
    <input type="hidden" name="action" value="<?= $edit ? 'update' : 'create' ?>">
    <?php if ($edit): ?><input type="hidden" name="id" value="<?= (int) $edit['id'] ?>"><?php endif; ?>
    <label>Nom complet<input name="name" value="<?= e($f('name')) ?>" required data-label="Le nom" data-min="2" data-max="80" class="<?= $cls('name') ?>"><?= $err('name') ?></label>
    <label>E-mail<input type="email" name="email" value="<?= e($f('email')) ?>" required data-label="L’e-mail" data-type="email" data-max="120" class="<?= $cls('email') ?>"><?= $err('email') ?></label>
    <label>Téléphone<input name="phone" value="<?= e($f('phone')) ?>" data-label="Le téléphone" data-type="phone" class="<?= $cls('phone') ?>"><?= $err('phone') ?></label>
    <label>Rôle<select name="role_id" required data-label="Le rôle" class="<?= $cls('role_id') ?>">
      <?php foreach ($roles as $r): ?><option value="<?= (int) $r['id'] ?>" <?= (int) $f('role_id') === (int) $r['id'] ? 'selected' : '' ?>><?= e($r['name']) ?></option><?php endforeach; ?>
    </select><?= $err('role_id') ?></label>
    <label>Mot de passe <?= $edit ? '(laisser vide = inchangé)' : '' ?><input type="password" name="password" autocomplete="new-password" <?= $edit ? '' : 'required' ?> data-label="Le mot de passe" data-min="8" class="<?= $cls('password') ?>"><?= $err('password') ?></label>
    <div class="full"><button class="btn-add" type="submit"><?= $edit ? 'Enregistrer' : '+ Ajouter' ?></button></div>
  </form>
</section>

<section class="card tcard alt">
  <div class="tcard-head"><h2>Liste des utilisateurs (<?= count($users) ?>)</h2></div>
  <div class="t-scroll"><table class="tbl">
    <thead><tr><th>ID</th><th>Nom</th><th>E-mail</th><th>Téléphone</th><th>Rôle</th><th class="r">Actions</th></tr></thead>
    <tbody>
    <?php foreach ($users as $u): $self = (int) $u['id'] === (int) $me['id']; ?>
      <tr>
        <td><?= (int) $u['id'] ?></td>
        <td><?= e($u['name']) ?><?= $self ? ' <small>(vous)</small>' : '' ?></td>
        <td><?= e($u['email']) ?></td>
        <td><?= e($u['phone'] ?? '') ?></td>
        <td>
          <form class="inline-form" method="post" action="<?= e(url('admin-users')) ?>"><?= csrfField() ?>
            <input type="hidden" name="action" value="role"><input type="hidden" name="id" value="<?= (int) $u['id'] ?>">
            <select class="role-sel" name="role_id" aria-label="Rôle de <?= e($u['name']) ?>" data-autosubmit>
              <?php foreach ($roles as $r): ?><option value="<?= (int) $r['id'] ?>" <?= (int) $u['role_id'] === (int) $r['id'] ? 'selected' : '' ?>><?= e($r['name']) ?></option><?php endforeach; ?>
            </select><noscript><button>OK</button></noscript>
          </form>
        </td>
        <td class="r">
          <a class="act" href="<?= e(url('admin-users&edit=' . (int) $u['id'])) ?>">Modifier</a>
          <?php if (!$self): ?>
          <form class="inline-form" method="post" action="<?= e(url('admin-users')) ?>" data-confirm="Supprimer <?= e($u['name']) ?> ?"><?= csrfField() ?>
            <input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int) $u['id'] ?>">
            <button class="act del link-btn" type="submit">Supprimer</button>
          </form>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
    <?php if (!$users): ?><tr><td colspan="6">Aucun utilisateur.</td></tr><?php endif; ?>
    </tbody></table></div>
</section>
</section>
<script src="<?= asset('js/validate.js') ?>"></script>
<script src="<?= asset('js/users.js') ?>"></script>
