<?php $m = modules(); ?>
<!-- Hero -->
<section class="hero">
  <div class="wrap hero-in">
    <div class="hero-text">
      <p class="kicker"><?= icon('leaf', 18) ?> Projet d'étudiants · Esprit School of Engineering</p>
      <h1>Arroser quand la terre en a besoin, <em>avec l'énergie du soleil.</em></h1>
      <p class="lead">Un capteur dans le sol, une carte ESP32, une pompe et un panneau solaire. Ce site sert à lire les mesures, décider quoi planter et vendre sa récolte.</p>
      <p class="hero-btns"><a href="<?= url('farms') ?>" class="btn btn-lime">Voir les parcelles</a><a href="#comment" class="btn btn-ghost">Comment ça marche</a></p>
    </div>
    <div class="hero-art">
      <svg viewBox="0 0 560 470" role="img" aria-label="Champ en rangs, panneau solaire et goutte-à-goutte">
        <defs>
          <linearGradient id="sky" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#02B7F2"/><stop offset="1" stop-color="#8CF0FB"/></linearGradient>
          <clipPath id="near"><path d="M0 330 Q200 270 560 320 V470 H0Z"/></clipPath>
        </defs>
        <rect width="560" height="470" fill="url(#sky)"/>
        <circle cx="430" cy="105" r="70" fill="#fff" opacity=".25"/><circle cx="430" cy="105" r="42" fill="#fff" opacity=".9"/>
        <path d="M0 270 Q120 215 260 250 T560 235 V470 H0Z" fill="#5FCE06" opacity=".75"/>
        <path d="M0 300 Q180 240 360 285 T560 272 V470 H0Z" fill="#1D9513"/>
        <path d="M0 330 Q200 270 560 320 V470 H0Z" fill="#02532A"/>
        <g clip-path="url(#near)" stroke="#5FCE06" stroke-width="2.5" opacity=".65" fill="none">
          <path d="M280 292 L-60 470"/><path d="M280 292 L40 470"/><path d="M280 292 L150 470"/><path d="M280 292 L255 470"/>
          <path d="M280 292 L360 470"/><path d="M280 292 L470 470"/><path d="M280 292 L590 470"/><path d="M280 292 L700 470"/>
        </g>
        <g fill="#8CF0FB"><path d="M118 408 q7 12 0 16 q-7 -4 0 -16z"/><path d="M215 384 q5 9 0 12 q-5 -3 0 -12z"/><path d="M345 392 q6 10 0 14 q-6 -4 0 -14z"/><path d="M455 418 q7 12 0 16 q-7 -4 0 -16z"/></g>
        <g transform="translate(58 196) rotate(-6)"><path d="M0 40 L24 0 H112 L88 40Z" fill="#001C5A"/><path d="M8 27H98M16 14H104M40 0L16 40M70 0L46 40M96 0L72 40" stroke="#006EC4" stroke-width="1.5"/></g>
        <path d="M104 236 v52" stroke="#001C5A" stroke-width="5"/>
        <g transform="translate(400 262)"><rect width="46" height="34" rx="3" fill="#001C5A"/><rect x="7" y="8" width="14" height="8" fill="#5FCE06"/><path d="M36 0 V-22" stroke="#001C5A" stroke-width="3"/><circle cx="36" cy="-26" r="4" fill="#02B7F2"/></g>
      </svg>
      <div class="station">
        <span class="station-t">Station · Parcelle A <i class="live"></i></span>
        <dl><div><dt>Humidité du sol</dt><dd>34 %</dd></div><div><dt>Pompe</dt><dd>arrêtée</dd></div><div><dt>Batterie</dt><dd>82 %</dd></div></dl>
        <small>Exemple de données</small>
      </div>
    </div>
  </div>
  <svg class="hero-wave" viewBox="0 0 1200 90" preserveAspectRatio="none" aria-hidden="true"><path d="M0 50 Q200 0 420 40 T820 30 T1200 45 V90 H0Z" fill="#F6F4EA"/></svg>
</section>

<!-- Point de départ + comparaison -->
<section class="wrap start">
  <div class="start-text">
    <h2>Le point de départ</h2>
    <p class="big">Beaucoup de petits agriculteurs arrosent à l'œil. De l'eau gaspillée, des plants qui sèchent, du temps perdu.</p>
    <p>Les applications qu'on a regardées font bien une chose chacune. Aucune ne réunit le suivi des cultures, l'arrosage et l'énergie pour une petite exploitation. C'est ce qu'on essaie de faire ici.</p>
  </div>
  <div class="compare">
    <table>
      <thead><tr><th></th><th>Cultures</th><th>Arrosage</th><th>Énergie</th></tr></thead>
      <tbody>
        <tr><th>FarmLogs</th><td class="y"><?= icon('check', 18) ?></td><td></td><td></td></tr>
        <tr><th>Rain Bird</th><td></td><td class="y"><?= icon('check', 18) ?></td><td></td></tr>
        <tr><th>Huawei FusionSolar</th><td></td><td></td><td class="y"><?= icon('check', 18) ?></td></tr>
        <tr class="us"><th>AQUINTIQ</th><td class="y"><?= icon('check', 18) ?></td><td class="y"><?= icon('check', 18) ?></td><td class="y"><?= icon('check', 18) ?></td></tr>
      </tbody>
    </table>
  </div>
</section>

<!-- Fonctionnement (zigzag) -->
<section class="flow" id="comment">
  <div class="wrap">
    <h2>Comment ça marche</h2>
    <ol class="zig">
      <li><b>1</b><div><h3>On crée sa ferme</h3><p>Une ferme, des parcelles, une culture par parcelle.</p></div></li>
      <li><b>2</b><div><h3>Le capteur mesure</h3><p>L'humidité du sol arrive sur le site, avec la tension de la batterie.</p></div></li>
      <li><b>3</b><div><h3>La pompe réagit</h3><p>Sol trop sec : l'arrosage démarre. On peut aussi le lancer à la main.</p></div></li>
      <li><b>4</b><div><h3>On est prévenu</h3><p>Batterie faible, sol trop sec, capteur qui ne répond plus.</p></div></li>
      <li><b>5</b><div><h3>On garde une trace</h3><p>Historique des arrosages et volume d'eau utilisé.</p></div></li>
    </ol>
  </div>
</section>

<!-- Modules (grille irrégulière) -->
<section class="wrap mods">
  <h2>Ce que contient le site</h2>
  <div class="bento">
    <a class="tile t-farms" href="<?= url('farms') ?>"><?= icon('farm', 44) ?><h3><?= e($m['farms']['label']) ?></h3><p><?= e($m['farms']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
    <a class="tile t-irr" href="<?= url('irrigation') ?>"><?= icon('drop', 34) ?><h3><?= e($m['irrigation']['label']) ?></h3><p><?= e($m['irrigation']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
    <a class="tile t-shop" href="<?= url('marketplace') ?>"><?= icon('shop', 34) ?><h3><?= e($m['marketplace']['label']) ?></h3><p><?= e($m['marketplace']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
    <a class="tile t-plan" href="<?= url('planting') ?>"><?= icon('calendar', 44) ?><h3><?= e($m['planting']['label']) ?></h3><p><?= e($m['planting']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
    <a class="tile t-train" href="<?= url('training') ?>"><?= icon('book', 34) ?><h3><?= e($m['training']['label']) ?></h3><p><?= e($m['training']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
    <a class="tile t-equip" href="<?= url('equipment') ?>"><?= icon('tool', 34) ?><h3><?= e($m['equipment']['label']) ?></h3><p><?= e($m['equipment']['desc']) ?></p><span class="go"><?= icon('arrow', 22) ?></span></a>
  </div>
</section>

<!-- Calendrier -->
<section class="wrap cal">
  <div class="cal-head"><h2>Quand planter ?</h2><p>Une partie du site est pensée pour les jeunes agriculteurs : un calendrier par culture. Voici l'idée, avec des dates <strong>indicatives</strong> à adapter à votre région.</p></div>
  <div class="gantt">
    <div class="g-row g-months"><span></span><?php foreach (['J','F','M','A','M','J','J','A','S','O','N','D'] as $mo): ?><i><?= $mo ?></i><?php endforeach; ?></div>
    <?php foreach ([['Tomate',[[3,5]],'a'],['Poivron / piment',[[4,5]],'b'],['Pomme de terre',[[1,2],[9,10]],'c'],['Blé dur',[[11,12]],'a'],['Olivier',[[11,12],[1,2]],'b']] as [$n,$bars,$c]): ?>
      <div class="g-row"><span><?= $n ?></span><?php foreach ($bars as [$s,$e]): ?><u class="bar <?= $c ?>" style="grid-column:<?= $s+1 ?> / <?= $e+2 ?>"></u><?php endforeach; ?></div>
    <?php endforeach; ?>
  </div>
</section>

<!-- ODD -->
<section class="sdg">
  <div class="wrap sdg-in">
    <p>Le projet répond à six objectifs de développement durable</p>
    <ul><li>2</li><li>4</li><li>6</li><li>7</li><li>12</li><li>13</li></ul>
  </div>
</section>
