<?php
// Configuration générale (à adapter) — ne pas committer de vrais mots de passe
const APP_NAME = 'AQUINTIQ';
// Chemin de base détecté automatiquement (/aquintiq-mvc sous XAMPP, vide avec php -S) : ne rien modifier
define('BASE_URL', rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/'));
const DB_HOST = 'localhost';
const DB_NAME = 'aquintiq';
const DB_USER = 'root';
const DB_PASS = '';
