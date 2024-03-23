<?php
include_once '../crud/config.php';
include_once('../crud/connect.php');


if (!isset($_SESSION['user_id'])) {
    // header("Location:../login.php");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $description = $_POST["description"];
    $amount = $_POST["amount"];
    $category_name = $_POST["category_name"];

    // File upload handling
    $target_dir = "../assets/images/food/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";

            // Insert data into the database
            $image_url = basename($_FILES["image"]["name"]);
            $sql = "INSERT INTO food_items (image_url, name,category_name, description, amount) VALUES ('$image_url', '$name', '$category_name', '$description', $amount)";

            if ($conn->query($sql) === TRUE) {
                echo "New food item added successfully.";
                header("Location: fooditems.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

// Close the database connection
$conn->close();

?>

<?php include_once('../includes/header.php'); ?>

<div class="sub_page">

    <div class="hero_area">
        <div class="bg-box">
            <img src="<?= $image_url ?>/hero-bg.jpg" alt="">
        </div>

        <?php include_once '../includes/navbar.php'; ?>

    </div>
    <div class="container mb-5">
        <h2 class="mt-4">Upload Food Item</h2>
        <hr color="#e69c00">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td><label for="name">Food Name:</label></td>
                    <td><input type="text" name="name" id="name" required></td>
                </tr>
                <tr>
                    <td><label for="category_name">Food Category:</label></td>
                    <td><input type="text" name="category_name" id="category_name" required></td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                    <td><textarea name="description" id="description" rows="4" required></textarea></td>
                </tr>
                <tr>
                    <td><label for="amount">Amount:</label></td>
                    <td><input type="number" name="amount" id="amount" required></td>
                </tr>
                <tr>
                    <td><label for="image">Select image to upload:</label></td>
                    <td><input type="file" name="image" id="image" required></td>
                </tr>
            </table>
            <div class="buttons">
                <input type="submit" class="btn but" style="background-color: #ffbe33;" value="Upload Food Item" name="submit">
                <a href="fooditems.php" class="btn btn-dark but">Go Back</a>
            </div>
        </form>
    </div>
    <?php include_once '../includes/footer_r.php'; ?>
</div>
<?php include_once '../widgets/search.php'; ?>
<?php include_once '../includes/footer.php'; ?>