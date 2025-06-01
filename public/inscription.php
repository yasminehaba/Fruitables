<?php
require_once __DIR__ . '/../app/config/paths.php';
require_once BASE_PATH . '/app/controllers/UserC.php';
require_once BASE_PATH . '/app/models/User.php';

$UserC = new UserC();
$erreur = "";
$iserreur = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupération et nettoyage des données
        $username = htmlspecialchars($_POST['username']);
        $adresse = htmlspecialchars($_POST['adresse']);
        $tlf = htmlspecialchars($_POST['tlf']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $pwd = $_POST['pwd'];

        // Validation e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email invalide");
        }

        // Vérification doublon
        if ($UserC->RecupererUserByEmail($email)) {
            throw new Exception("Email déjà utilisé");
        }

        // Création et insertion de l'utilisateur
        $user = new User($username, $email, $pwd, $adresse, $tlf, "Client");
        
        if ($UserC->AjouterUser($user)) {
            header("Location: login.php");
            exit();
        } else {
            throw new Exception("Échec de l'ajout de l'utilisateur");
        }

    } catch (Exception $e) {
        $iserreur = true;
        $erreur = $e->getMessage();
    }
}

// Only include navbar AFTER all PHP processing is done
require_once BASE_PATH . '/app/views/template/navbar.php';
?>

<!-- Formulaire HTML -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Inscription</h1>
        <form method="POST" action="">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Nom<sup>*</sup></label>
                                <input type="text" name="username" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Adresse<sup>*</sup></label>
                        <input type="text" name="adresse" class="form-control" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Téléphone<sup>*</sup></label>
                        <input type="tel" name="tlf" class="form-control" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Adresse e-mail<sup>*</sup></label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-item">
                        <label class="form-label my-3">Mot de passe<sup>*</sup></label>
                        <input type="password" name="pwd" class="form-control" required>
                    </div>

                    <br>
                    <div class="form-item">
                        <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 rounded-pill text-white">
                            S'inscrire
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../app/views/template/footer.php'; ?>
