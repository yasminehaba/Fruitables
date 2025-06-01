<?php
session_start();

// Récupération des données du produit
$id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nom    = trim($_POST['nom'] ?? '');
$prix   = isset($_POST['prix']) ? (float)$_POST['prix'] : 0;
$image  = trim($_POST['image'] ?? '');

// Initialisation du panier
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Vérification et ajout
if ($id > 0 && $nom !== '' && $prix > 0) {
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['qte'] += 1;
        $_SESSION['cart'][$id]['ttPrix'] = $_SESSION['cart'][$id]['prix'] * $_SESSION['cart'][$id]['qte'];
    } else {
        $_SESSION['cart'][$id] = [
            'nom'    => htmlspecialchars($nom, ENT_QUOTES, 'UTF-8'),
            'prix'   => $prix,
            'qte'    => 1,
            'ttPrix' => $prix,
            'img'    => $image ?: 'img/default.png'
        ];
    }
}

// Redirection vers le panier
header('Location: cart.php');
exit;
