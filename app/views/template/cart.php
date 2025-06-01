<?php
session_start();

// Récupérer le panier depuis la session
$cart = $_SESSION['cart'] ?? [];

// Gérer les actions sur le panier (ajout, suppression, etc.)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'], $_POST['product_id'])) {
        $id = (int)$_POST['product_id'];

        if (isset($cart[$id])) {
            switch ($_POST['action']) {
                case 'increment':
                    $cart[$id]['qte'] += 1;
                    break;
                case 'decrement':
                    $cart[$id]['qte'] = max(1, $cart[$id]['qte'] - 1);
                    break;
                case 'remove':
                    unset($cart[$id]);
                    break;
            }

            if (isset($cart[$id])) {
                $cart[$id]['ttPrix'] = $cart[$id]['qte'] * $cart[$id]['prix'];
            }

            $_SESSION['cart'] = $cart;
        }

        header("Location: cart.php");
        exit;
    }
}
?>

<?php include "navbar.php"; ?>

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
                    <tr>
                        <td>
                            <?php if (!empty($item['img'])): ?>
                                <img src="<?= htmlspecialchars($item['img']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>" style="width: 80px; height: auto;" class="img-thumbnail">
                            <?php else: ?>
                                <span>Image non disponible</span>
                            <?php endif; ?>
                        </td>
                        <td class="align-middle"><?= htmlspecialchars($item['nom']) ?></td>
                        <td class="align-middle"><?= number_format($item['prix'], 2) ?> TND</td>
                        <td class="align-middle">
                            <div class="d-flex" style="width: 150px;">
                                <form method="post" style="margin: 0 2px;">
                                    <input type="hidden" name="product_id" value="<?= $id ?>">
                                    <input type="hidden" name="action" value="decrement">
                                    <button type="submit" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </form>

                                <input type="text" class="form-control form-control-sm text-center border-0" value="<?= $item['qte'] ?>" readonly>

                                <form method="post" style="margin: 0 2px;">
                                    <input type="hidden" name="product_id" value="<?= $id ?>">
                                    <input type="hidden" name="action" value="increment">
                                    <button type="submit" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="align-middle"><?= number_format($item['ttPrix'], 2) ?> TND</td>
                        <td class="align-middle">
                            <form method="post">
                                <input type="hidden" name="product_id" value="<?= $id ?>">
                                <input type="hidden" name="action" value="remove">
                                <button type="submit" class="btn btn-md rounded-circle bg-light border">
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