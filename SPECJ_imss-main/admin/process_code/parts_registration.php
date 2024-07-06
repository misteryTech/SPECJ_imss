<?php
include("connection.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $services_type = $_POST["services_type"];
    $parts_name = $_POST["parts_name"];
    $parts_number = $_POST["parts_number"];
    $category = $_POST["category"];
    $manufacturer = $_POST["manufacturer"];
    $price = $_POST["price"];
    $quantityinstock = $_POST["quantity_stock"];
    $supplier = $_POST["supplier"];
    $condition = $_POST["condition"];


    $stmt = $connection->prepare("INSERT INTO motorparts_tbl (parts_name, parts_number, category, manufacturer, price, QuantityInStock, supplier, `condition`, services_type)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("sssssssss", $parts_name, $parts_number, $category, $manufacturer, $price, $quantityinstock, $supplier, $condition, $services_type);

    if($stmt->execute()) {
        echo "<script>alert('Account Successfully Registered');</script>";
        echo "<script>window.location.href='../parts_page.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
