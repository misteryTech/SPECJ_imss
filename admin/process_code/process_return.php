<?php
// Include database connection
include('connection.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $item_id = $_POST['item_id'];
    $return_quantity = $_POST['return_quantity'];
    $return_reason = $_POST['return_reason'];
    $current_stock = $_POST['stock'];   
    $supplier = $_POST['supplier'];
    $status ="Process";


   // Validate the quantity to make sure it doesn't exceed the current stock
   if ($return_quantity > $current_stock) {
    echo "<script>alert('Error: Quantity to return exceeds the current stock. Please try again.'); window.history.back();</script>";
    exit;
}


 // Calculate the new stock quantity after return
 $new_stock_quantity = $current_stock - $return_quantity;

 $connection->begin_transaction();

 try {
     // Update the stock quantity in the motorparts_tbl
     $updateStockSql = "UPDATE motorparts_tbl SET QuantityInStock = ? WHERE m_id = ?";
     $stmt = $connection->prepare($updateStockSql);
     $stmt->bind_param('ii', $new_stock_quantity, $item_id);
     $stmt->execute();


// Insert return details into the return items table (you might need to create this table)
$insertReturnSql = "INSERT INTO return_item_tbl (status, item_stock, supplier_id, item_id, quantity_return, return_reason, return_date) VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $connection->prepare($insertReturnSql);
$stmt->bind_param('siiiis', $status, $current_stock, $supplier, $item_id, $return_quantity, $return_reason);
$stmt->execute();

// Commit the transaction
$connection->commit();

// Close statement and connection
$stmt->close();
$connection->close();
echo "<script>alert('Item return processed successfully!'); window.location.href = '../search_page.php';</script>";

} catch (Exception $e) {
    // Rollback the transaction in case of an error
    $connection->rollback();
    echo "<script>alert('Error processing return: " . $e->getMessage() . "'); window.history.back();</script>";
}

}else {
    // If the form is not submitted, redirect to the home page
    header('Location: ../index.php');
    exit();
}

?>
