<?php
session_start();

require_once __DIR__ . '/../app/config/paths.php';
require_once BASE_PATH . '/app/controllers/UserC.php';

$error = '';
$userC = new UserC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['pwd'] ?? '';
    
    $user = $userC->loginUser($username, $password);
    
    if ($user) {
        $_SESSION['user'] = $user;
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = $user['role'];

        // Redirection selon le rôle
        if ($user['role'] === 'Admin') {
            header('Location: ../app/views/Dashboard/index.php');
        } else {
            header('Location: ../app/views/template/index2.php');
        }
        exit();
    } else {
        $error = 'Invalid username/email or password';
    }
}

include BASE_PATH . '/app/views/template/navbar.php';
?>

<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Login</h1>
        <?php if ($error): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7 mx-auto">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Login</h2>
                            <div class="form-item">
                                <label class="form-label my-3">Username or Email<sup>*</sup></label>
                                <input type="text" name="username" class="form-control" placeholder="Enter your username or email" required>
                            </div>
                            <div class="form-item">
                                <label class="form-label my-3">Password<sup>*</sup></label>
                                <input type="password" name="pwd" class="form-control" placeholder="Enter your password" required>
                            </div>
                            <div class="form-item mt-4">
                                <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 rounded-pill text-white w-100">Login</button>
                            </div>
                            <div class="text-center mt-3">
                                <a href="forgot_password.php" class="text-decoration-none">Forgot password?</a>
                            </div>
                            <div class="text-center mt-3">
                                Don't have an account? <a href="inscription.php" class="text-decoration-none">Register here</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../app/views/template/footer.php'; ?>
