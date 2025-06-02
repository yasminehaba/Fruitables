<?php
// At VERY TOP (no whitespace before)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>
<?php

$cartCount = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['qte'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Fruitables - Vegetable Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/cakeShop/app/views/template/assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="/cakeShop/app/views/template/assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/cakeShop/app/views/template/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/cakeShop/app/views/template/assets/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar start -->
    <div class="container-fluid fixed-top">
        <div class="container topbar bg-primary d-none d-lg-block">
            <div class="d-flex justify-content-between">
                <div class="top-info ps-2">
                    <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">123 Street, New York</a></small>
                    <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">Email@Example.com</a></small>
                </div>
                <div class="top-link pe-2">
                    <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                    <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                    <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                </div>
            </div>
        </div>
        <div class="container px-0">
            <nav class="navbar navbar-light bg-white navbar-expand-xl">
                <a href="index.php" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
    <div class="navbar-nav mx-auto">

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Client') : ?>
            <a href="index2.php" class="nav-item nav-link">Home</a>
        <?php else: ?>
            <a href="../template/index2.php" class="nav-item nav-link">Home</a>
        <?php endif; ?>

        <a href="products.php" class="nav-item nav-link">Products</a>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'Admin') : ?>
            <a href="../Dashboard/index.php" class="nav-item nav-link">Dashboard</a>
            <a href="../Dashboard/articles.php" class="nav-item nav-link">Liste Articles</a>
            <a href="../Dashboard/categories.php" class="nav-item nav-link">Liste Catégories</a>
        <?php else: ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0 bg-secondary rounded-0">
                    <a href="cart.php" class="dropdown-item">Cart</a>
                    <a href="checkout.php" class="dropdown-item">Checkout</a>
                    <?php if (isset($_SESSION['user'])) : ?>
                        <a href="orders.php" class="dropdown-item">My Orders</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>



<a href="contact.php" class="nav-item nav-link">Contact</a>
                    <div class="d-flex m-3 me-0">
                        <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal">
                            <i class="fas fa-search text-primary"></i>
                        </button>
                        <a href="cart.php" class="position-relative me-4 my-auto">
                            <a href="cart.php" class="position-relative me-4 my-auto">
    <i class="fa fa-shopping-bag fa-2x"></i>
    <span id="cart-count" class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
          style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
        <?= $cartCount ?>
    </span>
</a>
                        <?php if (isset($_SESSION['user'])) : ?>
                            <div class="dropdown my-auto">
                                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="fas fa-user-circle fa-2x"></i>
                                    <small class="ms-1"><?= htmlspecialchars($_SESSION['user']['username']) ?></small>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                                    <li><a class="dropdown-item" href="orders.php"><i class="fas fa-box-open me-2"></i>My Orders</a></li>
                                    <?php if ($_SESSION['user']['role'] === 'Admin') : ?>
                                        <li><a class="dropdown-item" href="../Dashboard/index.php"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>
                                    <?php endif; ?>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                            <form action="/cakeshop/Fruitables/public/logout.php" method="post" class="px-3 py-1">
                                            <button type="submit" class="btn btn-link text-danger p-0" style="text-decoration: none;">
                                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        <?php else : ?>
                            <a href="login.php" class="my-auto">
                                <i class="fas fa-user fa-2x"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <form action="search.php" method="GET" class="input-group w-75 mx-auto d-flex">
                        <input type="search" name="q" class="form-control p-3" placeholder="Search products..." aria-describedby="search-icon-1">
                        <button type="submit" id="search-icon-1" class="input-group-text p-3 border-0 bg-primary text-white">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->