<?php
include("connection.php");

// Ensure mechanic_id is provided and sanitize it
if(isset($_GET['mechanic_id'])) {
    $mechanic_id = intval($_GET['mechanic_id']); // Assuming mechanic_id is an integer
} else {
    // Handle error if mechanic_id is not provided
    echo json_encode(array('error' => 'Mechanic ID not provided'));
    exit;
}

// Query to fetch scheduled services with customer name, service name, and mechanic name filtered by mechanic_id
$query = "
    SELECT
        ss.sched_service_id,
        ss.service_date AS start,
        ss.customer_id,
        CONCAT(c.c_firstname, ' ', c.c_lastname) AS customer_name,
        ss.vehicle_id,
        ss.services_id,
        s.services_name,
        ss.service_description,
        ss.preferred_time,
        ss.mechanist_id,
        CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name,
        ss.technician_notes,
        ss.customer_comments,
        ss.special_instruction,
        ss.status,
        CONCAT('Schedule ID : ', ss.sched_service_id) AS title,
        c_v.license_plate

    FROM
        scheduling_services_tbl ss
    INNER JOIN
        customers_tbl c ON ss.customer_id = c.id
    INNER JOIN
        services_tbl s ON ss.services_id = s.id
    INNER JOIN
        mechanist_tbl m ON ss.mechanist_id = m.id
    INNER JOIN
        c_vehicles_registration_tbl c_v ON ss.vehicle_id = c_v.id
    WHERE
        ss.status = 'Request'
        AND ss.mechanist_id = ?
";

// Prepare the query
$stmt = $connection->prepare($query);

// Bind parameter
$stmt->bind_param('i', $mechanic_id);

// Execute query
$stmt->execute();

// Get result set
$result = $stmt->get_result();

$events = [];

while($row = $result->fetch_assoc()) {
    $events[] = $row;
}

// Output JSON encoded array
echo json_encode($events);

// Close statement and connection
$stmt->close();
$connection->close();
?>
