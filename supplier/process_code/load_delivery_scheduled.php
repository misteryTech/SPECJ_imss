<?php
   include("connection.php");

// Query to fetch scheduled deliveries
$query = "SELECT reorder_id,supplier_id,status,price,quantity_to_reorder, expected_delivery_date as start, CONCAT('Delivery Id: ', reorder_id) as title FROM reorders_tbl WHERE status='Delivered'";
$result = $connection->query($query);

$events = [];

while($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);

$connection->close();
?>
