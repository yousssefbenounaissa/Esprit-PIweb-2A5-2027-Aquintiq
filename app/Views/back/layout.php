<?php
/** Layout Back Office. Variables : $title, $currentPage, $content, $extraScripts */
require_once __DIR__ . '/partials/head.php';
require_once __DIR__ . '/partials/sidebar.php';
?>
<div class="overlay" id="overlay"></div>
<main class="main-wrapper">
    <?php require_once __DIR__ . '/partials/header.php'; ?>
    <div class="content"><?= $content ?></div>
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</main>
<?php require_once __DIR__ . '/partials/scripts.php'; ?>
