<?php
include("connection.php"); // Include your database connection here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $parts_names = $_POST['parts_name']; // Get the array of part IDs
    $quantities = $_POST['quantity']; // Get the array of quantities
    $sched_service_id = $_POST['sched_service_id']; // Get the scheduled service ID
    $status = "Released"; // Status of the release
    $status_sched = "Completed"; // Status of the scheduling service

    // Validate that the parts and quantities arrays are of the same length
    if (count($parts_names) === count($quantities)) {
        $insert_query = "INSERT INTO released_parts_tbl (sched_service_id, part_id, quantity, status) VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($insert_query);

        // Loop through parts and quantities and insert each pair
        for ($i = 0; $i < count($parts_names); $i++) {
            $part_id = $parts_names[$i];
            $quantity = $quantities[$i];

            // Bind parameters and execute the statement for inserting the released parts
            $stmt->bind_param('iiis', $sched_service_id, $part_id, $quantity, $status);
            $stmt->execute();

            // Update the stock in motorparts_tbl by subtracting the released quantity
            $update_query = "UPDATE motorparts_tbl SET QuantityInStock = QuantityInStock - ? WHERE m_id = ?";
            $update_stmt = $connection->prepare($update_query);
            $update_stmt->bind_param('ii', $quantity, $part_id);
            $update_stmt->execute();

            // Update the status of the scheduling service to 'Completed'
            $update_sched_service = "UPDATE scheduling_services_tbl SET status = ? WHERE sched_service_id = ?";
            $update_sched = $connection->prepare($update_sched_service);
            $update_sched->bind_param('si', $status_sched, $sched_service_id);
            $update_sched->execute();

            // Close the update statements
            $update_stmt->close();
            $update_sched->close();
        }

        // Close the insert statement
        $stmt->close();

        echo "<script>alert('Successfully Released order');</script>";
        echo "<script>window.location.href='../manage_work_schedules.php'</script>";
    } else {
        echo "Error: The number of parts and quantities must match.";
    }
} else {
    echo "Invalid request method.";
}

// Close the database connection
$connection->close();
?>
