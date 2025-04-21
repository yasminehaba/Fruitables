<?php
// Enable error reporting at the VERY TOP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define base path
define('BASE_DIR', dirname(__DIR__, 2));

// Load dependencies
require_once BASE_DIR . '/config/Connexion.php';
require_once BASE_DIR . '\controllers\CategorieController.php';
require_once BASE_DIR . '\models\Categorie.php';

// Initialize controller
$categorieController = new CategorieController();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $categorie = new Categorie($name);
        if ($categorieController->AjouterCategorie($categorie)) {
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }
    
    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $categorie = new Categorie($name, $id);
        if ($categorieController->modifierCat($categorie, $id)) {
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        }
    }
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($categorieController->SupprimerCategorie($id)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}

// Get categories for display
$categories = $categorieController->AfficherCategorie();

// Include navbar after all processing
include     (__DIR__ . '/../template/navbar.php'); 
?>

<!-- Cart Page Start -->
<br><br><br><br><br>
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Categorie ID</th>
                        <th scope="col">Categorie Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $categorie): ?>
                    <tr>
                        <td><?php echo $categorie['id']; ?></td>
                        <td><?php echo $categorie['name']; ?></td>
                        <td>
                            <!-- Bouton Edit avec modal -->
                            <button class="btn btn-md rounded-circle bg-light border mt-4 text-success" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal<?php echo $categorie['id']; ?>">
                                Edit
                            </button>
                            
                            <a href="categorie.php?delete=<?php echo $categorie['id']; ?>" 
                               class="btn btn-md rounded-circle bg-light border mt-4 text-danger"
                               onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie?')">
                                Delete
                            </a>
                            
                            <!-- Modal pour l'édition -->
                            <div class="modal fade" id="editModal<?php echo $categorie['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Modifier la catégorie</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form method="post">
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?php echo $categorie['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Nom de la catégorie</label>
                                                    <input type="text" class="form-control" id="name" name="name" 
                                                           value="<?php echo $categorie['name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                <button type="submit" name="update" class="btn btn-primary">Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <!-- Formulaire d'ajout -->
        <div class="mt-5">
            <form method="post" class="d-flex align-items-center">
                <input type="text" name="name" class="border-0 border-bottom rounded me-5 py-3 mb-4" 
                       placeholder="Categorie Name" required>
                <button type="submit" name="add" class="btn border-secondary rounded-pill px-4 py-3 text-primary">
                    Add
                </button>
            </form>
        </div>
    </div>
</div>
<!-- Cart Page End -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<?php include (__DIR__ . '/../template/footer.php'); ?>