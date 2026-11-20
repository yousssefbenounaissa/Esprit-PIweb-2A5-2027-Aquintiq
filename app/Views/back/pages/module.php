<div class="page-title mod-title"><span class="mod-ic"><?= icon($m['icon'], 28) ?></span><div><h1><?= e($m['label']) ?></h1><p><?= e($m['desc']) ?></p></div></div>
<p class="note">Page de départ : le responsable du module remplace ces tableaux par son CRUD (créer, lister, modifier, supprimer).</p>
<?php foreach ($m['entities'] as $i => [$name, $cols, $rows]): ?>
  <section class="card tcard <?= $i ? 'alt' : '' ?>">
    <div class="tcard-head"><h2><?= e($name) ?></h2><button class="btn-add" type="button">+ Ajouter</button></div>
    <div class="t-scroll"><table class="tbl">
      <thead><tr><?php foreach ($cols as $c): ?><th><?= e($c) ?></th><?php endforeach; ?><th class="r">Actions</th></tr></thead>
      <tbody>
        <?php foreach ($rows as $r): ?>
          <tr><?php foreach ($r as $ci => $v): $cn = $cols[$ci]; ?>
            <td><?= in_array($cn, ['statut','mode','rôle','terminé'], true) ? chip((string)$v) : e((string)$v) ?></td>
          <?php endforeach; ?>
            <td class="r"><a href="#" class="act">Modifier</a><a href="#" class="act del">Supprimer</a></td></tr>
        <?php endforeach; ?>
      </tbody></table></div>
  </section>
<?php endforeach; ?>
