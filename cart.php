<?php
include_once './crud/config.php';
include_once './includes/header.php';

include_once('./crud/connect.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Check if the food_id parameter is set
$food = array();
if (isset($_GET['food_id'])) {
    $food_id = $_GET['food_id'];

    // Fetch food item details from the database
    $food_query = "SELECT * FROM food_items WHERE food_id = '$food_id'";
    $food_result = $conn->query($food_query);

    if ($food_result && $food_result->num_rows > 0) {
        $food = $food_result->fetch_assoc();
    }
}

// Handle the Add to Cart logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $quantity = $_POST['quantity'];
    $food_id = $_POST['food_id'];
    $amount = $_POST['amount'];

    // Calculate total price based on quantity and food item amount
    $total_price = $quantity * $amount;

    // Insert into the cart table
    $insert_query = "INSERT INTO cart (user_id, food_id, quantity, total_price) VALUES ($user_id, $food_id, $quantity, $total_price)";
    $conn->query($insert_query);

    // Redirect to the cart page or any other desired location
    header("Location: cart.php");
    exit();
} ?>

<div class="sub_page">
    <div class="hero_area">
        <div class="bg-box">
            <img src="<?= $image_url ?>hero-bg.jpg" alt="">
        </div>
        <?php include_once('./includes/navbar.php'); ?>
    </div>


    <?php
    if (count($food) > 0 && isset($_GET['food_id'])) {
    ?>

        <div class="container my-5 buttons">

            <h2>Food Item: <?php echo $food['name']; ?></h2>
            <hr color="#e69c00">
            <h3><?php echo $food['name']; ?></h3>
            <p>Description: <?php echo $food['description']; ?></p>
            <p>Amount: <?php echo $food['amount']; ?></p>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="food_id" value="<?php echo $food['food_id']; ?>">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" value="1" min="1" required>
                <input type="hidden" name="food_id" value="<?= $food['food_id'] ?>">
                <input type="hidden" name="amount" value="<?= $food['amount'] ?>">
                <button type="submit" name="cart" class="btn but">Add to Cart</button>
                <button type="submit" name="cart" class="btn but">Buy</button>
            </form>
        </div>

        <?php } else {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT cart.*, fi.* FROM cart LEFT JOIN food_items AS fi ON fi.food_id = cart.food_id WHERE user_id = $user_id";
        $cartResult = $conn->query($sql);
        if ($cartResult && $cartResult->num_rows > 0) {
            while ($row = $cartResult->fetch_assoc()) {

        ?>
                <div class="container">
                    <div class="row py-5">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Item Name</th>
                                    <th>Item Qty</th>
                                    <th>Item Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $total_qty = 0;
                                $total_amt = 0;
                                foreach ($cartResult as $row) {
                                    $total_qty = $total_qty + $row['quantity'];
                                    $total_amt = $total_amt + $row['total_price'];
                                ?>
                                    <tr>
                                        <td><?= $count++; ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['quantity'] ?></td>
                                        <td><?= $row['total_price'] ?></td>
                                        <td><a href="delete_cart.php?cart_id=<?php echo $row['cart_id']; ?>" class='btn btn-danger' onclick="return confirmDelete();">
                                                <i class='bi bi-trash'></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <th colspan="2" style="text-align: right;">Total</th>
                                <th colspan=""><?= $total_qty; ?></th>
                                <th colspan=""><?= $total_amt; ?></th>
                            </tr>
                            </tbody>
                        </table>
                        <div class="buttons">
                            <a href="buy.php" class="btn btn-dark but">Buy</a>
                        </div>
                    </div>
                </div>
            <?php
        } else {
            ?>
                <div class="container mb-5" style="margin-top: 8%;">
                    <h1 style="text-align: center;">Cart is empty</h1>
                </div>
        <?php }
    }
        ?>
</div>

<?php include_once './widgets/search.php'; ?>
<?php include_once './includes/footer_r.php'; ?>
<?php include_once './includes/footer.php'; ?>