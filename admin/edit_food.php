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

// Handle form submission for updating food item details
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $newName = $_POST["new_name"];
    $new_category = $_POST["new_category"];
    $newDescription = $_POST["new_description"];
    $newAmount = $_POST["new_amount"];
    $imagename = $_FILES["new_image"]["name"];
    $updateSql = "UPDATE food_items SET name = '$newName',category_name = '$new_category', description = '$newDescription', amount = '$newAmount' WHERE food_id = $food_id";


    // Check if a new image is uploaded
    if ($imagename != '') {
        if ($_FILES["new_image"]["size"] > 0) {
            $target_dir = "../assets/images/food/";
            $target_file = $target_dir . basename($_FILES["new_image"]["name"]);  
            move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file);
            $updateSql = "UPDATE food_items SET name = '$newName',category_name = '$new_category', description = '$newDescription', amount = $newAmount, image_url = '$imagename' WHERE food_id = $food_id";
        }
    }
    // Update food item details with the new image path
    if ($conn->query($updateSql) === TRUE) {
        // Redirect to the dashboard after successful update
        header("Location: fooditems.php");
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
        <h2>Edit Food Item</h2>
        <hr color="#e69c00">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?food_id=<?php echo $food_id ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="new_name">Food Name:</label>
                <input type="text" class="form-control" name="new_name" id="new_name" value="<?php echo $food['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_category">Food Category:</label>
                <input type="text" class="form-control" name="new_category" id="new_category" value="<?php echo $food['category_name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_description">Description:</label>
                <textarea class="form-control" name="new_description" id="new_description" rows="4" required><?php echo $food['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="new_amount">Amount:</label>
                <input type="number" class="form-control" name="new_amount" id="new_amount" value="<?php echo $food['amount']; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_image">Upload New Image:</label>
                <input type="file" class="form-control-file" name="new_image" id="new_image">
                <img src="<?= $image_url ?><?= $food['image_url'] ?>" width="200" height="200" />
            </div>
            <div class="buttons">
            <button type="submit" class="btn btn-dark mb-2 but">Update</button>
            <a href="fooditems.php" class="btn btn-secondary mb-2 but">Go Back</a>
            </div>
        </form>
    </div>
    <?php include_once '../includes/footer_r.php'; ?>
</div>
<?php include_once '../widgets/search.php'; ?>
<?php include_once('../includes/footer.php'); ?>