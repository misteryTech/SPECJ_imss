<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parts_id = $_POST['parts_id'];
    $quantity_to_reorder = $_POST['quantity_to_reorder'];
    $price = $_POST['price'];
    $reorder_date = $_POST['reorder_date'];
    $expected_delivery_date = $_POST['expected_delivery_date'];
    $supplier = $_POST['supplier'];

    $stmt = $connection->prepare("INSERT INTO reorders_tbl (parts_id, quantity_to_reorder, price, reorder_date, expected_delivery_date, supplier_id) VALUES (?, ?, ?, ?, ?,?)");
    $stmt->bind_param("iissss", $parts_id, $quantity_to_reorder, $price, $reorder_date, $expected_delivery_date, $supplier);

    if ($stmt->execute()) {

        echo "<script>alert('Successfully Request to order');</script>";
        echo "<script>window.location.href='../parts_reorder_page.php'</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
