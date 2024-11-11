<?php
include("admin_header.php");

// Fetch counts for each category
$request_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Request'");
$request_count_query->execute();
$request_count_result = $request_count_query->get_result();
$request_count = $request_count_result->fetch_assoc()['count'];


// Fetch counts for each category
$working_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Accept'");
$working_count_query->execute();
$working_count_result = $working_count_query->get_result();
$working_count = $working_count_result->fetch_assoc()['count'];



// Fetch counts for each category
$reject_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Reject'");
$reject_count_query->execute();
$reject_count_result = $reject_count_query->get_result();
$reject_count = $reject_count_result->fetch_assoc()['count'];


// Query to fetch count of Reject services
$completed_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Completed'");
$completed_count_query->execute();
$completed_count_result = $completed_count_query->get_result();
$completed_count = $completed_count_result->fetch_assoc()['count'];


?>

<body>

<!-- ======= Header ======= -->
<!-- ======= Sidebar ======= -->
<?php
include("admin_topnav.php");
include("admin_sidenav.php");
?>

<!-- Main-->
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Service Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Manage Work Orders</a></li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Work Orders</h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">


                            <li class="nav-item" role="presentation">
                  <button class="btn btn-primary mb-2 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  Request Services <span class="badge bg-white text-primary"><?php echo $request_count; ?></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-success"  style="margin-left: 20px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  Working <span class="badge bg-white text-primary"><?php echo $working_count; ?></span>
                  </button>

                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-danger" style="margin-left: 20px;" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                  Mechanist Reject <span class="badge bg-white text-primary"><?php echo $reject_count; ?></span>
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                                <button class="btn btn-success" style="margin-left: 20px;" id="pills-completed-tab" data-bs-toggle="pill" data-bs-target="#pills-completed" type="button" role="tab" aria-controls="pills-completed" aria-selected="false">
                                    Completed Task <span class="badge bg-white text-primary"><?php echo $completed_count; ?></span>
                                </button>
                </li>





                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">


                        <div class="tab-pane fade show" id="pills-completed" role="tabpanel" aria-labelledby="pills-completed-tab">
                                <table class="table table-hover" id="completed_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Service Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Prepare the SQL query with INNER JOINs and mechanic_id filter
                                        $query = "
                                            SELECT
                                                ss.sched_service_id,
                                                ss.services_id,
                                                s.services_name,
                                                ss.mechanist_id,
                                                CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name,
                                                ss.status
                                            FROM
                                                scheduling_services_tbl ss
                                            INNER JOIN
                                                services_tbl s ON ss.services_id = s.id
                                            INNER JOIN
                                                mechanist_tbl m ON ss.mechanist_id = m.id
                                            WHERE
                                                ss.status = 'Completed'
                                            
                                        ";

                                        // Prepare the statement
                                        $stmt = $connection->prepare($query);
                                

                                        // Execute the query
                                        $stmt->execute();

                                        // Fetch the results
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        // Loop through the results and display the data in a table
                                        while ($rows = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $rows['sched_service_id'] . "</td>";
                                            echo "<td>" . $rows['services_name'] . "</td>";
                                            echo "<td>" . $rows['mechanist_name'] . "</td>";
                                            echo "</tr>";

                                            $count++;
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- In Stock Tab -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-hover" id="stock_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Service Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                     // Prepare the SQL query with INNER JOINs
                                     $query = "
                                         SELECT
                                             ss.sched_service_id,
                                             ss.services_id,
                                             s.services_name,
                                             ss.mechanist_id,
                                             CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name,
                                             ss.status
                                         FROM
                                             scheduling_services_tbl ss
                                         INNER JOIN
                                             services_tbl s ON ss.services_id = s.id
                                         INNER JOIN
                                             mechanist_tbl m ON ss.mechanist_id = m.id
                                         WHERE
                                             ss.status = 'Request'
                                     ";

                                     // Prepare the statement
                                     $stmt = $connection->prepare($query);

                                     // Execute the query
                                     $stmt->execute();

                                     // Fetch the results
                                     $result = $stmt->get_result();
                                     $count = 1;

                                     // Loop through the results and display the data in a table
                                     while ($row = $result->fetch_assoc()) {
                                         echo "<tr>";
                                         echo "<td>" . $count . "</td>";
                                         echo "<td>" . $row['sched_service_id'] . "</td>";
                                         echo "<td>" . $row['services_name'] . "</td>";
                                         echo "<td>" . $row['mechanist_name'] . "</td>";
                                         echo "</tr>";

                                         $count++;
                                     }

                                     // Close the statement and connection
                                     $stmt->close();

                                     ?>

                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>
                            <!-- Reorder Tab -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">


                                <table class="table table-hover" id="reorder_datatable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                            <th scope="col">Service Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                     // Prepare the SQL query with INNER JOINs
                                     $query = "
                                         SELECT
                                             ss.sched_service_id,
                                             ss.services_id,
                                             s.services_name,
                                             ss.mechanist_id,
                                             CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name,
                                             ss.status
                                         FROM
                                             scheduling_services_tbl ss
                                         INNER JOIN
                                             services_tbl s ON ss.services_id = s.id
                                         INNER JOIN
                                             mechanist_tbl m ON ss.mechanist_id = m.id
                                         WHERE
                                             ss.status = 'Accept'
                                     ";

                                     // Prepare the statement
                                     $stmt = $connection->prepare($query);

                                     // Execute the query
                                     $stmt->execute();

                                     // Fetch the results
                                     $result = $stmt->get_result();
                                     $count = 1;

                                     // Loop through the results and display the data in a table
                                     while ($row = $result->fetch_assoc()) {
                                         echo "<tr>";
                                         echo "<td>" . $count . "</td>";
                                         echo "<td>" . $row['sched_service_id'] . "</td>";
                                         echo "<td>" . $row['services_name'] . "</td>";
                                         echo "<td>" . $row['mechanist_name'] . "</td>";
                                         echo "<td><a href='release_parts_page.php?sched_id=" . urlencode($row['sched_service_id']) . "'>Release Item</a></td>";


                                         echo "</tr>";
                                         $count++;
                                     }

                                     // Close the statement and connection
                                     $stmt->close();

                                     ?>
                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>
                            <!-- Out of Stock Tab -->


                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">

                            <table class="table table-hover" id="outofstock_datatable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                            <th scope="col">Service Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                    </thead>
                                    <tbody>
                                    <?php
                                     // Prepare the SQL query with INNER JOINs
                                     $query = "
                                         SELECT
                                             ss.sched_service_id,
                                             ss.services_id,
                                             s.services_name,
                                             ss.mechanist_id,
                                             CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name,
                                             ss.status
                                         FROM
                                             scheduling_services_tbl ss
                                         INNER JOIN
                                             services_tbl s ON ss.services_id = s.id
                                         INNER JOIN
                                             mechanist_tbl m ON ss.mechanist_id = m.id
                                         WHERE
                                             ss.status = 'Reject'
                                     ";

                                     // Prepare the statement
                                     $stmt = $connection->prepare($query);

                                     // Execute the query
                                     $stmt->execute();

                                     // Fetch the results
                                     $result = $stmt->get_result();
                                     $count = 1;

                                     // Loop through the results and display the data in a table
                                     while ($row = $result->fetch_assoc()) {
                                         echo "<tr>";
                                         echo "<td>" . $count . "</td>";
                                         echo "<td>" . $row['sched_service_id'] . "</td>";
                                         echo "<td>" . $row['services_name'] . "</td>";
                                         echo "<td>" . $row['mechanist_name'] . "</td>";
                                         echo "</tr>";

                                         $count++;
                                     }

                                     // Close the statement and connection
                                     $stmt->close();

                                     ?>
                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>
                        </div><!-- End Bordered Tabs -->

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
    $(document).ready(function() {
        // Initialize DataTable only for the visible table on page load
        $('#stock_datatable').DataTable();
        $('#reorder_datatable').DataTable();
        $('#outofstock_datatable').DataTable();
        $('#completed_table').DataTable();

        // Event listener for tab changes
        $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
            var target = $(e.target).data("bs-target"); // activated tab
            if (target === '#bordered-profile' && !$.fn.DataTable.isDataTable('#reorder_datatable')) {
                $('#reorder_datatable').DataTable();
            }
            if (target === '#bordered-contact' && !$.fn.DataTable.isDataTable('#outofstock_datatable')) {
                $('#outofstock_datatable').DataTable();
            }
        });
    });
</script>

</body>
</html>
