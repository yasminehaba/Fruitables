<?php include __DIR__ . '../../template/navbar.php'; ?>
<?php
// session_start();
// $_SESSION['role'] = 'admin'; // à retirer ou adapter selon ton système d’authentification
// ?>
<?php
require_once __DIR__ . '/../../controllers/ArticleController.php';
require_once __DIR__ . '/../../models/Article.php';


$articleController = new ArticleController();
$articles = $articleController->AfficherArticle();
?>



?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des articles</h2>
    <div class="text-end mb-3">
        <a href="articleAdd.php" class="btn btn-primary">Ajouter un article</a> <!-- Tu pourras remplacer ce lien plus tard -->
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Catégorie</th>
                <th>Nom</th>
                <th>Image</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($articles as $article): ?>
            <tr class="text-center align-middle">
    <td><?= htmlspecialchars($article['id']) ?></td>
    <td><?= htmlspecialchars($article['idCat']) ?></td>
    <td><?= htmlspecialchars($article['nom']) ?></td>
    <td>Image non disponible</td>
    <td><?= htmlspecialchars($article['description']) ?></td>
    <td><?= htmlspecialchars($article['prix']) ?> TND</td>
    <td><?= htmlspecialchars($article['nbStock']) ?></td>
    <td><?= htmlspecialchars($article['status']) ?></td>
    <td>
        <a href="modifier_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-warning">Modifier</a>
        <a href="../../actions/supprimer_article.php?id=<?= $article['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
    </td>
</tr>

        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '../../template/footer.php'; ?>
