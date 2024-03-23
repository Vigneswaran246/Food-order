<?php

include_once '../crud/config.php';
include_once('../crud/connect.php');

if (!isset($_SESSION['user_id'])) {
    // header("Location:../login.php");
}

// Check if the food_id parameter is set
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Fetch food item details from the database
    $sql = "SELECT * FROM food_items WHERE food_id = $food_id";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $food = $result->fetch_assoc();
    } else {
        // Redirect to the dashboard if the food item is not found
        header("Location: fooditems.php");
        exit();
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Delete the food item from the database
    $deleteSql = "DELETE FROM food_items WHERE food_id = $food_id";

    if ($conn->query($deleteSql) === TRUE) {
        // Redirect to the dashboard after successful deletion
        header("Location: fooditems.php");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
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
        <h2>Delete Food Item</h2>
        <hr color="#e69c00">

        <p>Are you sure you want to delete the following food item?</p>

        <div class="card" style="width: 18rem;">
            <img src="<?= $image_url; ?><?php echo $food['image_url']; ?>" class="card-img-top" alt="Food Image">
            <div class="card-body">
                <h5 class="card-title"><?php echo $food['name']; ?></h5>
                <p class="card-text"><?php echo $food['description']; ?></p>
                <p class="card-text">Amount: <?php echo $food['amount']; ?></p>
            </div>
        </div>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?food_id=<?=$food_id?>">
            <div class="buttons">
            <button type="submit" class="btn btn-danger mt-2 but">Delete</button>
            <a href="fooditems.php" class="btn btn-secondary mt-2 but">Cancel</a>
            </div>
        </form>
    </div>
</div>