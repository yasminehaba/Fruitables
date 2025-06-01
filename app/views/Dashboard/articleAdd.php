<?php
// Enable error reporting and start session at the VERY TOP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Process form data before any output
require_once __DIR__ . '/../../controllers/ArticleController.php';
require_once __DIR__ . '/../../models/Article.php';
require_once __DIR__ . '/../../controllers/CategorieController.php';

$ArticleController = new ArticleController();
$CategorieController = new CategorieController();
$categories = $CategorieController->AfficherCategorie();

// Image upload handling
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate all fields are set
    if (isset(
        $_POST["idCat"],
        $_POST["nom"],
        $_POST["description"],
        $_POST["prix"],
        $_POST["nbStock"],
        $_POST["status"]
    ) && isset($_FILES["image"])) {
        
        // Check for empty fields
        if (!empty($_POST["idCat"]) && 
            !empty($_POST["nom"]) && 
            !empty($_FILES["image"]["name"]) && 
            !empty($_POST["description"]) && 
            !empty($_POST["prix"]) && 
            !empty($_POST["nbStock"]) && 
            !empty($_POST["status"])) {
            
            // Handle image upload
            $uploadDir = __DIR__ . '/../../uploads/';
            
            // Create directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $image = $_FILES["image"];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $maxSize = 5 * 1024 * 1024; // 5MB

            // Validate image
            if (!in_array($image['type'], $allowedTypes)) {
                $_SESSION['error'] = "Seuls les fichiers JPG, PNG, GIF et WEBP sont autorisés.";
            } elseif ($image['size'] > $maxSize) {
                $_SESSION['error'] = "La taille du fichier ne doit pas dépasser 5MB.";
            } else {
                // Generate unique filename
                $extension = pathinfo($image['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $extension;
                $destination = $uploadDir . $filename;

                if (move_uploaded_file($image['tmp_name'], $destination)) {
                    $article = new Article(
                        null,
                        $_POST["idCat"],
                        $_POST["nom"],
                        'uploads/' . $filename,
                        $_POST["description"],
                        $_POST["prix"],
                        $_POST["nbStock"],
                        $_POST["status"]
                    );

                    try {
                        $result = $ArticleController->AjouterArticle($article);
                        if ($result) {
                            $_SESSION['success'] = "Article ajouté avec succès!";
                            header("Location: articles.php");
                            exit();
                        } else {
                            // Delete the uploaded image if database insert failed
                            unlink($destination);
                            $_SESSION['error'] = "Erreur lors de l'ajout dans la base de données.";
                        }
                    } catch (Exception $e) {
                        // Delete the uploaded image if an exception occurred
                        if (file_exists($destination)) {
                            unlink($destination);
                        }
                        $_SESSION['error'] = "Erreur: " . $e->getMessage();
                    }
                } else {
                    $_SESSION['error'] = "Erreur lors du téléchargement de l'image.";
                }
            }
        } else {
            $_SESSION['error'] = "Tous les champs sont obligatoires.";
        }
    } else {
        $_SESSION['error'] = "Tous les champs doivent être remplis.";
    }
}

// Now include the header and display the form
include __DIR__ . '../../template/navbar.php';
?>

<div class="container">
    <br><br><br><br><br><br><br><br>
    
    <!-- Display success/error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success text-center"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger text-center"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <h2 class="my-4">Ajouter un nouvel article</h2>
    
    <form method="POST" enctype="multipart/form-data" class="mb-5">
        <div class="row mb-3">
            <div class="col">
                <select name="idCat" class="form-select" required>
                    <option value="">-- Choisir une catégorie --</option>
                    <?php foreach ($categories as $categorie): ?>
                        <option value="<?= htmlspecialchars($categorie['id']) ?>">
                            <?= htmlspecialchars($categorie['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col">
                <input type="text" name="nom" class="form-control" placeholder="Nom de l'article" required>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Image de l'article</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
                <small class="text-muted">Formats acceptés: JPG, PNG, GIF, WEBP (max 5MB)</small>
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
            <button type="submit" class="btn btn-success px-4">Ajouter</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '../../template/footer.php'; ?>