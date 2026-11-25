<?php
// Point d’entrée unique : index.php?page=home (Front Office) | index.php?page=admin-dashboard (Back Office, administrateurs)
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/helpers.php';

// ---- En-têtes de sécurité HTTP (atelier Sessions et Sécurité) ----
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data:; frame-ancestors 'none'; form-action 'self'; base-uri 'self'");

// ---- Session durcie ----
ini_set('session.use_strict_mode', '1');
ini_set('session.use_only_cookies', '1');
session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax', 'secure' => !empty($_SERVER['HTTPS'])]);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();

// Expiration après 30 minutes d'inactivité
const SESSION_TIMEOUT = 1800;
if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > SESSION_TIMEOUT) {
    destroySession();
    session_start();
    flash('err', 'Session expirée après 30 minutes d’inactivité : reconnectez-vous.');
}
$_SESSION['last_activity'] = time();
spl_autoload_register(function (string $class): void {
    $file = __DIR__ . '/app/' . str_replace(['App\\', '\\'], ['', '/'], $class) . '.php';
    if (is_file($file)) require_once $file;
});
$routes = require __DIR__ . '/app/routes.php';
$page = preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['page'] ?? 'home'));
if (!isset($routes[$page])) { http_response_code(404); $page = '404'; }
[$controller, $method] = $routes[$page];
$class = 'App\\Controllers\\' . $controller;
(new $class())->$method();
