<?php
session_start();
header('Content-Type: application/json');

// Récupération des données du produit
$id     = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$nom    = trim($_POST['nom'] ?? '');
$prix   = isset($_POST['prix']) ? (float)$_POST['prix'] : 0;
$image  = trim($_POST['image'] ?? '');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Ajouter au panier
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

// Compter les articles dans le panier
$count = 0;
foreach ($_SESSION['cart'] as $item) {
    $count += $item['qte'];
}

// Réponse JSON
echo json_encode(['success' => true, 'cartCount' => $count]);
exit;
