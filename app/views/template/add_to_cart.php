<?php
session_start();

// Récupération des données via POST (depuis un formulaire)
$id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nom    = $_POST['nom'] ?? '';
$prix   = isset($_POST['prix']) ? (float)$_POST['prix'] : 0;
$image  = $_POST['image'] ?? '';




// Initialiser le panier si nécessaire
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajouter ou mettre à jour l'article
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['qte'] += 1;
    $_SESSION['cart'][$id]['ttPrix'] = $_SESSION['cart'][$id]['prix'] * $_SESSION['cart'][$id]['qte'];
} else {
    $_SESSION['cart'][$id] = [
        'nom'    => $nom,
        'prix'   => $prix,
        'qte'    => 1,
        'ttPrix' => $prix,
        'img'    => $image ?: 'img/default.png'
    ];
}

header('Location: cart.php');
exit;
