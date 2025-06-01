<?php
ob_start();

include __DIR__ . '../../template/navbar.php';
require_once __DIR__ . '/../../controllers/ArticleController.php';
require_once __DIR__ . '/../../models/Article.php';

$articleController = new ArticleController();

// Suppression
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $articleController->SupprimerArticle($id);
    header('Location: articles.php');
    exit();
}

// Modification
if (isset($_POST['modifier'])) {
    $article = new Article(
        $_POST['id'],
        $_POST['idCat'],
        $_POST['nom'],
        $_POST['image'] ?? '', // Keep existing image if not modified
        $_POST['description'],
        $_POST['prix'],
        $_POST['nbStock'],
        $_POST['status']
    );
    $articleController->modifierArticle($article, $_POST['id']);
    header('Location: articles.php');
    exit();
}

// Afficher les articles
$articles = $articleController->AfficherArticle();
?>

<br><br>

<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des articles</h2>
    <div class="text-end mb-3">
        <a href="articleAdd.php" class="btn btn-primary">Ajouter un article</a>
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
                    <td>
                        <?php if (!empty($article['image'])): ?>
                            <img src="/cakeshop/Fruitables/app/uploads/<?= htmlspecialchars(basename($article['image'])) ?>"
                                alt="<?= htmlspecialchars($article['nom']) ?>" 
                                style="max-width: 100px; max-height: 100px;"
                                class="img-fluid w-100 rounded-top">

                        <?php else: ?>
                            Image non disponible
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($article['description']) ?></td>
                    <td><?= htmlspecialchars($article['prix']) ?> TND</td>
                    <td><?= htmlspecialchars($article['nbStock']) ?></td>
                    <td><?= htmlspecialchars($article['status']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editModal<?= $article['id'] ?>">Modifier</button>
                        <a class="btn btn-danger btn-sm" href="articles.php?id=<?= $article['id'] ?>"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="editModal<?= $article['id'] ?>" tabindex="-1"
                    aria-labelledby="editModalLabel<?= $article['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?= $article['id'] ?>">Modifier l'article</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Fermer"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id" value="<?= $article['id'] ?>">
                                    <input type="hidden" name="image" value="<?= $article['image'] ?>">
                                    <div class="mb-3">
                                        <label>Catégorie</label>
                                        <input type="text" class="form-control" name="idCat"
                                            value="<?= $article['idCat'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Nom</label>
                                        <input type="text" class="form-control" name="nom" value="<?= $article['nom'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Description</label>
                                        <textarea class="form-control"
                                            name="description"><?= $article['description'] ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Prix</label>
                                        <input type="number" class="form-control" name="prix"
                                            value="<?= $article['prix'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Stock</label>
                                        <input type="number" class="form-control" name="nbStock"
                                            value="<?= $article['nbStock'] ?>">
                                    </div>
                                    <div class="mb-3">
                                        <label>Status</label>
                                        <input type="text" class="form-control" name="status"
                                            value="<?= $article['status'] ?>">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="modifier" class="btn btn-primary">Enregistrer</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '../../template/footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>