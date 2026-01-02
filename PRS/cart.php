<?php
session_start();
?>
<html>
<head>
    <title>Cart</title>
    <style>
      table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center; 
        }
        th{
           background-color:black;
           color:white;
        }
        td{
            background-color:white;
           color:black;
        }
        .buttons-container {
            text-align: center;
        }
        .buttons-container a {
            display: inline-block;
            margin: 0 200px;
            text-decoration: none;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            margin-top:20px;
            font-size:25px;
        }
        .buttons-container a:hover {
            background-color: #0056b3;
        }
        span{
            font-size:25px;
        }
     </style>
</head>
<body>
    <h1>Cart</h1>
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
            <td colspan="4" style="text-align: right;">Net Total:</td>
            <td><?php echo 'Rs.' . $netTotal; ?></td>
        </tr>
    </table>
    <div class="buttons-container">
        <a href="pp.html"><span>&larr;</span>Back to cart</a>
        <a href="cust.html">Customer Details<span>&rarr;</span></a>
    </div>
</body>
</html>
