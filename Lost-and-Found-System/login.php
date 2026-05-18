<?php
session_start();
include 'config/config.php';

$error = "";

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT user_id, email, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
    <?php include 'head.php'; ?>
    <body>
        <div class="bg-image shadow-1-strong">
            <div class="mask d-flex align-items-center h-100">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-12 text-center">
                            <h1 style="color: #311432;" class="fw-bold mt-5">Welcome to Reclaim!</h1>
                            <p class="text-muted">Log into your account here.</p>
                        </div>
                    </div>

                    <!-- LOG IN CARD -->
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card" style="width: 28rem;">
                                <div class="card-body mt-4">
                                    
                                    <?php if ($error): ?>
                                        <div class="alert alert-danger py-2" role="alert">
                                            <small><?= $error ?></small>
                                        </div>
                                    <?php endif; ?>

                                    <form method="POST" action="">
                                        <div class="mb-3">
                                            <label for="input-email" class="form-label">Email address</label>
                                            <input type="email" class="form-control" id="input-email" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input-password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="input-password" name="password" required>
                                        </div>
                                        <div class="mb-3">
                                            <p>New here? 
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#register-modal" 
                                                class="text-secondary">Register</a>
                                            </p>
                                        </div>
                                        <button type="submit" name="login" class="btn w-100 my-3" style="background-color: #311432;color: white;">
                                            Sign in
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>
        </div>

        <?php include 'modals.php'; ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>