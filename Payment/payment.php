
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
    <a id="back" href="../Shopping_cart/shopping_cart.html"><b>BACK TO CART</b></a>
    <h1 style="margin-top: 40px; text-align: center;">OKAY STATIONERY SHOP</h1>
</header>

<section>
    <div class="payment">
        <h1>Payment Form</h1>
        <form id="paymentForm" action="#" method="post">
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
            <select id="payment" name="payment" required>
                <option value="">Select Method</option>
                <option value="Debit_Card">Debit Card</option>
                <option value="Credit_Card">Credit Card</option>
                <option value="Touch_N_Go">Touch N Go</option>
            </select>

            <div class="method3" id="method3">
                <div class="method3-inner">
                    <button type="button" class="close-btn" id="closeTNG">&times;</button>
                    <h2>Please pay to this number : <br>018-773-0806</h2>
                    <h2>Or scan the below QR code :</h2>
                    <img src="TNG_QR.jpeg" alt="Touch N Go QR Code">
                    <label for="paymentScreenshot">Screenshot of Payment:</label>
                    <input type="file" id="paymentScreenshot" name="paymentScreenshot" accept="image/* de">
                    <input type="submit" value="Place Order" id="place_order_tng">
                </div>
            </div>

            <div class="method-debit-card" id="method-debit-card">
                <div class="method-debit-card-inner">
                    <button type="button" class="close-btn" id="closeDebitCard">&times;</button>
                    <h3>If using Debit Card, please key in:</h3>
                    <label for="debit-card">Debit Card Number</label>
                    <input type="text" id="debit-card" name="debit-card" required>

                    <label for="debit-expiry">Expiry Date</label>
                    <input type="text" id="debit-expiry" name="debit-expiry" placeholder="MM/YYYY" required>

                    <label for="debit-cvv">CVV</label>
                    <input type="text" id="debit-cvv" name="debit-cvv" required>

                    <input type="submit" value="Place Order" id="place_order_debit">
                </div>
            </div>

            <div class="method-credit-card" id="method-credit-card">
                <div class="method-credit-card-inner">
                    <button type="button" class="close-btn" id="closeCreditCard">&times;</button>
                    <h3>If using Credit Card, please key in:</h3>
                    <label for="credit-card">Credit Card Number</label>
                    <input type="text" id="credit-card" name="credit-card" required>

                    <label for="credit-expiry">Expiry Date</label>
                    <input type="text" id="credit-expiry" name="credit-expiry" placeholder="MM/YYYY" required>

                    <label for="credit-cvv">CVV</label>
                    <input type="text" id="credit-cvv" name="credit-cvv" required>

                    <input type="submit" value="Place Order" id="place_order_credit">
                </div>
            </div>

            <input type="hidden" id="selected-payment-method" name="selected-payment-method">

        </form>
    </div>
</section>

</body>
</html>
