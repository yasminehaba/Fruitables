<?php
// Base path should point to project root (cakeShop)
define('BASE_PATH', dirname(__DIR__, 2)); // Goes up to htdocs/cakeShop

// Define important paths (using forward slashes)
define('APP_PATH', BASE_PATH . '/app');
define('PUBLIC_PATH', BASE_PATH . '/public');
define('BASE_URL', (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/cakeShop');
?>