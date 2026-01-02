<html>
<head>
<title>Orders</title>
<style>
    body
   {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }
    table 
    {
    width: 100%;
    border-collapse:collapse;
    margin-bottom: 20px;
    border: 2px groove black; /* Add border style */
    }   

    th, td {
    padding: 8px;
    text-align: left;
    border: 1px groove black; /* Add border style */
    }


    th {
        background-color: black;
        color: white;
    }

    tr{
        background-color: white;
        color:black;
    }


    .delete-button {
        background-color: #f44336;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .delete-button:hover {
        background-color: #d32f2f;
    }

    .edit-button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .edit-button:hover {
        background-color: #388e3c;
    }
    .action-buttons
    {
        display: flex;
        flex-direction: column;
    }
    button
    {
        margin-top:10px;
    }
</style>
</head>
<body>
<?php
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
// Check if an update request is sent
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    // Update order status
    if ($_POST['action'] === 'update_status' && isset($_POST['orderId'], $_POST['status'])) {
        $orderId = $_POST['orderId'];
        $status = $_POST['status'];

        $sql = "UPDATE orders SET status='$status' WHERE order_id='$orderId'";
        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully";
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }
    // Delete order
    elseif ($_POST['action'] === 'delete_order' && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];

        $sql = "DELETE FROM orders WHERE order_id='$orderId'";
        if ($conn->query($sql) === TRUE) {
            echo "Order deleted successfully";
        } else {
            echo "Error deleting order: " . $conn->error;
        }
    }
    exit; // Exit after handling the request
}
// Output data of each row in a table format
echo "<table>";
echo "<tr><th>Order ID</th><th>Name</th><th>Phone</th><th>Address</th><th>Order Date</th><th>Payment Method</th><th>Product Details</th><th>Total</th><th>Status</th><th>Action</th></tr>";
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['order_id'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['phone'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['order_date'] . "</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['product_details'] . "</td>";
        echo "<td>Rs." . $row['total'] . "</td>";
        echo "<td class='status'>" . $row['status'] . "</td>";
        echo "<td class='action-buttons'>";
        // Delete Button
        echo "<button class='delete-button' data-order-id='" . $row['order_id'] . "'><i class='fas fa-trash-alt button-icon'></i>Delete</button>";
        // Edit Button
        echo "<button class='edit-button' data-order-id='" . $row['order_id'] . "'><i class='fas fa-edit button-icon'></i>Edit</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='11'>0 rows</td></tr>";
}
echo "</table>";

$conn->close();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
    // Function to update order status via AJAX
    function updateOrderStatus(orderId, status) {
        // Send an AJAX request to update the status in the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true); // Empty URL as it's the same file
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`action=update_status&orderId=${orderId}&status=${status}`);
    }
    // Function to delete order via AJAX
    function deleteOrder(orderId) {
        // Send an AJAX request to delete the order from the database
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '', true); // Empty URL as it's the same file
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send(`action=delete_order&orderId=${orderId}`);
    }
    // Get all edit buttons
    const editButtons = document.querySelectorAll('.edit-button');
    // Loop through each edit button and add event listener
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Get the status cell of the corresponding row
            const statusCell = this.parentElement.parentElement.querySelector('.status');
            // Toggle status between "Delivery" and "Not Delivered"
            if (statusCell.textContent === "Delivery") {
                statusCell.textContent = "Not Delivered";
                updateOrderStatus(this.dataset.orderId, "Not Delivered");
            } else {
                statusCell.textContent = "Delivery";
                updateOrderStatus(this.dataset.orderId, "Delivery");
            }
        });
    });
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('.delete-button');
    // Loop through each delete button and add event listener
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Ask for confirmation before deleting the row
            const confirmation = confirm("Are you sure you want to delete this order?");
            if (confirmation) {
                // Remove the row from the table
                this.parentElement.parentElement.remove();
                // Delete the order from the database
                deleteOrder(this.dataset.orderId);
            }
        });
    });
</script>
</body>
</html>