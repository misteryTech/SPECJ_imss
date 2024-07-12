<?php
    // Include database connection
    include("connection.php");

    // Initialize variables to store form data
    $customer_id = $_POST['customer_name']; // Assuming customer_name contains customer_id
    $vehicle_model = $_POST['vehicle_model'];
    $vehicle_year = $_POST['vehicle_year'];
    $license_plate = $_POST['license_plate'];
    $mileage = $_POST['mileage'];
    $vin = $_POST['vin'];
    $registration_date = $_POST['registration_date'];
    $notes = $_POST['notes'];

    // Insert vehicle data into vehicles_tbl
    $insert_vehicle_sql = "INSERT INTO c_vehicles_registration_tbl (customer_id, vehicle_model, vehicle_year, license_plate, mileage, vin, registration_date, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $connection->prepare($insert_vehicle_sql);
    $stmt->bind_param("isssisss", $customer_id, $vehicle_model, $vehicle_year, $license_plate, $mileage, $vin, $registration_date, $notes);

    if ($stmt->execute()) {
        // Success message
        echo "<script>alert('Vehicle information registered successfully.'); window.location.href = '../customer_vehicle_registration.php';</script>";
    } else {
        // Error message
        echo "<script>alert('Error: Unable to register vehicle information.'); window.history.back();</script>";
    }

    // Close prepared statement and database connection
    $stmt->close();
    $connection->close();
?>