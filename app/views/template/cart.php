<?php
include "navbar.php";
session_start();

// Initialiser ou récupérer le panier
$cart = $_SESSION['cart'] ?? [];

// Gestion des actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['product_id'])) {
        $id = (int)$_POST['product_id'];

        // Vérifier si l'article existe dans le panier
        if (isset($cart[$id])) {
            // Gérer l'action (incrémenter, décrémenter, retirer)
            switch ($_POST['action']) {
                case 'increment':
                    $cart[$id]['qte'] += 1; // Augmenter la quantité
                    break;
                case 'decrement':
                    // Décrémenter la quantité sans descendre sous 1
                    $cart[$id]['qte'] = max(1, $cart[$id]['qte'] - 1);
                    break;
                case 'remove':
                    unset($cart[$id]); // Supprimer l'article
                    break;
            }

            // Recalculer le total du produit après modification
            if (isset($cart[$id])) {
                $cart[$id]['ttPrix'] = $cart[$id]['qte'] * $cart[$id]['prix'];
            }
        }

        // Mettre à jour le panier dans la session
        $_SESSION['cart'] = $cart;
       
        // Rediriger vers la page du panier pour afficher les modifications
        header("Location: cart.php");
        exit;
    }
}
?>

<!-- Page Header -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Cart</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Pages</a></li>
        <li class="breadcrumb-item active text-white">Cart</li>
    </ol>
</div>

<!-- Cart Content -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <?php if (empty($cart)): ?>
            <p class="text-center">Votre panier est vide.</p>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cart as $id => $item): ?>
                    <?php if (!isset($item['nom'], $item['prix'], $item['qte'], $item['ttPrix'])) continue; ?>
                    <tr>
                        <td><p class="mb-0 mt-4"><?= htmlspecialchars($item['img'] ?? 'Image inconnue') ?></p></td>
                        <td><p class="mb-0 mt-4"><?= htmlspecialchars($item['nom']) ?></p></td>
                        <td><p class="mb-0 mt-4"><?= htmlspecialchars($item['prix']) ?> TND</p></td>
                        <td>
                            <form method="post" class="d-flex mt-4" style="width: 150px;">
                                <input type="hidden" name="product_id" value="<?= (int)$id ?>">
                                <div class="input-group quantity">
                                    <button type="submit" name="action" value="decrement" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input type="text" class="form-control form-control-sm text-center border-0" value="<?= $item['qte'] ?>" readonly>
                                    <button type="submit" name="action" value="increment" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </form>
                        </td>
                        <td><p class="mb-0 mt-4"><?= number_format($item['ttPrix'], 2) ?> TND</p></td>
                        <td>
                            <form method="post" class="mt-4">
                                <input type="hidden" name="product_id" value="<?= (int)$id ?>">
                                <button type="submit" name="action" value="remove" class="btn btn-md rounded-circle bg-light border">
                                    <i class="fa fa-times text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Totaux -->
        <div class="row g-4 justify-content-end mt-5">
            <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                <div class="bg-light rounded">
                    <div class="p-4">
                        <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                        <?php 
                        $subtotal = array_sum(array_column($cart, 'ttPrix'));
                        $shipping = 3.00;
                        $total = $subtotal + $shipping;
                        ?>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="mb-0 me-4">Subtotal:</h5>
                            <p class="mb-0"><?= number_format($subtotal, 2) ?> TND</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0 me-4">Shipping</h5>
                            <p class="mb-0">Flat rate: <?= number_format($shipping, 2) ?> TND</p>
                        </div>
                        <p class="mb-0 text-end">Shipping to Tunisia.</p>
                    </div>
                    <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                        <h5 class="mb-0 ps-4 me-4">Total</h5>
                        <p class="mb-0 pe-4"><?= number_format($total, 2) ?> TND</p>
                    </div>
                    <a href="checkout.php" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">Proceed Checkout</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="mt-5">
            <a href="index2.php" class="btn btn-primary">Retour aux produits</a>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
