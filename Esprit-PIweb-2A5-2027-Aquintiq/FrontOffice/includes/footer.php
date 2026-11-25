<!-- Footer Start -->
<footer class="foot">
  <svg class="furrows" viewBox="0 0 1200 40" preserveAspectRatio="none" aria-hidden="true"><path d="M0 20 Q150 0 300 20 T600 20 T900 20 T1200 20" fill="none" stroke="#5FCE06" stroke-width="2" opacity=".5"/><path d="M0 32 Q150 12 300 32 T600 32 T900 32 T1200 32" fill="none" stroke="#1D9513" stroke-width="2" opacity=".7"/></svg>
  <div class="wrap foot-grid">
    <div class="foot-brand">
      <span class="logo-tile"><img src="<?= asset('img/logo.png') ?>" alt="AQUINTIQ"></span>
      <p>Irrigation solaire pour les petites exploitations. Projet d'étudiants d'Esprit School of Engineering.</p>
    </div>
    <div>
      <h4>Modules</h4>
      <ul><?php foreach (array_filter(modules(), fn($m) => $m['front']) as $k => $m): ?><li><a href="<?= url($k) ?>"><?= e($m['label']) ?></a></li><?php endforeach; ?></ul>
    </div>
    <div>
      <h4>Nous trouver</h4>
      <p class="ico-line"><?= icon('pin', 18) ?> Esprit School of Engineering, Tunis</p>
      <p class="ico-line"><?= icon('mail', 18) ?> contact@aquintiq.tn</p>
    </div>
  </div>
  <div class="foot-end">&copy; <?= date('Y') ?> AQUINTIQ · Développé à Esprit School of Engineering – Tunisie</div>
</footer>
<a href="#" class="to-top" aria-label="Haut de page"><?= icon('arrow', 20) ?></a>
<!-- Footer End -->
