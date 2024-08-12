<?php
include("connection.php");

$id = $_SESSION['id'];

// Query to fetch scheduled services with customer name, service name, and mechanist name
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
        ss.status = 'Accept' AND ss.customer_id = '$id'
";

$result = $connection->query($query);

$events = [];

while($row = $result->fetch_assoc()) {
    $events[] = $row;
}

echo json_encode($events);

$connection->close();
?>
