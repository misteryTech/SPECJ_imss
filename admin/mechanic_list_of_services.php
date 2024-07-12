<?php
include("admin_header.php");
?>

<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
    include("admin_topnav.php");
    include("admin_sidenav.php");
    ?>

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Booked Services for Mechanic</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Booked Services</h5>
                            <a href="mechanist_assign_services.php"><button type="button" class="btn btn-primary mb-3"  >Back to Mechanic List</button></a>
                            <?php
                            // Check if mechanic ID is provided
                            if (isset($_GET['mechanist_id'])) {
                                $mechanist_id = $_GET['mechanist_id'];

                                // Fetch booked services for the selected mechanic
                                $scheduleQuery = "
                                    SELECT
                                        ss.sched_service_id,
                                        s.services_name,
                                        ss.service_date,
                                        v.license_plate AS vehicle_no
                                    FROM
                                        scheduling_services_tbl ss
                                    INNER JOIN
                                        services_tbl s ON ss.services_id = s.id
                                    INNER JOIN
                                        c_vehicles_registration_tbl v ON ss.vehicle_id = v.id
                                    WHERE
                                        ss.mechanist_id = ?
                                ";
                                $scheduleStmt = $connection->prepare($scheduleQuery);
                                $scheduleStmt->bind_param('i', $mechanist_id);
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
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while ($scheduleRow = $scheduleResult->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['sched_service_id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['services_name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['vehicle_no']) . "</td>";
                                        echo "<td>" . htmlspecialchars($scheduleRow['service_date']) . "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";
                                    echo "</table>";
                                } else {
                                    echo "<p>No booked services found for this mechanic.</p>";

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
    include("admin_footer.php");
    ?>

    <script>
        $(document).ready(function () {
            $('#bookedServicesTable').DataTable();
        });
    </script>
</body>
</html>
