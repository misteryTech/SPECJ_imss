<?php
include("mech_header.php");
?>

<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
    include("mech_topnav.php");
    include("mech_sidenav.php");
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
                            <a href="mechanist_assign_services.php"><button type="button" class="btn btn-primary mb-3">Back to Mechanic List</button></a>
                            <?php
                            // Check if mechanic ID is provided
                            if (isset($_GET['mechanist_id'])) {
                                $mechanist_id = $_GET['mechanist_id'];

                                // Fetch booked services for the selected mechanic
                                $scheduleQuery = "
                                    SELECT
                                        ss.sched_service_id,
                                        ss.status,
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
                                    echo "<th>Status</th>";
                                    echo "<th>Actions</th>";
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
                                        // Button to view details in modal
                                        echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>View Details</button></td>";
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

    <!-- Modal for Approved Jobs -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Approved Job Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Placeholder content for modal details -->
                    <p>Job details will be displayed here.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <!-- Add additional actions or buttons as needed -->
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <?php
    include("mech_footer.php");
    ?>

    <!-- DataTables initialization -->
    <script>
        $(document).ready(function () {
            $('#bookedServicesTable').DataTable();
        });
    </script>

</body>
</html>
