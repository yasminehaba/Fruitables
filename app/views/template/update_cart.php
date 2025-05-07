<?php
session_start();

// Vérifier que l'ID et la quantité sont définis
if (isset($_GET['id']) && isset($_GET['qty'])) {
    $id = $_GET['id'];
    $qty = (int)$_GET['qty'];

    // Vérifier que l'élément existe dans le panier
    if (isset($_SESSION['cart'][$id])) {
        // Mettre à jour la quantité et le prix total
        $_SESSION['cart'][$id]['qte'] = $qty;
        $_SESSION['cart'][$id]['ttPrix'] = $_SESSION['cart'][$id]['prix'] * $qty;
    }
}

// Rediriger vers la page du panier
header('Location: cart.php');
exit;
?>
