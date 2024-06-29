<?php
include 'db_connection.php';
session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$total_price = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0.00;
$total_products = isset($_POST['total_products']) ? json_decode($_POST['total_products'], true) : [];

if (isset($_POST['order_btn'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['method']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card']);
    $card_cvv = mysqli_real_escape_string($conn, $_POST['debit_cvv']);
    $card_expiry = mysqli_real_escape_string($conn, $_POST['debit_expiry']);

    // Convert total_products array to a string
    $total_product_string = implode(', ', array_column($total_products, 'name'));

    // Insert order details into the orders table
    $query = "INSERT INTO orders (name, email, method, address, city, state, total_products, total_price, card_number, card_cvv, card_expiry) 
              VALUES ('$name', '$email', '$payment_method', '$address', '$city', '$state', '$total_product_string', '$total_price', '$card_number', '$card_cvv', '$card_expiry')";
    $detail_query = mysqli_query($conn, $query);

    if ($detail_query) {
        // Success message and pop-up script
        echo "
        <script>
            window.onload = function() {
                alert('Thank you for shopping! Your order has been placed.');
            }
        </script>
        ";

        // Clear the shopping cart or perform any other necessary actions
        // For example, redirecting after displaying the message:
        // header('Location: products.php');
    } else {
        die('Query failed: ' . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationery Shop Checkout</title>
    <link rel="stylesheet" href="payment.css">
    <script defer src="payment.js"></script>
</head>
<body>

<header>
    <a id="back" href="../Shopping_cart/shopping_cart.php"><b>BACK TO CART</b></a>
    <h1 style="margin-top: 40px; text-align: center;">OKAY STATIONERY SHOP</h1>
</header>

<section>
    <div class="payment">
        <h1>Payment Form</h1>
        <form id="paymentForm" action="payment.php" method="post">
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>

            <label for="address">Address</label>
            <input type="text" id="address" name="address" required>

            <label for="state">State</label>
            <select id="state" name="state" required>
                <option value="" disabled selected>Select State</option>
                <option value="Johor">Johor</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri_Sembilan">Negeri Sembilan</option>
                <option value="Pahang">Pahang</option>
                <option value="Pulau_Pinang">Pulau Pinang</option>
                <option value="Selangor">Selangor</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Perlis">Perlis</option>
                <option value="Kedah">Kedah</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Perak">Perak</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Sabah">Sabah</option>
            </select>

            <label for="city">City</label>
            <input type="text" id="city" name="city" required>

            <label for="payment">Payment Method</label>
            <select id="payment" name="method" required>
                <option value="">Select Method</option>
                <option value="Debit_Card">Debit Card</option>
                <option value="Credit_Card">Credit Card</option>
            </select>

            <label for="card">Card Number</label>
            <input type="text" id="card" name="card" required>

            <label for="debit-expiry">Expiry Date</label>
            <input type="text" id="debit-expiry" name="debit_expiry" placeholder="MM/YYYY" required>

            <label for="debit-cvv">CVV</label>
            <input type="text" id="debit-cvv" name="debit_cvv" required>

            <input type="hidden" name="total_price" value="<?php echo htmlspecialchars($total_price); ?>">
            <input type="hidden" name="total_products" value="<?php echo htmlspecialchars(json_encode($total_products)); ?>">
            <input type="submit" value="Order Now" name="order_btn" class="btn">
        </form>
    </div>
</section>

<script>
    // JavaScript for displaying a pop-up message
    window.onload = function() {
        alert('Thank you for shopping! Your order has been placed.');
    }
</script>

</body>
</html>
