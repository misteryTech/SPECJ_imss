<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve POST data
    $customer_id = $_POST['customer_id'];
    $customer_name = $_POST['edit_fullname']; // This variable is not used in the query
    $edit_license_plate = $_POST['edit_license_plate'];
    $edit_vehicle_model = $_POST['edit_vehicle_model'];
    $edit_vehicle_year = $_POST['edit_vehicle_year'];
    $edit_mileage = $_POST['edit_mileage'];
    $edit_vin = $_POST['edit_vin'];
    $edit_notes = $_POST['edit_notes'];
    $edit_registration_date = $_POST['edit_registration_date'];

    // Prepare SQL statement
    $stmt = $connection->prepare("UPDATE c_vehicles_registration_tbl SET vehicle_model=?, vehicle_year=?, license_plate=?, mileage=?, vin=?, registration_date=?, notes=? WHERE id=?");
    $stmt->bind_param("sssssssi", $edit_vehicle_model, $edit_vehicle_year, $edit_license_plate, $edit_mileage, $edit_vin, $edit_registration_date, $edit_notes, $customer_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Successfully Edited Customer Vehicle Registration');</script>";
        echo "<script>window.location.href='../customer_vehicle_registration.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $connection->close();
}
?>
