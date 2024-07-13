<?php
include("connection.php"); // Assuming you have a config file for database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_id = $_POST['vehicle_id'];

    // Prepare and execute delete statement
    $sql = "DELETE FROM c_vehicles_registration_tbl WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $vehicle_id);

    if ($stmt->execute()) {

        echo"<script>alert('Successfully Delete Vechicle');</script>";
        echo"<script>window.location.href='../customer_vehicle_registration.php'</script>";
    } else {
        // Error occurred
        header("Location: your_page.php?message=error");
    }

    $stmt->close();
    $connection->close();
}
?>
