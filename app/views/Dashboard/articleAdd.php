
<?php include __DIR__ . '../../template/navbar.php'; ?>
<br>
<br> <br><br> <br><br> <br><br> <br>
<?php
require_once __DIR__ . '/../../controllers/ArticleController.php';
require_once __DIR__ . '/../../models/Article.php';
require_once __DIR__ . '/../../controllers/CategorieController.php'; // Ajout

$ArticleController = new ArticleController();
$CategorieController = new CategorieController(); // Nouvelle instance

$categories = $CategorieController->AfficherCategorie(); // Récupération des catégories
$articles = $ArticleController->AfficherArticle();

if (
    isset($_POST["idCat"], $_POST["nom"], $_POST["image"], $_POST["description"], $_POST["prix"], $_POST["nbStock"], $_POST["status"])
) {
    if (
        !empty($_POST["idCat"]) && !empty($_POST["nom"]) && !empty($_POST["image"]) &&
        !empty($_POST["description"]) && !empty($_POST["prix"]) &&
        !empty($_POST["nbStock"]) && !empty($_POST["status"])
    ) {
       

        
            $article = new Article(
                null,
                $_POST["idCat"],
                $_POST["nom"],
                $_POST["image"],
                $_POST["description"],
                $_POST["prix"],
                $_POST["nbStock"],
                $_POST["status"]
            );
            $ArticleController->AjouterArticle($article);
          
        
    } else {
        echo "<div class='alert alert-danger text-center'>Tous les champs sont obligatoires.</div>";
    }
}
?>


<form method="POST"  class="mb-5">
    <div class="row mb-3">
        <div class="col">
            <select name="idCat" class="form-select" required>
                <option value="">-- Choisir une catégorie --</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>"><?= htmlspecialchars($categorie['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <input type="text" name="nom" class="form-control" placeholder="Nom de l'article" required>
        </div>
    </div>
        <div class="row mb-3">
            <div class="col">
			<input type="text" name="image" class="form-control"  required>
            </div>
            <div class="col">
                <input type="text" name="description" class="form-control" placeholder="Description" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="number" step="0.01" name="prix" class="form-control" placeholder="Prix" required>
            </div>
            <div class="col">
                <input type="number" name="nbStock" class="form-control" placeholder="Stock disponible" required>
            </div>
        </div>
        <div class="mb-3">
            <select name="status" class="form-select" required>
                <option value="">-- Choisir un status --</option>
                <option value="Disponible">Disponible</option>
                <option value="Indisponible">Indisponible</option>
            </select>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-success">Ajouter</button>
        </div>
    </form>

   
</div>

<?php include __DIR__ . '../../template/footer.php'; ?>
