<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php'; ?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database connection code
    include_once('./crud/connect.php');

    // Retrieve user input
    $newUsername = $_POST['new_username'];
    $newEmail = $_POST['new_email'];
    $newPassword = $_POST['new_password'];
    $newFullName = $_POST['new_full_name'];
    $newPhoneNumber = $_POST['new_phone_number'];
    $newAddress = $_POST['new_address'];

    // Check if the username or email already exists
    $checkExisting = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
    $checkExisting->bind_param("ss", $newUsername, $newEmail);
    $checkExisting->execute();
    $checkExisting->store_result();

    if ($checkExisting->num_rows > 0) {
        $error_message = 'Username or email already exists. Please choose a different one.';
    } else {
        // Insert the new user into the database
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $insertUser = $conn->prepare("INSERT INTO users (username, email, password, full_name, phone_number, address) VALUES (?, ?, ?, ?, ?, ?)");
        $insertUser->bind_param("ssssss", $newUsername, $newEmail, $hashedPassword, $newFullName, $newPhoneNumber, $newAddress);

        if ($insertUser->execute()) {
            $_SESSION['user_id'] = $insertUser->insert_id;
            $_SESSION['username'] = $newUsername;
            header('Location: login.php'); // Redirect to the main page or dashboard
            exit();
        } else {
            $error_message = 'Error creating user. Please try again.';
        }

        $insertUser->close();
    }

    $checkExisting->close();
}
?>

<!-- Your HTML form for creating a new user -->



<div class="container mt-5">
    <h2>Create New User</h2>
    <?php if (isset($error_message)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form method="post" action="createuser.php" class="row g-3 needs-validation"> <!-- Update the action attribute with the correct PHP file -->

        <div class="col-md-5">
            <label for="new_full_name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="new_full_name" name="new_full_name" required>
        </div>
        <div class="col-md-5">
            <label for="new_username" class="form-label">Username</label>
            <input type="text" class="form-control" id="new_username" name="new_username" required>
        </div>
        <div class="col-md-5">
            <label for="new_email" class="form-label">Email</label>
            <input type="email" class="form-control" id="new_email" name="new_email" required>
        </div>
        <div class="col-md-5">
            <label for="new_password" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="new_password" name="new_password" required>
                <button class="btn btn-outline-secondary" type="button" id="togglenew_Password">
                    <i class="bi bi-eye"></i>
                </button>
            </div>
        </div>
        <div class="col-md-5">
            <label for="new_phone_number" class="form-label">Phone Number</label>
            <input type="tel" class="form-control" id="new_phone_number" name="new_phone_number">
        </div>
        <div class="col-md-5">
            <label for="new_address" class="form-label">Address</label>
            <textarea class="form-control" id="new_address" name="new_address" rows="3"></textarea>
        </div>
        <div class="col-6 col-sm-3">
            <button type="submit" class="btn btn-primary">Create User</button>
        </div>
    </form>


</div>

<script>
    // Toggle password visibility
    document.getElementById('togglenew_Password').addEventListener('click', function() {
        const new_passwordInput = document.getElementById('new_password');
        new_passwordInput.type = new_passwordInput.type === 'password' ? 'text' : 'password';
    });
</script>
<!-- toogle id -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- End toogle id -->
<?php include_once './widgets/search.php'; ?>
<?php include_once './includes/footer.php'; ?>