<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process each item in the cart
    foreach ($_POST as $key => $value) {
        // Check if the input field represents a product
        if (strpos($key, 'quantity') !== false) {
            // Extract product ID from input name
            $productId = substr($key, strlen('quantity'));

            // Check if quantity is greater than 0
             {
                // Store product information in session
                $_SESSION['cart'][$productId]['quantity'] = $value;
                $_SESSION['cart'][$productId]['name'] = $_POST['name' . $productId];
                $_SESSION['cart'][$productId]['price'] = $_POST['price' . $productId];
                $_SESSION['cart'][$productId]['total'] = $_POST['hiddenTotal' . $productId];
            }
        }
    }

    // Redirect to the next page
    header("Location: cart.php");
    exit();
}
?>








    