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
                    <li class="breadcrumb-item active">Return Defective Items</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Return Requests</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="return_request_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parts ID</th>
                                            <th scope="col">Parts Name</th>
                                            <th scope="col">Parts Number</th>
                                            <th scope="col">Quantity Return</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Return Request Date</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $connection->prepare("
                                            SELECT return_item_tbl.*, motorparts_tbl.parts_name, motorparts_tbl.parts_number, motorparts_tbl.price
                                            FROM return_item_tbl
                                            INNER JOIN motorparts_tbl ON return_item_tbl.item_id = motorparts_tbl.m_id
                                            WHERE supplier_id = ?
                                        ");
                                        $stmt->bind_param("s", $supplier_id);
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['item_id'] . "</td>";
                                            echo "<td>" . $row['parts_name'] . "</td>";
                                            echo "<td>" . $row['parts_number'] . "</td>";
                                            echo "<td>" . $row['quantity_return'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['return_date'] . "</td>";
                                            echo "<td>";
                                            if ($row['status'] == 'Rejected') {
                                                echo "<h5><span class='badge rounded-pill bg-danger'>" . $row['status'] . "</span></h5>";
                                            } elseif ($row['status'] == 'Process') {
                                                echo "<h5><span class='badge rounded-pill bg-warning'>" . $row['status'] . "</span></h5>";
                                            } else {
                                                echo "<h5><span class='badge rounded-pill bg-success'>" . $row['status'] . "</span></h5>";
                                            }
                                            echo "</td>";
                                            echo "<td>
                                                <div class='d-flex'>
                                                    <a data-toggle='modal' data-target='#viewModal" . $row['id'] . "' class='btn btn-primary btn-md'>View</a>
                                                    <span class='mx-1'></span>
                                                   
                                                    <form action='process_code/update_return_status.php' method='POST' style='display: inline;'>
                                                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                                                        <button type='submit' name='accept_return' class='btn btn-success btn-md'>Accept</button>
                                                    </form>
                                                </div>
                                            </td>";
                                            echo "</tr>";

                                            // View Modal
                                            echo "<div class='modal fade' id='viewModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='viewModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='viewModalLabel" . $row['id'] . "'>Return Request Details</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p><strong>Part Name:</strong> " . $row['parts_name'] . "</p>";
                                            echo "<p><strong>Part Number:</strong> " . $row['parts_number'] . "</p>";
                                            echo "<p><strong>Quantity to Return:</strong> " . $row['quantity_return'] . "</p>";
                                            echo "<p><strong>Price per Unit:</strong> " . $row['price'] . "</p>";
                                            echo "<p><strong>Request Date:</strong> " . $row['return_date'] . "</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            // Reject Modal
                                            echo "<div class='modal fade' id='rejectModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='rejectModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='rejectModalLabel" . $row['id'] . "'>Reject Return Request</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<form action='process_code/supplier_reject_return.php' method='POST'>";
                                            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='reject_reason" . $row['id'] . "'>Reason for Rejection</label>";
                                            echo "<textarea class='form-control' id='reject_reason" . $row['id'] . "' name='reject_reason' rows='4' required></textarea>";
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

                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End Main -->
</body>
