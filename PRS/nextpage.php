<?php
session_start(); // Start session
if (isset($_SESSION['customer_details'])) {
    $customerDetails = $_SESSION['customer_details'];
} else {
    // If session data doesn't exist, redirect the user to the form page
    header("Location: form.php");
    exit();
}
?>
<html>
<head>
    <title>Order Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: black;
            color:white;
        }
        td{
            
            background-color: white;
            color:black;

        }
        .center {
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin:0 100px;
        }

        /* Hover effect */
        .button:hover {
            background-color: #0056b3;
        }
    </style>
   </head>
   <body>
    <h2 class="center">Customer Details</h2>
    <table>
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

    <h2 class="center">Cart</h2>
    <table border="1" class="center">
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
            <td colspan="4" style="text-align: right;">Net Total:</td>
            <td><?php echo 'Rs.' . $netTotal; ?></td>
        </tr>
    </table>
    <center>
    <a href="payment.html" class="button">Proceed to Payment</a>
    </center>
    </body>
    </html>
