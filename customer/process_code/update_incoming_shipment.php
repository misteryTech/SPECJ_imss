<?php
// Include the database connection file
include("connection.php");

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data from POST
    $reorder_id = $_POST['reorder_id'];
    $parts_id = $_POST['parts_id'];
    $quantity_to_reorder = $_POST['quantity_to_reorder'];
    $price = $_POST['price'];
    $supplier_id = $_POST['supplier_id'];
    $reorder_date = $_POST['reorder_date'];
    $expected_delivery_date = $_POST['expected_delivery_date'];
    $status = "Received";

    $date = date("Y-m-d");

    // Start a database transaction
    $connection->begin_transaction();

    // Flag to track if all operations are successful
    $success = true;

    // Retrieve the current quantity in stock for the specific part
    $stmt = $connection->prepare("SELECT QuantityInStock FROM motorparts_tbl WHERE m_id = ?");
    $stmt->bind_param("i", $parts_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the part exists
    if ($result->num_rows === 0) {
        $success = false;
        echo "Part not found.";
    } else {
        // Fetch the current stock quantity
        $current_stock = $result->fetch_assoc()['QuantityInStock'];
        $stmt->close();

        // Calculate new stock quantity after reorder
        $new_stock = $current_stock + $quantity_to_reorder;

        // Update the quantity in stock for the part
        $stmt = $connection->prepare("UPDATE motorparts_tbl SET QuantityInStock = ? WHERE m_id = ?");
        $stmt->bind_param("ii", $new_stock, $parts_id);
        if (!$stmt->execute()) {
            $success = false;
            echo "Error updating stock.";
        }
        $stmt->close();

        // Update the reorders table with new information
        $stmt = $connection->prepare("UPDATE reorders_tbl SET price = ?, status = ?, expected_delivery_date = ?, quantity_to_reorder = ? WHERE reorder_id = ?");
        $stmt->bind_param("issii", $price, $status, $expected_delivery_date, $quantity_to_reorder, $reorder_id);
        if (!$stmt->execute()) {
            $success = false;
            echo "Error updating reorder.";
        }
        $stmt->close();

        // Insert a log entry into the inventory_logs table
        $action = 'Approve Request';
        $timestamp = date('Y-m-d H:i:s');
        $stmt = $connection->prepare("INSERT INTO inventory_logs (reorder_id, action, user_id, timestamp, status, quantity_change) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssi", $reorder_id, $action, $supplier_id, $timestamp, $status, $quantity_to_reorder);
        if (!$stmt->execute()) {
            $success = false;
            echo "Error inserting log.";
        }
        $stmt->close();
    }

    if ($success) {
        // Commit the transaction if all operations succeed
        $connection->commit();
        // Redirect to a success page or display a success message
        header('Location: ../incoming_shipments.php');
        exit();
    } else {
        // Rollback the transaction if any operation fails
        $connection->rollback();
        echo "Transaction failed. Please try again.";
    }
}
?>
