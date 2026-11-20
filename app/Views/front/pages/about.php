<header class="page-head"><div class="wrap"><p class="kicker"><?= icon('leaf', 18) ?> Qui sommes-nous</p><h1>Six étudiants, une station d'irrigation.</h1></div></header>
<section class="wrap about">
  <div class="about-main">
    <p class="big">Le thème du projet était la transition écologique, l'agriculture et la gestion durable des ressources. On est partis d'un problème simple : arroser sans gaspiller.</p>
    <p>Le prototype est une petite station : capteur d'humidité, ESP32, pompe, batterie et panneau solaire. Le site web en est la partie visible. On y voit les parcelles et l'arrosage, mais aussi des formations pour les jeunes agriculteurs, une marketplace et un système de prêt de matériel.</p>
    <p class="muted">Pour la suite : prévoir l'arrosage avec du Machine Learning, et une application mobile.</p>
  </div>
  <aside class="team">
    <h3>L'équipe</h3>
    <ul><?php foreach (['Ahmed Hech','Ahmed Kbaier','Youssef Ben Ounaissa','Hedi Aoun','Aziz Zayeni','Mohamed Taher Aziz Barbar'] as $n): ?><li><?= icon('leaf', 16) ?><?= e($n) ?></li><?php endforeach; ?></ul>
  </aside>
</section>
