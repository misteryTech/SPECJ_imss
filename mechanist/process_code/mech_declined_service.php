<?php
include('connection.php'); // Make sure you include your database connection

if (isset($_POST['sched_service_id'])) {
    $schedServiceId = $_POST['sched_service_id'];

    // Update the status to 'Accept'
    $updateQuery = "UPDATE scheduling_services_tbl SET status = 'Decline' WHERE sched_service_id = ?";
    $updateStmt = $connection->prepare($updateQuery);
    $updateStmt->bind_param('i', $schedServiceId);

    if ($updateStmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>
