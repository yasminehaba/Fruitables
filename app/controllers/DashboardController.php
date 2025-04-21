<?php
class DashboardController {
    public function index() {
        session_start();
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: /cakeShop/public/index.php?page=login");
            exit;
        }

        // Inclure la vue
        include_once "../app/views/dashboard/index.php";
    }
}
