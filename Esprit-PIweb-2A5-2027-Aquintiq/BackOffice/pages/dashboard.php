<?php
$days = ['Lun','Mar','Mer','Jeu','Ven','Sam','Dim']; $vals = [320,280,350,300,260,310,290];
$W=600;$H=190;$pl=34;$pb=26;$pt=12;$max=400;
$pts=[]; foreach($vals as $i=>$v){ $pts[]=[round($pl+($W-$pl-10)*$i/6,1), round($pt+($H-$pt-$pb)*(1-$v/$max),1)]; }
$line=implode(' ',array_map(fn($p)=>$p[0].','.$p[1],$pts));
$area=$pl.','.($H-$pb).' '.$line.' '.($W-10).','.($H-$pb);
?>
<!-- ========== section start ========== -->
<section class="content">
<div class="page-title"><h1>Tableau de bord</h1><p>Ce qui s'est passé cette semaine</p></div>
<div class="dash">
  <section class="card c-water">
    <h2>Eau utilisée par jour <small>litres</small></h2>
    <svg viewBox="0 0 <?= $W ?> <?= $H ?>" class="chart" role="img" aria-label="Consommation d'eau sur 7 jours">
      <defs><linearGradient id="wg" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#02B7F2" stop-opacity=".45"/><stop offset="1" stop-color="#02B7F2" stop-opacity="0"/></linearGradient></defs>
      <?php foreach([0,100,200,300,400] as $g): $y=$pt+($H-$pt-$pb)*(1-$g/$max); ?>
        <line x1="<?= $pl ?>" x2="<?= $W-10 ?>" y1="<?= $y ?>" y2="<?= $y ?>" stroke="#DAD6C6" stroke-dasharray="3 4"/><text x="<?= $pl-6 ?>" y="<?= $y+4 ?>" text-anchor="end" font-size="10" fill="#55657F"><?= $g ?></text>
      <?php endforeach; ?>
      <polygon points="<?= $area ?>" fill="url(#wg)"/>
      <polyline points="<?= $line ?>" fill="none" stroke="#004091" stroke-width="2.5" stroke-linejoin="round"/>
      <?php foreach($pts as $i=>$p): ?><circle cx="<?= $p[0] ?>" cy="<?= $p[1] ?>" r="4" fill="#fff" stroke="#004091" stroke-width="2"/><text x="<?= $p[0] ?>" y="<?= $H-8 ?>" text-anchor="middle" font-size="11" fill="#55657F"><?= $days[$i] ?></text><?php endforeach; ?>
    </svg>
  </section>
  <section class="card c-plots"><span class="big-n">46</span><p>parcelles suivies</p><?= icon('farm', 60) ?></section>
  <section class="card c-users"><span class="big-n">128</span><p>utilisateurs inscrits</p></section>
  <section class="card c-energy"><span class="big-n">318 <small>kWh</small></span><p>énergie solaire produite</p><?= icon('sun', 54) ?></section>
  <section class="card c-alerts">
    <h2>Dernières alertes</h2>
    <ul class="alerts">
      <li><i class="d warn"></i><div><b>Sol trop sec</b><span>Parcelle B, Ferme Ben Salah</span></div></li>
      <li><i class="d bad"></i><div><b>Batterie faible</b><span>Pompe solaire 2</span></div></li>
      <li><i class="d good"></i><div><b>Arrosage terminé</b><span>Parcelle A, 25 min</span></div></li>
    </ul>
  </section>
  <section class="card c-moist">
    <h2>Humidité du sol par parcelle</h2>
    <?php foreach ([['Parcelle A',62],['Parcelle B',24],['Parcelle C',48],['Parcelle D',71]] as [$n,$v]): ?>
      <div class="moist"><span><?= $n ?></span><div class="track"><i style="width:<?= $v ?>%" class="<?= $v < 30 ? 'low' : '' ?>"></i></div><b><?= $v ?> %</b></div>
    <?php endforeach; ?>
  </section>
</div>
</section>
<!-- ========== section end ========== -->
