<?php
// Include your database connection script
include("connection.php");

// Check if the form is submitted via POST method
if($_SERVER["REQUEST_METHOD"] === "POST"){
    // Collect data from the form fields
    $customer_name = $_POST["customer_name"];
    $vehicle_id = $_POST["vehicle_id"];
    $services_name = $_POST["services_name"];
    $service_description = $_POST["service_description"];
    $service_date = $_POST["service_date"];
    $preferred_time = $_POST["preferred_time"];
    $select_mechanist = $_POST["select_mechanist"];
    $technician_notes = $_POST["technician_notes"];
    $customer_comments = $_POST["customer_comments"];
    $special_instructions = $_POST["special_instructions"];
    $status = "Request";

    // Prepare an SQL statement to insert data into the database
    $stmt = $connection->prepare("INSERT INTO scheduling_services_tbl
            (customer_id, vehicle_id, services_id, mechanist_id, service_description,
            service_date, preferred_time, technician_notes, customer_comments,
            special_instruction, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if($stmt === false) {
        echo "<script>alert('Failed to prepare statement');</script>";
        exit;
    }

    // Bind parameters to the prepared statement
    // Adjust the parameter types accordingly (i.e., i for integer, s for string, d for double)
    $stmt->bind_param("iiissssssss", $customer_name, $vehicle_id, $services_name, $select_mechanist,
    $service_description, $service_date, $preferred_time, $technician_notes, $customer_comments, $special_instructions, $status);

    // Execute the prepared statement
    if($stmt->execute()){
        echo "<script>alert('Request Schedule Successfully Entered');</script>";
        echo "<script>window.location.href = '../schedule_services_page.php';</script>";
    } else {
        echo "<script>alert('Failed to Schedule');</script>";
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $connection->close();
}
?>
