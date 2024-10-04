<?php
include("user_header.php");
?>

<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
    include("user_topnav.php");
    include("user_sidenav.php");
    ?>

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Booked Services for Customer</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Booked Services</h5>
                            <a href="customer_service_history.php"><button type="button" class="btn btn-primary mb-3">Back to Customer Service List</button></a>
                            <?php
                            // Check if customer ID is provided
                            if (isset($_GET['customer_id'])) {
                                $customer_id = $_GET['customer_id'];

                                // Fetch booked services for the selected customer including assigned technician
                                $scheduleQuery = "
                                    SELECT
                                        ss.sched_service_id,
                                        ss.status,
                                        s.services_name,
                                        ss.service_date,
                                        v.license_plate AS vehicle_no,
                                       CONCAT(t.m_firstname, ' ', t.m_lastname) AS mechanist_name
                                    FROM
                                        scheduling_services_tbl ss
                                    INNER JOIN
                                        services_tbl s ON ss.services_id = s.id
                                    INNER JOIN
                                        c_vehicles_registration_tbl v ON ss.vehicle_id = v.id
                                    INNER JOIN
                                        mechanist_tbl t ON ss.mechanist_id = t.id
                                    WHERE
                                        ss.sched_service_id = ?
                                ";
                                $scheduleStmt = $connection->prepare($scheduleQuery);
                                $scheduleStmt->bind_param('i', $customer_id);
                                $scheduleStmt->execute();
                                $scheduleResult = $scheduleStmt->get_result();

                                if ($scheduleResult->num_rows > 0) {
                                    echo "<table id='bookedServicesTable' class='table table-hovered'>";
                                    echo "<thead>";
                                    echo "<tr>";
                                    echo "<th>Schedule ID</th>";
                                    echo "<th>Service Name</th>";
                                    echo "<th>Vehicle Plate Number</th>";
                                    echo "<th>Service Date</th>";
                                    echo "<th>Status</th>";
                                    echo "<th>Technician Name</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($scheduleRow = $scheduleResult->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['sched_service_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['services_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['vehicle_no']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['service_date']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['status']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['mechanist_name']) . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<p>No booked services found for this customer.</p>";
                                }
                            } else {
                                echo "<p>Invalid request.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
    include("user_footer.php");
    ?>

    <script>
        $(document).ready(function () {
            $('#bookedServicesTable').DataTable();
        });
    </script>
