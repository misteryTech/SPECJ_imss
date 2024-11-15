<?php
include("admin_header.php");

// Fetch counts for each category
$request_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Request'");
$request_count_query->execute();
$request_count_result = $request_count_query->get_result();
$request_count = $request_count_result->fetch_assoc()['count'];
$request_count_query->close();

$working_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Accept'");
$working_count_query->execute();
$working_count_result = $working_count_query->get_result();
$working_count = $working_count_result->fetch_assoc()['count'];
$working_count_query->close();

$reject_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Reject'");
$reject_count_query->execute();
$reject_count_result = $reject_count_query->get_result();
$reject_count = $reject_count_result->fetch_assoc()['count'];
$reject_count_query->close();

// Query to fetch count of Completed services
$completed_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Completed'");
$completed_count_query->execute();
$completed_count_result = $completed_count_query->get_result();
$completed_count = $completed_count_result->fetch_assoc()['count'];
$completed_count_query->close();
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
        <h1>Reporting</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Service Report</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Service Report</h5>

                        <!-- Date Filter Form -->
                        <form method="GET" action="">
                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="end_date" class="form-control" placeholder="End Date">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </div>
                        </form>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-primary mb-2 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                    Request Services <span class="badge bg-white text-primary"><?php echo $request_count; ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-warning" style="margin-left: 20px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
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
                            <!-- Request Services Tab -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-hover" id="stock_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                            <th scope="col">Service Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '1970-01-01';
                                        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

                                        // Prepare the SQL query for Request Services
                                        $query = "
                                            SELECT
                                                ss.sched_service_id,
                                                ss.services_id,
                                                s.services_name,
                                                ss.mechanist_id,
                                                ss.service_date,
                                                CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name
                                            FROM
                                                scheduling_services_tbl ss
                                            INNER JOIN
                                                services_tbl s ON ss.services_id = s.id
                                            INNER JOIN
                                                mechanist_tbl m ON ss.mechanist_id = m.id
                                            WHERE
                                                ss.status = 'Request'
                                                AND ss.service_date BETWEEN ? AND ?
                                        ";

                                        // Prepare and execute the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('ss', $start_date, $end_date);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        // Display the data in the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['sched_service_id'] . "</td>";
                                            echo "<td>" . $row['services_name'] . "</td>";
                                            echo "<td>" . $row['mechanist_name'] . "</td>";
                                            echo "<td>" . $row['service_date'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>

                            <!-- Working Tab -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-hover" id="reorder_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                            <th scope="col">Service Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Prepare the SQL query for Working Services
                                        $query = "
                                            SELECT
                                                ss.sched_service_id,
                                                ss.services_id,
                                                s.services_name,
                                                ss.service_date,
                                                ss.mechanist_id,
                                                CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name
                                            FROM
                                                scheduling_services_tbl ss
                                            INNER JOIN
                                                services_tbl s ON ss.services_id = s.id
                                            INNER JOIN
                                                mechanist_tbl m ON ss.mechanist_id = m.id
                                            WHERE
                                                ss.status = 'Accept'
                                                AND ss.service_date BETWEEN ? AND ?
                                        ";

                                        // Prepare and execute the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('ss', $start_date, $end_date);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        // Display the data in the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['sched_service_id'] . "</td>";
                                            echo "<td>" . $row['services_name'] . "</td>";
                                            echo "<td>" . $row['mechanist_name'] . "</td>";
                                            echo "<td>" . $row['service_date'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mechanist Reject Tab -->
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table table-hover" id="cancel_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                            <th scope="col">Service Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Prepare the SQL query for Rejected Services
                                        $query = "
                                            SELECT
                                                ss.sched_service_id,
                                                ss.services_id,
                                                s.services_name,
                                                ss.service_date,
                                                ss.mechanist_id,
                                                CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name
                                            FROM
                                                scheduling_services_tbl ss
                                            INNER JOIN
                                                services_tbl s ON ss.services_id = s.id
                                            INNER JOIN
                                                mechanist_tbl m ON ss.mechanist_id = m.id
                                            WHERE
                                                ss.status = 'Reject'
                                                AND ss.service_date BETWEEN ? AND ?
                                        ";

                                        // Prepare and execute the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('ss', $start_date, $end_date);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        // Display the data in the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['sched_service_id'] . "</td>";
                                            echo "<td>" . $row['services_name'] . "</td>";
                                            echo "<td>" . $row['mechanist_name'] . "</td>";
                                            echo "<td>" . $row['service_date'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Completed Task Tab -->
                            <div class="tab-pane fade" id="pills-completed" role="tabpanel" aria-labelledby="completed-tab">
                                <table class="table table-hover" id="completed_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
                                            <th scope="col">Services Name</th>
                                            <th scope="col">Mechanist Name</th>
                                            <th scope="col">Service Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Prepare the SQL query for Completed Services
                                        $query = "
                                            SELECT
                                                ss.sched_service_id,
                                                ss.services_id,
                                                s.services_name,
                                                ss.service_date,
                                                ss.mechanist_id,
                                                CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name
                                            FROM
                                                scheduling_services_tbl ss
                                            INNER JOIN
                                                services_tbl s ON ss.services_id = s.id
                                            INNER JOIN
                                                mechanist_tbl m ON ss.mechanist_id = m.id
                                            WHERE
                                                ss.status = 'Completed'
                                                AND ss.service_date BETWEEN ? AND ?
                                        ";

                                        // Prepare and execute the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('ss', $start_date, $end_date);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        // Display the data in the table
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['sched_service_id'] . "</td>";
                                            echo "<td>" . $row['services_name'] . "</td>";
                                            echo "<td>" . $row['mechanist_name'] . "</td>";
                                            echo "<td>" . $row['service_date'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php include("admin_footer.php"); ?>

<script>
    // Initialize DataTables
    $(document).ready(function() {
        $('#stock_datatable').DataTable();
        $('#reorder_datatable').DataTable();
        $('#cancel_datatable').DataTable();
        $('#completed_datatable').DataTable();
    });
</script>

</body>
