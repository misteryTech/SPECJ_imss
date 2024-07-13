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
            <h1>Inventory Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Incoming Shipments</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Incoming Request</h5>
                            <div class="table-responsive">
                                <div class="mb-3">
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
                                </div>
                                <table class="table table-hover" id="services_manage_order_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parts ID</th>
                                            <th scope="col">Quantity Change</th>
                                            <th scope="col">Timestamp</th>
                                            <th scope="col">User Id</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Initialize the date filter variables
                                        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                                        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

                                        // Prepare the SQL statement with optional date filters
                                        $sql = "SELECT * FROM inventory_logs WHERE 1";
                                        if ($start_date && $end_date) {
                                            $sql .= " AND timestamp BETWEEN '$start_date' AND '$end_date'";
                                        } elseif ($start_date) {
                                            $sql .= " AND timestamp >= '$start_date'";
                                        } elseif ($end_date) {
                                            $sql .= " AND timestamp <= '$end_date'";
                                        }

                                        $stmt = $connection->prepare($sql);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['reorder_id'] . "</td>";
                                            echo "<td>" . $row['quantity_change'] . "</td>";
                                            echo "<td>" . $row['timestamp'] . "</td>";
                                            echo "<td>" . $row['user_id'] . "</td>";
                                            echo "<td>" . $row['status'] . "</td>";
                                            echo "</tr>";
                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- End Table with hoverable rows -->
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

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function () {
            $('#services_manage_order_datatable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ]
            });
        });
    </script>
</body>
</html>
