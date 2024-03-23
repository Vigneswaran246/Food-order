
<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php'; ?>
<?php

include_once('./crud/connect.php'); // Include the database connection file

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Retrieve user information from the database based on the user ID
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the user exists
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // Handle case when the user is not found
    echo "User not found.";
    exit();
}

$stmt->close();
?>

<div class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
            <img src="<?= $image_url ?>hero-bg.jpg" alt="">
        </div>
        <?php include_once('./includes/navbar.php'); ?>
    </div>
    <div class="container mt-5">
        <h2>User Profile</h2>
        <hr color="#e69c00">
        <div class="mb-3">
            <strong>Username        :       </strong> <?php echo $user['username']; ?>
        </div>
        <div class="mb-3">
            <strong>Email           :       </strong> <?php echo $user['email']; ?>
        </div>
        <div class="mb-3">
            <strong>Full Name       :       </strong> <?php echo $user['full_name']; ?>
        </div>
        <div class="mb-3">
            <strong>Phone Number    :       </strong> <?php echo $user['phone_number']; ?>
        </div>
        <div class="mb-3">
            <strong>Address         :       </strong> <?php echo $user['address']; ?>
        </div>
            <div class="buttons">
            <a href="./admin/edit_profile.php?user_id=<?= $user['user_id']; ?>" class="btn my-3 but">Edit Profile</a>
            <a href="./index.php" class="btn my-3 but">Go Back</a>
        </div>
    </div>
</div>
<?php include_once './widgets/search.php'; ?>
<?php include_once './includes/footer_r.php'; ?>
<?php include_once './includes/footer.php'; ?>