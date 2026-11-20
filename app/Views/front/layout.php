<?php
/** Layout Front Office. Variables : $title, $currentPage, $content, $extraScripts */
require_once __DIR__ . '/includes/head.php';
require_once __DIR__ . '/includes/spinner.php';
require_once __DIR__ . '/includes/navbar.php';
echo $content;
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/scripts.php';
