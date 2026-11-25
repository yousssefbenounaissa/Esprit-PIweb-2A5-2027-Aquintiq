<?php
/** Page de connexion / inscription (autonome, sans layout). Variables : $mode ('login'|'register'), $error, $old, $csrf, $title */
$mode = $mode ?? 'login'; $error = $error ?? null; $old = $old ?? []; $csrf = $csrf ?? '';
$isReg = $mode === 'register';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<title><?= e($title ?? 'Connexion | AQUINTIQ') ?></title>
<link rel="icon" href="<?= asset('img/favicon.png') ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= asset('css/login.css') ?>">
</head>
<body>

<svg class="bg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" viewBox="0 0 1200 800">
  <path d="M0 140H220L280 80H520"/><circle cx="526" cy="80" r="5"/>
  <path d="M0 200H160L210 250H380"/><circle cx="386" cy="250" r="5"/>
  <path d="M1200 640H980L920 700H700"/><circle cx="694" cy="700" r="5"/>
  <path d="M1200 580H1040L990 530H860"/><circle cx="854" cy="530" r="5"/>
  <path d="M1200 120H1010L960 70H820"/><circle cx="814" cy="70" r="5"/>
  <path d="M0 700H180L230 650H400"/><circle cx="406" cy="650" r="5"/>
</svg>

<!-- symboles -->
<svg width="0" height="0" style="position:absolute" aria-hidden="true">
  <symbol id="drop" viewBox="0 0 48 48"><path d="M24 3C24 3 8 21 8 31a16 16 0 0 0 32 0C40 21 24 3 24 3Z" fill="#fff"/><path d="M17 38c0-9 8-15 19-16-1 10-8 17-19 16Z" fill="#7BD389"/></symbol>
  <symbol id="drop-c" viewBox="0 0 48 48"><path d="M24 3C24 3 8 21 8 31a16 16 0 0 0 32 0C40 21 24 3 24 3Z" fill="#00A6D6"/><path d="M17 38c0-9 8-15 19-16-1 10-8 17-19 16Z" fill="#269447"/></symbol>
  <symbol id="i-user" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M4 21c0-4.4 3.6-7 8-7s8 2.6 8 7"/></symbol>
  <symbol id="i-mail" viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></symbol>
  <symbol id="i-lock" viewBox="0 0 24 24"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></symbol>
  <symbol id="i-eye" viewBox="0 0 24 24"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></symbol>
</svg>

<main class="card<?= $isReg ? ' signup' : '' ?>" id="card" data-mode="<?= $isReg ? 'signup' : 'login' ?>">

  <!-- Panneau coulissant -->
  <aside class="overlay" aria-hidden="false">
    <svg class="deco" viewBox="0 0 460 580" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
      <path d="M0 470H110L150 510H330"/><circle cx="336" cy="510" r="5"/>
      <path d="M460 90H350L310 50H200"/><circle cx="194" cy="50" r="5"/>
      <path d="M0 120H70L100 150H190"/><circle cx="196" cy="150" r="5"/>
    </svg>
    <div class="brand"><svg><use href="#drop"/></svg>AQUINTIQ</div>

    <div class="ov-inner for-login">
      <h2>Nouveau sur AQUINTIQ ?</h2>
      <p>Créez votre parcelle et suivez l’humidité du sol, l’irrigation et l’énergie solaire au même endroit.</p>
      <button class="ghost" type="button" data-go="signup">Créer un compte</button>
    </div>
    <div class="ov-inner for-signup">
      <h2>Déjà inscrit ?</h2>
      <p>Retrouvez vos parcelles, vos capteurs et les alertes de votre exploitation.</p>
      <button class="ghost" type="button" data-go="login">Se connecter</button>
    </div>
    <div class="scene" aria-hidden="true"><canvas id="scene"></canvas></div>
  </aside>

  <!-- Connexion -->
  <section class="pane login" id="paneLogin">
    <div class="mbrand"><svg><use href="#drop-c"/></svg>AQUINTIQ</div>
    <h1>Connexion</h1>
    <p class="sub">Accédez à votre tableau de bord.</p>
    <form id="formLogin" method="post" action="<?= e(url('login')) ?>" novalidate>
      <input type="hidden" name="form_type" value="login">
      <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
      <div class="field">
        <label class="box" id="bxLE"><svg><use href="#i-mail"/></svg>
          <input type="email" name="email" placeholder="Adresse e-mail" autocomplete="email" aria-label="Adresse e-mail" value="<?= e($isReg ? '' : ($old['email'] ?? '')) ?>"></label>
        <div class="msg" role="alert"></div>
      </div>
      <div class="field">
        <label class="box"><svg><use href="#i-lock"/></svg>
          <input type="password" name="password" placeholder="Mot de passe" autocomplete="current-password" aria-label="Mot de passe">
          <button class="eye" type="button" aria-label="Afficher le mot de passe"><svg style="stroke:var(--muted);fill:none;stroke-width:1.8;width:18px;height:18px"><use href="#i-eye"/></svg></button></label>
        <div class="msg" role="alert"></div>
      </div>
      <div class="row"><button class="link" type="button">Mot de passe oublié ?</button></div>
      <button class="cta" type="submit">Se connecter</button>
      <div class="status err" role="alert"><?= !$isReg ? e($error) : '' ?></div>
    </form>
    <p class="alt">Pas encore de compte ? <button class="link" type="button" data-go="signup">Créer un compte</button></p>
  </section>

  <!-- Inscription -->
  <section class="pane signup" id="paneSignup">
    <div class="mbrand"><svg><use href="#drop-c"/></svg>AQUINTIQ</div>
    <h1>Créer un compte</h1>
    <p class="sub">Commencez à piloter votre irrigation.</p>
    <form id="formSignup" method="post" action="<?= e(url('login')) ?>" novalidate>
      <input type="hidden" name="form_type" value="register">
      <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
      <div class="field">
        <label class="box"><svg><use href="#i-user"/></svg>
          <input type="text" name="name" placeholder="Nom complet" autocomplete="name" aria-label="Nom complet" value="<?= e($old['name'] ?? '') ?>"></label>
        <div class="msg" role="alert"></div>
      </div>
      <div class="field">
        <label class="box"><svg><use href="#i-mail"/></svg>
          <input type="email" name="email" placeholder="Adresse e-mail" autocomplete="email" aria-label="Adresse e-mail" value="<?= e($isReg ? ($old['email'] ?? '') : '') ?>"></label>
        <div class="msg" role="alert"></div>
      </div>
      <div class="field">
        <label class="box"><svg><use href="#i-lock"/></svg>
          <input type="password" name="password" placeholder="Mot de passe (8 caractères minimum)" autocomplete="new-password" aria-label="Mot de passe">
          <button class="eye" type="button" aria-label="Afficher le mot de passe"><svg style="stroke:var(--muted);fill:none;stroke-width:1.8;width:18px;height:18px"><use href="#i-eye"/></svg></button></label>
        <div class="msg" role="alert"></div>
      </div>
      <button class="cta" type="submit">Créer mon compte</button>
      <div class="status err" role="alert"><?= $isReg ? e($error) : '' ?></div>
    </form>
    <p class="alt">Déjà inscrit ? <button class="link" type="button" data-go="login">Se connecter</button></p>
  </section>
</main>
<script src="<?= asset('lib/three.min.js') ?>"></script>

<script src="<?= asset('js/login.js') ?>"></script>
<script src="<?= asset('js/login-scene.js') ?>"></script>
</body>
</html>
