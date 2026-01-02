<?php
session_start();

// Function to generate a random alphanumeric order ID
function generateOrderID($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Check if session data exists
if (!isset($_SESSION['customer_details']) || !isset($_SESSION['payment_method']) || !isset($_SESSION['cart'])) {
    // If session data doesn't exist, redirect the user to the appropriate page
    header("Location: payment.html");
    exit();
}

// Generate a random order ID
$orderID = generateOrderID();

// Retrieve customer details, payment method, and cart from session
$customerDetails = $_SESSION['customer_details'];
$paymentMethod = $_SESSION['payment_method'];
$cart = $_SESSION['cart'];

// Check if all product quantities are zero
$allZeroQuantity = true;
foreach ($cart as $product) {
    if ($product['quantity'] != 0) {
        $allZeroQuantity = false;
        break;
    }
}

// If all product quantities are zero, do not proceed with insertion
if ($allZeroQuantity) {
    echo "Cannot insert order. All product quantities are zero.";
    exit();
}

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Calculate total
$total = 0;
$productDetails = array();
foreach ($cart as $productId => $product) {
    $productName = $product['name'];
    $quantity = $product['quantity'];
    $price = $product['price'];
    $netTotal = $quantity * $price;

    // Skip products with zero quantity
    if ($quantity == 0) {
        continue;
    }

    $total += $netTotal;

    // Add product details to the array
    $productDetails[] = "name=$productName,quantity=$quantity,Price=Rs.$price<br>";

}

// Convert product details array to a comma-separated string
$productDetailsString = implode(' ', $productDetails);

// Define status
$status = 'not delivery';

// Insert data into the database
$sql = "INSERT INTO orders (`order_id`, name, phone, address, order_date, payment_method, product_details, total, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

// Bind parameters and execute the statement
$stmt->bind_param("sssssssds", $orderID, $customerDetails['name'], $customerDetails['phone'], $customerDetails['address'], $customerDetails['deliveryDate'], $paymentMethod, $productDetailsString, $total, $status);

if (!$stmt->execute()) {
    echo "Error: " . $stmt->error;
}
 else
 {
  
    echo '<marquee style="font-size:55px;color: orange;" scrollamount="15">THANK YOU FOR YOUR ORDER SAVE THIS PAGE</marquee>';
 
}

// Close statement
$stmt->close();

// Close connection
$conn->close();

?>


<html>
<head>
    <title>Order Details</title>
</head>
<link rel="stylesheet" href="pay.css">
<style>   
</style>   
<body>

    <h2>Customer Details</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <td><?php echo $orderID; ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?php echo $customerDetails['name']; ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?php echo $customerDetails['phone']; ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?php echo $customerDetails['address']; ?></td>
        </tr>
        <tr>
            <th>Order Date</th>
            <td><?php echo $customerDetails['deliveryDate']; ?></td>
        </tr>
    </table>

    <h2>Cart Details</h2>
    <table border="1">
        <tr>
            <th>S.No</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
        <?php
        $netTotal = 0;
        $serialNumber = 1; 
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $productId => $product) {
                // Check if quantity is greater than 0
                if ($product['quantity'] > 0) {
                    $total = $product['total'];
                    $netTotal += $total;
        ?>
        <tr>
            <td><?php echo $serialNumber++; ?></td>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo 'Rs.' . $product['price']; ?></td>
            <td><?php echo 'Rs.' . $total; ?></td>
        </tr>
        <?php
                }
            }
        }
        ?>
        <tr>
            <th colspan="4" style="text-align: right;">Net Total:</th>
            <td><?php echo 'Rs.' . $netTotal; ?></td>
        </tr>
    </table>

    <h2>Payment Details</h2>
    <table>
        <tr>
            <th>Payment Method</th>
            <td><?php echo $paymentMethod; ?></td>
        </tr>
        <tr>
            <th>Delivery Charge</th>
            <td>Free</td>
        </tr>
    </table>
    
   
</body>
</html>