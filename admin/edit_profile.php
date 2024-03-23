<?php
include_once '../crud/config.php';
include_once('../crud/connect.php');

// Check if the food_id parameter is set
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch food item details from the database
    $sql = "SELECT * FROM users WHERE user_id = $user_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        header("Location: edit_profile.php");
        exit();
    }
    if(!isset($_SESSION['user_id'])) {
        // header("Location:../login.php");
    }
}

// Handle form submission for updating food item details
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $full_name = $_POST["full_name"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $updateSql = "UPDATE users SET username = '$username',email = '$email', full_name = '$full_name', phone_number = '$phone_number' WHERE user_id = $user_id";

    // Update user details
    if ($conn->query($updateSql) === TRUE) {
        // Redirect to the dashboard after successful update
        header("Location: ../profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
        exit();
    }
}

// Close the database connection
$conn->close();

?>

<?php include_once('../includes/header.php'); ?>

<div class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="<?= $image_url; ?>hero-bg.jpg" alt="">
        </div>

        <?php include_once '../includes/navbar.php'; ?>

    </div>
    <div class="container mt-4">
        <h2>Edit Profile</h2>
        <hr color="#e69c00">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?user_id=<?php echo $user_id ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required value="<?php echo $user['username']; ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" id="email" required value="<?php echo $user['email']; ?>">
            </div>
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" class="form-control" name="full_name" id="full_name" required value="<?php echo $user['full_name']; ?>">
            </div>
            <div class="form-group">
                <label for="phone_number">Phone No:</label>
                <input type="number" class="form-control" name="phone_number" id="phone_number" required value="<?php echo $user['phone_number']; ?>">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" class="form-control" name="address" id="address" rows="4" required value="<?php echo $user['address']; ?>">
            </div>
            <div class="buttons">
                <button type="submit" class="btn btn-dark mb-2 but">Update</button>
                <a href="../profile.php" class="btn btn-secondary mb-2 but">Go Back</a>
            </div>
        </form>
    </div>
    <?php include_once '../includes/footer_r.php'; ?>
</div>
<?php include_once '../widgets/search.php'; ?>
<?php include_once('../includes/footer.php'); ?>