

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - CakeShop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Bootstrap & Template CSS -->
    <link href="/cakeShop/app/views/template/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/cakeShop/app/views/template/assets/css/style.css" rel="stylesheet">
</head>
<body>

    <!-- Navbar -->
    <?php include_once(__DIR__ . '/../template/navbar.php'); ?>

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <h1 class="text-primary mb-4">Tableau de bord - Administration</h1>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card border-success">
                    <div class="card-header bg-success text-white">
                        Gestion des Articles
                    </div>
                    <div class="card-body">
                        <p class="card-text">Ajouter, modifier ou supprimer les articles de la boutique.</p>
                        <a href="/cakeShop/public/index.php?page=articles" class="btn btn-success">Gérer les articles</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card border-info">
                    <div class="card-header bg-info text-white">
                        Gestion des Catégories
                    </div>
                    <div class="card-body">
                        <p class="card-text">Organiser les catégories de produits proposées.</p>
                        <a href="categories.php" class="btn btn-info">Gérer les catégories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include_once(__DIR__ . '/../template/footer.php'); ?>

    <!-- Bootstrap JS -->
    <script src="/cakeShop/app/views/template/assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
