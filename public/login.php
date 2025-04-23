<?php
include BASE_PATH . '/app/views/template/navbar.php';
require_once __DIR__ . '/../app/controllers/UserC.php';
require_once __DIR__ . '/../app/models/User.php';

require __DIR__ . '/../app/config/paths.php';


// Inclusion de la navbar

?>
    <!--TEST-->
        <!-- Checkout Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <h1 class="mb-4">Login</h1>
                <form method="POST" action="inscription.php">
                <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7 mx-auto">
                    <div class="card shadow">
                        <div class="card-body p-5">
                            <h2 class="text-center mb-4">Login</h2>
                            <form action="login_process.php" method="POST">
                                <div class="form-item">
                                    <label class="form-label my-3">Username<sup>*</sup></label>
                                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                                </div>
                                <div class="form-item">
                                    <label class="form-label my-3">Password<sup>*</sup></label>
                                    <input type="password" name="pwd" class="form-control" placeholder="Enter your password" required>
                                </div>
                                <div class="form-item mt-4">
                                    <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 rounded-pill text-white w-100">Login</button>
                                </div>
                                <div class="text-center mt-3">
                                    <a href="#" class="text-decoration-none">Forgot password?</a>
                                </div>
                                <div class="text-center mt-3">
                                    Don't have an account? <a href="inscription.php" class="text-decoration-none">Register here</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
</div>
                </form>
            </div>
        </div>
        <!-- Checkout Page End -->
<?php
require_once __DIR__ . '/../app/views/template/footer.php';
?>

