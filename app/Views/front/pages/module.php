<header class="page-head mod-head"><div class="wrap"><span class="mod-ic"><?= icon($m['icon'], 40) ?></span><h1><?= e($m['label']) ?></h1><p class="lead"><?= e($m['desc']) ?></p></div></header>
<section class="wrap">
  <p class="note">Page de départ : le responsable du module la remplace par son CRUD Front Office (liste, détail, ajout, modification).</p>
  <?php foreach ($m['entities'] as $i => [$name, $cols, $rows]): ?>
    <h3 class="tbl-title"><?= e($name) ?></h3>
    <div class="tbl-wrap <?= $i ? 'alt' : '' ?>"><table class="tbl">
      <thead><tr><?php foreach ($cols as $c): ?><th><?= e($c) ?></th><?php endforeach; ?></tr></thead>
      <tbody><?php foreach ($rows as $r): ?><tr><?php foreach ($r as $v): ?><td><?= e((string)$v) ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody>
    </table></div>
  <?php endforeach; ?>
</section>
