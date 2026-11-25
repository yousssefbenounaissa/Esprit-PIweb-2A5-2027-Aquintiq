<?php
/**
 * Layout principal - inclut tous les blocs communs et injecte le contenu
 * propre à chaque page ($content) au milieu.
 *
 * Variables attendues (fournies par Controller::render()) :
 *   $title        string  - titre de l'onglet <title>
 *   $currentPage  string  - clé de la page courante (pour la sidebar)
 *   $content      string  - HTML de la page (déjà rendu)
 *   $extraScripts string  - JS spécifique à la page (optionnel)
 */
require_once __DIR__ . '/partials/head.php';
require_once __DIR__ . '/partials/sidebar.php';
?>
    <div class="overlay" id="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
      <?php require_once __DIR__ . '/partials/header.php'; ?>

      <?= $content ?>

      <?php require_once __DIR__ . '/partials/footer.php'; ?>
    </main>
    <!-- ======== main-wrapper end =========== -->
<?php require_once __DIR__ . '/partials/scripts.php'; ?>
