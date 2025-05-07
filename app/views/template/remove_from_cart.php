<?php
session_start();

// Vérifier que l'ID est défini
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer l'élément du panier
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
}

// Rediriger vers la page du panier
header('Location: cart.php');
exit;
?>
