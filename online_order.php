<?php include_once './crud/config.php'; ?>
<?php include_once './includes/header.php'; ?>

<style>
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    button {
        padding: 10px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }

    button:hover {
        background-color: #45a049;
    }

</style>

<div class="container">
    <h1>Online Food Order</h1>

    <form id="orderForm" action="online_order.php" method="post">
        <label for="foodItem">Select Food Item:</label>
        <select id="foodItem" name="foodItem" required>
            <option value="burger">Burger</option>
            <option value="pizza">Pizza</option>
            <option value="pasta">Pasta</option>
        </select>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" min="1" required>

        <button type="submit">Place Order</button>
    </form>
</div>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assume a user is logged in, you should handle user authentication properly
    $userId = 1; // Replace with the actual user ID

    // Retrieve order details from the form
    $food_id = $_POST['food_id']; // Assuming you have a form field for selecting food items
    $quantity = intval($_POST['quantity']);
    $totalPrice = calculateTotalPrice($food_id, $quantity);

    // Save order details in the database (you need to implement the database connection)
    // For simplicity, we are not including the database connection code here

    // Display a confirmation message
    echo "Order placed successfully! Total Price: $totalPrice";
}

function calculateTotalPrice($food_id, $quantity) {
    // Replace this with your pricing logic or fetch prices from a database
    $price = getPriceForFood($food_id);

    if ($price !== false) {
        return $price * $quantity;
    } else {
        return 0; // Invalid food item
    }
}

function getPriceForFood($food_id) {
    // Replace this with your database query to fetch the price for the selected food item
    // For simplicity, we assume you have a function to retrieve the price
    $prices = [
        1 => 5.99, // Assuming food_id 1 corresponds to the Burger
        2 => 8.99, // Assuming food_id 2 corresponds to the Pizza
        3 => 6.99  // Assuming food_id 3 corresponds to the Pasta
    ];

    if (array_key_exists($food_id, $prices)) {
        return $prices[$food_id];
    } else {
        return false; // Food item not found
    }
}
?>

<?php include_once './includes/footer.php'; ?>  