<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php';
include_once('./crud/connect.php');

if (isset($_SESSION['user_id'])) {
    header("Location:index.php");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $db_username, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['username'] = $db_username;
        header('Location: ./index.php');
        exit();
    } else {
        $error_message = '<div class="alert alert-danger">Invalid username or password. Please try again.';
        // echo $error_message;
    }

    $stmt->close();
}
?>

<div class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center">Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="d-grid buttons">
                                <button type="submit" class="btn btn-dark but">Login</button>
                                <a href="index.php" class="btn btn-dark but">Go Back</a>
                            </div>
                        </form>

                    </div>
                    <div class="card-footer text-center">
                        <p class="mb-0">Don't have an account? <a href="createuser.php">Sign up</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        passwordInput.type = passwordInput.type === 'password' ? 'text' : 'password';
    });
</script>

<!-- toogle id -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- End toogle id -->

<?php include_once './includes/footer.php'; ?>