<?php
session_start();
include 'db_connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('location:login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

// Ensure total price is received from shopping cart page
$total_price = isset($_GET['total_price']) ? floatval($_GET['total_price']) : 0.00;

// Handle order submission
if (isset($_POST['order_btn'])) {
    // Validate and sanitize form inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['method']);
    $card_number = mysqli_real_escape_string($conn, $_POST['card']);
    $card_cvv = mysqli_real_escape_string($conn, $_POST['debit_cvv']);
    $card_expiry = mysqli_real_escape_string($conn, $_POST['debit_expiry']);
    $total_price = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0.00; // Retrieve total price from POST data

    // Debugging statement
    echo "Total Price: $total_price";

    // Insert order details into the orders table
    $query = "INSERT INTO orders (name, email, method, address, city, state, total_price, card_number, card_cvv, card_expiry) 
              VALUES ('$name', '$email', '$payment_method', '$address', '$city', '$state', '$total_price', '$card_number', '$card_cvv', '$card_expiry')";
    $detail_query = mysqli_query($conn, $query);

    if ($detail_query) {
        // Order success message and redirection
        echo "
        <script>
            window.onload = function() {
                alert('Thank you for shopping! Your order has been placed.');
                window.location.href = '../User_homepage/user_homepage.php';
            }
        </script>
        ";
    } else {
        die('Query failed: ' . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stationery Shop Checkout</title>
    <link rel="stylesheet" href="payment.css">
</head>
<body>
    <header>
        <!-- Back link to shopping cart -->
        <a id="back" href="../Shopping_cart/shopping_cart.php"><b>BACK TO CART</b></a>
        <h1>OKAY STATIONERY SHOP</h1>
    </header>
    <section>
        <div class="payment">
            <h1>Payment Form</h1>
            <form id="paymentForm" action="payment.php" method="post">
                <!-- Display total price -->
                <p>Total Price: RM <?php echo number_format($total_price, 2); ?></p>
                <!-- Form inputs for order details -->
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
                
                <!-- Submit button -->
                <input type="submit" value="Order Now" name="order_btn" class="btn">
            </form>
        </div>
    </section>
</body>
</html>
