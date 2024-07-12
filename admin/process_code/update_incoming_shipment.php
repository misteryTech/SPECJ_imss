<?php
// Include the database connection file
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $reorder_id = $_POST['reorder_id'];
    $parts_id = $_POST['parts_id'];
    $quantity_to_reorder = $_POST['quantity_to_reorder'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];
    $reorder_date = $_POST['reorder_date'];
    $expected_delivery_date = $_POST['expected_delivery_date'];
    $status = "Received";

    $date = date("Y-m-d");

        // Update the inventory table
        $stmt = $connection->prepare("UPDATE reorders_tbl SET  price= ? ,status = ?, expected_delivery_date = ?, quantity_to_reorder = ? WHERE reorder_id = ?");

        $stmt->bind_param("issii", $price,$status,$expected_delivery_date,$quantity_to_reorder,$reorder_id);
        $stmt->execute();



    // Insert a log entry into the inventory_logs table
    $action = 'Approve Request';
    $timestamp = date('Y-m-d H:i:s');
    $stmt = $connection->prepare("INSERT INTO inventory_logs (reorder_id, action, user_id, timestamp, status, quantity_change) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssi", $reorder_id, $action, $supplier_id, $timestamp, $status, $quantity_to_reorder);
    $stmt->execute();


    // Redirect to a success page or display a success message
    header('Location: ../incoming_shipments.php');
    exit();
}
?>
