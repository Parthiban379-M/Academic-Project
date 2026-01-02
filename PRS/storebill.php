<?php
session_start(); // Start session

// Check if the payment method is selected
if (isset($_POST["payment_method"])) {
    // Store the selected payment method in the session
    $_SESSION["payment_method"] = $_POST["payment_method"];
} else {
    // If payment method is not selected, set it to "Not specified"
    $_SESSION["payment_method"] = "Not specified";
}

// Redirect the user to the next page
header("Location: proess.php");
exit();
?>
