<?php
include_once '../crud/config.php';
include_once('../crud/connect.php');


if (isset($_SESSION['user_id']) && $_SESSION['user_id'] != '1') {
    //header('Location: ../index.php');
}

if (!isset($_SESSION['user_id'])) {
    //header("Location:../login.php");
}

// Fetch all food items from the database
$sql = "SELECT * FROM food_items";
$result = $conn->query($sql);

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
    <div class="container">
        <div class="row">
            <h2 class="col-6 mt-4">Food Items Dashboard</h2>
            <hr color="#e69c00">
            <div class="col-6 mt-4" style="text-align: right;">
                <h2><a href="upload.php" class="btn btn-dark" style="justify-content: left;">
                        <i class="bi bi-plus"></i>
                        Add New
                    </a></h2>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Food ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th style="text-align: center;">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['food_id']}</td>";
                        echo "<td><img src='{$image_url}{$row['image_url']}' alt='Food Image' style='max-width: 100px;'></td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['category_name']}</td>";
                        echo "<td>{$row['description']}</td>";
                        echo "<td>{$row['amount']}</td>";
                        echo "<td width='120'>
                                <a href='edit_food.php?food_id={$row['food_id']}' class='btn btn-dark'><i class='bi bi-pencil-fill'></i></a>
                                <a href='delete_food.php?food_id={$row['food_id']}' class='btn btn-danger'><i class='bi bi-trash'></i></a>
                              </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include_once '../includes/footer_r.php'; ?>
</div>
<?php include_once '../widgets/search.php'; ?>
<?php include_once '../includes/footer.php'; ?>