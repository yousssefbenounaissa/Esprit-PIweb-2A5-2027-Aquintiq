<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="<?= asset('img/favicon.png') ?>" type="image/png" />
    <title><?= htmlspecialchars($title ?? 'AQUINTIQ Admin') ?></title>

    <!-- ========== All CSS files linkup ========= -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/brand.css') ?>" />
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>" />
  </head>
  <body class="admin">
    <!-- ======== Preloader =========== -->
    <div id="preloader"><span class="drop"></span></div>
    <!-- ======== Preloader =========== -->
