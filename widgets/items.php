<?php include('./crud/connect.php');

// Query to retrieve food items

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $searchText = $_POST['searchText'];
    $categorySql = "SELECT DISTINCT category_name FROM `food_items` WHERE `name` LIKE '%$searchText%' ";
} else {
    $categorySql = "SELECT DISTINCT category_name  FROM food_items";
}


$categoryResult = $conn->query($categorySql);
?>
<ul class="filters_menu">
    <li class="active" data-filter="*">All</li>
    <?php
    // Check if there are results
    if ($categoryResult->num_rows > 0) {
        while ($row = $categoryResult->fetch_assoc()) {
            echo '<li data-filter=".' . $row["category_name"] . '">' . $row["category_name"] . '</li>';
        }
    }
    ?>
</ul>

<div class="filters-content">
    <div class="row grid">
        <?php

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $searchText = $_POST['searchText'];
            $sql = "SELECT * FROM `food_items` WHERE `name` LIKE '%$searchText%' ";
        } else {
            $sql = "SELECT * FROM food_items";
        }
        // Query to retrieve food items

        $result = $conn->query($sql);

        // Check if there are results
        if ($result->num_rows > 0)

            while ($row = $result->fetch_assoc()) {
        ?>
            <div class="col-sm-6 col-lg-4 all <?php echo $row['category_name'] ?>">
                <div class="box">
                    <div>
                        <div class="img-box">
                            <img src="<?php echo $image_url . $row['image_url'] ?>" alt="food image">
                        </div>
                        <div class="detail-box">
                            <h5>
                                <?php echo $row['name'] ?>
                            </h5>
                            <p>
                                <?php echo $row['description'] ?>
                            </p>
                            <div class="options">
                                <h6>
                                    $<?php echo $row['amount'] ?>

                                </h6>
                                <a href="../cart.php?food_id=<?= $row['food_id']; ?>">
                                    <i class=" bi bi-cart-fill text-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        ?>
    </div>
</div>