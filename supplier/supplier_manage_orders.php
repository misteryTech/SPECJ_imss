<?php
    include("supp_header.php");
?>
<body>
    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("supp_topnav.php");
        include("supp_sidenav.php");

        $supplier_id = $_SESSION['id'];
    ?>

    <!-- Main -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Supplier Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Manage Orders</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Order Request <?php echo $supplier_id; ?></h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="services_manage_order_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parts ID</th>
                                            <th scope="col">Parts Name</th>
                                            <th scope="col">Parts Number</th>
                                            <th scope="col">Quantity Order</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Re Order Date</th>
                                            <th scope="col">Expected Date</th>

                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
$stmt = $connection->prepare("
    SELECT reorders_tbl.*, motorparts_tbl.parts_name, motorparts_tbl.parts_number
    FROM reorders_tbl
    INNER JOIN motorparts_tbl ON reorders_tbl.parts_id = motorparts_tbl.m_id
    WHERE supplier_id = ?
");
$stmt->bind_param("s", $supplier_id);
$stmt->execute();
$result = $stmt->get_result();
$count = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $count . "</td>";
    echo "<td>" . $row['parts_id'] . "</td>";
    echo "<td>" . $row['parts_name'] . "</td>";
    echo "<td>" . $row['parts_number'] . "</td>";
    echo "<td>" . $row['quantity_to_reorder'] . "</td>";
    echo "<td>" . $row['price'] . "</td>";
    echo "<td>" . $row['reorder_date'] . "</td>";
    echo "<td>" . $row['expected_delivery_date'] . "</td>";
    echo "<td>";
    if ($row['status'] == 'Rejected') {
        echo "<h5><span class='badge rounded-pill bg-danger'>" . $row['status'] . "</span></h5>";
    } else if ($row['status'] == 'Delivered'){
        echo "<h5><span class='badge rounded-pill bg-secondary'>" . $row['status'] . "</span></h5>";
    } else {
        echo "<h5><span class='badge rounded-pill bg-success'>" . $row['status'] . "</span></h5>";
    }
    echo "</td>";
    echo "<td>
        <div class='d-flex'>
            <a data-toggle='modal' data-target='#reorderModal" . $row['reorder_id'] . "' class='btn btn-primary btn-md'>View</a>
            <span class='mx-1'></span>
            <a data-toggle='modal' data-target='#rejectModal" . $row['reorder_id'] . "' class='btn btn-danger btn-md'>Reject</a>
            <span class='mx-1'></span>
            <a data-toggle='modal' data-target='#trackModal" . $row['reorder_id'] . "' class='btn btn-warning btn-md'>Track</a>
        </div>
    </td>";
    echo "</tr>";
    $count++;

    // Reorder Modal
    echo "<div class='modal fade' id='reorderModal" . $row['reorder_id'] . "' tabindex='-1' role='dialog' aria-labelledby='reorderModalLabel" . $row['reorder_id'] . "' aria-hidden='true'>";
    echo "<div class='modal-dialog'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='reorderModalLabel" . $row['reorder_id'] . "'>Parts Order Form Request</h5>";
    echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
    echo "</div>";
    echo "<div class='modal-body'>";

    echo "<form action='process_code/supplier_manage_order.php' method='POST'>";
    echo "<input type='hidden' name='reorder_id' value='" . $row['reorder_id'] . "'>";
    echo "<input type='hidden' name='supplier_id' value='" . $supplier_id . "'>";

    echo "<div class='form-group'>";
    echo "<label for='reorder_parts_name" . $row['reorder_id'] . "'>Part Name</label>";
    echo "<input type='text' class='form-control' id='reorder_parts_name" . $row['reorder_id'] . "' name='parts_name' value='" . $row['parts_name'] . "' readonly>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='reorder_parts_number" . $row['reorder_id'] . "'>Part Number</label>";
    echo "<input type='text' class='form-control' id='reorder_parts_number" . $row['reorder_id'] . "' name='parts_number' value='" . $row['parts_number'] . "' readonly>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='reorder_quantity" . $row['reorder_id'] . "'>Quantity to Reorder</label>";
    echo "<input type='number' class='form-control' id='reorder_quantity" . $row['reorder_id'] . "' name='quantity_to_reorder' min='1' value='" . $row['quantity_to_reorder'] . "' required>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='reorder_price" . $row['reorder_id'] . "'>Price per Unit</label>";
    echo "<input type='text' class='form-control' id='reorder_price" . $row['reorder_id'] . "' name='price' value='" . $row['price'] . "' required>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='reorder_date" . $row['reorder_id'] . "'>Reorder Date</label>";
    echo "<input type='date' class='form-control' id='reorder_date" . $row['reorder_id'] . "' name='reorder_date' value='" . $row['reorder_date'] . "' required>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='expected_delivery_date" . $row['reorder_id'] . "'>Expected Delivery Date</label>";
    echo "<input type='date' class='form-control' id='expected_delivery_date" . $row['reorder_id'] . "' name='expected_delivery_date' value='" . $row['expected_delivery_date'] . "' required>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='status" . $row['reorder_id'] . "'>Request Status</label>";
    echo "<input type='text' class='form-control' id='status" . $row['reorder_id'] . "' name='status' value='" . $row['status'] . "' required>";
    echo "</div>";

    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='submit' class='btn btn-success btn-md'>Approve</button>";
    echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    // Reject Modal
    echo "<div class='modal fade' id='rejectModal" . $row['reorder_id'] . "' tabindex='-1' role='dialog' aria-labelledby='rejectModalLabel" . $row['reorder_id'] . "' aria-hidden='true'>";
    echo "<div class='modal-dialog'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='rejectModalLabel" . $row['reorder_id'] . "'>Reject Order</h5>";
    echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
    echo "</div>";
    echo "<div class='modal-body'>";
    echo "<form action='process_code/supplier_reject_orders.php' method='POST'>";
    echo "<input type='hidden' name='reorder_id' value='" . $row['reorder_id'] . "'>";

    echo "<input type='text' class='form-control' id='reorder_parts_name" . $row['reorder_id'] . "' name='parts_name' value='" . $row['parts_name'] . "' hidden>";
    echo "<input type='text' class='form-control' id='reorder_parts_number" . $row['reorder_id'] . "' name='parts_number' value='" . $row['parts_number'] . "' hidden>";
    echo "<input type='number' class='form-control' id='reorder_quantity" . $row['quantity_to_reorder'] . "' name='quantity_to_reorder' min='1' value='" . $row['quantity_to_reorder'] . "' hidden>";
    echo "<input type='text' class='form-control' id='reorder_price" . $row['reorder_id'] . "' name='price' value='" . $row['price'] . "' hidden>";
    echo "<input type='text' class='form-control' id='reorder_supplier" . $row['reorder_id'] . "' name='supplier_id' value='" . $row['supplier_id'] . "' hidden>";
    echo "<input type='date' class='form-control' id='expected_delivery_date" . $row['reorder_id'] . "' name='expected_delivery_date' value='" . $row['expected_delivery_date'] . "' hidden>";
    echo "<input type='date' class='form-control' id='reorder_date" . $row['reorder_id'] . "' name='reorder_date' value='" . $row['reorder_date'] . "' hidden>";

    echo "<div class='form-group'>";
    echo "<label for='reject_reason" . $row['reorder_id'] . "'>Order Request ID:  </label>";
    echo "<h5>" . $row['reorder_id'] . "</h5>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='reject_reason" . $row['reorder_id'] . "'>Reason for Rejection</label>";
    echo "<textarea class='form-control' id='reject_reason" . $row['reorder_id'] . "' name='reject_reason' rows='4' required></textarea>";
    echo "</div>";

    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='submit' class='btn btn-danger btn-md'>Reject</button>";
    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";

    // Track Modal
    echo "<div class='modal fade' id='trackModal" . $row['reorder_id'] . "' tabindex='-1' role='dialog' aria-labelledby='trackModalLabel" . $row['reorder_id'] . "' aria-hidden='true'>";
    echo "<div class='modal-dialog'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='trackModalLabel" . $row['reorder_id'] . "'>Track Order</h5>";
    echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
    echo "</div>";
    echo "<div class='modal-body'>";

    echo "<form action='process_code/track_order.php' method='POST'>";
    echo "<input type='hidden' name='reorder_id' value='" . $row['reorder_id'] . "'>";

    echo "<div class='form-group'>";
    echo "<label for='track_product" . $row['reorder_id'] . "'>Product ID:  </label>";
    echo "<h5>" . $row['reorder_id'] . "</h5>";
    echo "</div>";

    echo "<div class='form-group'>";
    echo "<label for='tracking_info" . $row['reorder_id'] . "'>Tracking Information</label>";
    echo "<textarea class='form-control' id='tracking_info" . $row['reorder_id'] . "' name='tracking_info' rows='4' required></textarea>";
    echo "</div>";

    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='submit' class='btn btn-warning btn-md'>Update</button>";
    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
    echo "</form>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
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
        include("supp_footer.php");
    ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#services_manage_order_datatable').DataTable();
        });
    </script>
</body>
</html>
