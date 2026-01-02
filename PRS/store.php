<?php
session_start(); // Start session

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : "";
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : "";
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : "";
    $deliveryDate = isset($_POST['deliveryDate']) ? $_POST['deliveryDate'] : "";

// Store form data and order date in session variables
$_SESSION['customer_details'] = array(
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'deliveryDate' => $deliveryDate // Corrected variable name
);


    header("Location: nextpage.php");
    exit();
} else {
    // If the form data is not submitted via POST method, display an error message or redirect the user to the form page
    echo "<p>No data submitted.</p>";
}
?>




