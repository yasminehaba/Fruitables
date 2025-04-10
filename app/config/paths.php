<?php
// Chemin physique vers la racine du projet (cakeShop/)
define('BASE_PATH', dirname(__DIR__, 2));  // Remonte de 2 niveaux

// URL de base
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
define('BASE_URL', $protocol . '://' . $_SERVER['HTTP_HOST'] . '/cakeShop');
?>