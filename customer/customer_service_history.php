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
            <h1>Vehicle Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Vehicle Service History</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Vehicle Services</h5>
                            <table class="table table-hover" id="customer_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Vehicle Service</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch all mechanics
                                    $query = "SELECT sst.vehicle_id, sst.sched_service_id, cvrt.customer_id, sst.customer_id, cvrt.vehicle_model
                                    
                                     FROM scheduling_services_tbl  as sst

                                     INNER JOIN c_vehicles_registration_tbl as cvrt ON sst.customer_id = cvrt.customer_id
                                     
                                    WHERE sst.customer_id = $user_id;
                                     ";
                                    $stmt = $connection->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $count = 1;

                                    // Loop through the results and display the mechanics in a table
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($count) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['vehicle_model']) . "</td>";
                                        echo "<td>";
                                        echo "<a class='btn btn-primary' href='customer_list_of_services.php?customer_id=" . htmlspecialchars($row['sched_service_id']) . "'>View Booked Services</a>";
                                        echo "</td>";
                                        echo "</tr>";

                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table><!-- End Table with hoverable rows -->
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
            $('#customer_datatable').DataTable();
        });
    </script>
</body>
</html>
