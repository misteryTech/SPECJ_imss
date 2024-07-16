<?php
include("mech_header.php");


// Fetch counts for each category based on the logged-in mechanic's ID
$mechanic_id = $_SESSION['id'];

// Query to fetch count of Request services
$request_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Request' AND mechanist_id = ?");
$request_count_query->bind_param('i', $mechanic_id);
$request_count_query->execute();
$request_count_result = $request_count_query->get_result();
$request_count = $request_count_result->fetch_assoc()['count'];

// Query to fetch count of Working services
$working_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Working' AND mechanist_id = ?");
$working_count_query->bind_param('i', $mechanic_id);
$working_count_query->execute();
$working_count_result = $working_count_query->get_result();
$working_count = $working_count_result->fetch_assoc()['count'];

// Query to fetch count of Reject services
$reject_count_query = $connection->prepare("SELECT COUNT(*) as count FROM scheduling_services_tbl WHERE status='Reject' AND mechanist_id = ?");
$reject_count_query->bind_param('i', $mechanic_id);
$reject_count_query->execute();
$reject_count_result = $reject_count_query->get_result();
$reject_count = $reject_count_result->fetch_assoc()['count'];
?>

<!-- HTML Body -->
<body>

<!-- Header and Sidebar includes -->
<?php
include("mech_topnav.php");
include("mech_sidenav.php");
?>

<!-- Main content -->
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
                            <!-- Request Services Tab -->
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-primary mb-2 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                                    Request Services <span class="badge bg-white text-primary"><?php echo $request_count; ?></span>
                                </button>
                            </li>
                            <!-- Working Services Tab -->
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-success" style="margin-left: 20px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    Working <span class="badge bg-white text-primary"><?php echo $working_count; ?></span>
                                </button>
                            </li>
                            <!-- Mechanist Reject Services Tab -->
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-danger" style="margin-left: 20px;" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Mechanist Reject <span class="badge bg-white text-primary"><?php echo $reject_count; ?></span>
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content pt-2" id="borderedTabContent">
                            <!-- Request Services Table -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-hover" id="stock_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
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
                                                ss.status = 'Request'
                                                AND ss.mechanist_id = ?
                                        ";

                                        // Prepare the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('i', $mechanic_id);

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

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Working Services Table -->
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-hover" id="reorder_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
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
                                                ss.status = 'Working'
                                                AND ss.mechanist_id = ?
                                        ";

                                        // Prepare the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('i', $mechanic_id);

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

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- Mechanist Reject Services Table -->
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="contact-tab">
                                <table class="table table-hover" id="outofstock_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Schedule Id</th>
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
                                                ss.status = 'Reject'
                                                AND ss.mechanist_id = ?
                                        ";

                                        // Prepare the statement
                                        $stmt = $connection->prepare($query);
                                        $stmt->bind_param('i', $mechanic_id);

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

                                        // Close the statement
                                        $stmt->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End Tab Content -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Footer include -->
<?php include("mech_footer.php"); ?>

<!-- DataTables initialization -->
<script>
    $(document).ready(function() {
        $('#stock_datatable, #reorder_datatable, #outofstock_datatable').DataTable();
    });
</script>
