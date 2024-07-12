<?php
    include("admin_header.php");

    $reorder_count_query = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE QuantityInStock <= 5 AND QuantityInStock > 0");
    $reorder_count_query->execute();
    $reorder_count_result = $reorder_count_query->get_result();
    $reorder_count = $reorder_count_result->fetch_assoc()['count'];
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
    <h1>Inventory Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Reorder Parts</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Reorder Parts</h5>
                    <table class="table table-hover" id="parts_datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Part Name</th>
                                <th scope="col">Part Number</th>
                                <th scope="col">Price</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Supplier</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $stmt = $connection->prepare("SELECT * FROM motorparts_tbl WHERE QuantityInStock <= 5 AND QuantityInStock > 0");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $count = 1;

                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>".$count."</td>";
                                    echo "<td>".$row['parts_name']."</td>";
                                    echo "<td>".$row['parts_number']."</td>";
                                    echo "<td>".$row['price']."</td>";
                                    echo "<td>".$row['QuantityInStock']."</td>";
                                    echo "<td>".$row['supplier']."</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-primary' data-toggle='modal' data-target='#reorderModal" . $row['m_id'] . "'>Reorder</button>";
                                    echo "</td>";
                                    echo "</tr>";

                                    $count++;
                                    // Reorder Modal
                                    echo "<div class='modal fade' id='reorderModal" . $row['m_id'] . "' tabindex='-1' role='dialog' aria-labelledby='reorderModalLabel" . $row['m_id'] . "' aria-hidden='true'>";
                                    echo "<div class='modal-dialog'>";
                                    echo "<div class='modal-content'>";
                                    echo "<div class='modal-header'>";
                                    echo "<h5 class='modal-title' id='reorderModalLabel" . $row['m_id'] . "'>Reorder Part</h5>";
                                    echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                    echo "</div>";
                                    echo "<div class='modal-body'>";
                                    echo "<form action='process_code/reorder_parts_request.php' method='POST'>";
                                    echo "<input type='hidden' name='parts_id' value='" . $row['m_id'] . "'>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_parts_name" . $row['m_id'] . "'>Part Name</label>";
                                    echo "<input type='text' class='form-control' id='reorder_parts_name" . $row['m_id'] . "' name='parts_name' value='" . $row['parts_name'] . "' readonly>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_parts_number" . $row['m_id'] . "'>Part Number</label>";
                                    echo "<input type='text' class='form-control' id='reorder_parts_number" . $row['m_id'] . "' name='parts_number' value='" . $row['parts_number'] . "' readonly>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_quantity" . $row['m_id'] . "'>Quantity to Reorder</label>";
                                    echo "<input type='number' class='form-control' id='reorder_quantity" . $row['m_id'] . "' name='quantity_to_reorder' min='1' required>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_price" . $row['m_id'] . "'>Price per Unit</label>";
                                    echo "<input type='text' class='form-control' id='reorder_price" . $row['m_id'] . "' name='price' value='" . $row['price'] . "' required>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_supplier" . $row['m_id'] . "'>Supplier</label>";
                                    echo "<input type='text' class='form-control' id='reorder_supplier" . $row['m_id'] . "' name='supplier' value='" . $row['supplier'] . "' readonly>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='reorder_date" . $row['m_id'] . "'>Reorder Date</label>";
                                    echo "<input type='date' class='form-control' id='reorder_date" . $row['m_id'] . "' name='reorder_date' required>";
                                    echo "</div>";

                                    echo "<div class='form-group'>";
                                    echo "<label for='expected_delivery_date" . $row['m_id'] . "'>Expected Delivery Date</label>";
                                    echo "<input type='date' class='form-control' id='expected_delivery_date" . $row['m_id'] . "' name='expected_delivery_date' required>";
                                    echo "</div>";

                                    echo "</div>";
                                    echo "<div class='modal-footer'>";
                                    echo "<button type='submit' class='btn btn-primary'>Reorder</button>";
                                    echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                    echo "</form>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
                                    echo "</div>";
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
    include("admin_footer.php");
?>
  <script>
        $(document).ready(function() {
            $('#parts_datatable').DataTable();
        });
    </script>