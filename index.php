<?php
// Point d’entrée unique : index.php?page=home (Front Office) | index.php?page=admin-dashboard (Back Office, administrateurs)
declare(strict_types=1);
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/app/helpers.php';

session_set_cookie_params(['httponly' => true, 'samesite' => 'Lax']);
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
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
