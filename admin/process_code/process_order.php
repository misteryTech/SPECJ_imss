<?php
include("connection.php"); // Assumes you have a db connection file

// Capture customer details
$customerName = $_POST['customerName'];
$customerContact = $_POST['customerContact'];
$customerAddress = $_POST['customerAddress'];
$selectedParts = json_decode($_POST['selectedParts'], true);

// Insert into walk_in_customers table
$insertCustomer = "INSERT INTO walk_in_customers (customer_name, contact_number, address) 
                   VALUES ('$customerName', '$customerContact', '$customerAddress')";
mysqli_query($connection, $insertCustomer);
$customerId = mysqli_insert_id($connection);

// Insert into orders table
$insertOrder = "INSERT INTO orders (customer_id) VALUES ($customerId)";
mysqli_query($connection, $insertOrder);
$orderId = mysqli_insert_id($connection);

// Insert each part into order_items and update stock
foreach ($selectedParts as $part) {
    $partId = $part['id'];
    $quantity = $part['quantity']; // Adjust based on user-selected quantity input
    $price = $part['price'];

    // Insert into order_items table
    $insertOrderItem = "INSERT INTO order_items (order_id, part_id, quantity, price) 
                        VALUES ($orderId, $partId, $quantity, $price)";
    mysqli_query($connection, $insertOrderItem);

    // Update stock in motorparts_tbl
    $updateStock = "UPDATE motorparts_tbl SET QuantityInStock = QuantityInStock - $quantity WHERE m_id = $partId";
    mysqli_query($connection, $updateStock);
}

echo "<script>alert('Order Successfully Process.');</script>";
echo "<script>window.location.href='../walk_in_purchased.php';</script>";
?>
