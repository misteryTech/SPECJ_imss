<?php
include("admin_header.php");

$timestamp = time();
$currentDate = gmdate('Y-m-d', $timestamp);


// Fetch counts for each category
$instock_count_query = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE QuantityInStock > 5");
$instock_count_query->execute();
$instock_count_result = $instock_count_query->get_result();
$instock_count = $instock_count_result->fetch_assoc()['count'];

$reorder_count_query = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE QuantityInStock <= 5 AND QuantityInStock > 0");
$reorder_count_query->execute();
$reorder_count_result = $reorder_count_query->get_result();
$reorder_count = $reorder_count_result->fetch_assoc()['count'];

$outofstock_count_query = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE QuantityInStock = 0");
$outofstock_count_query->execute();
$outofstock_count_result = $outofstock_count_query->get_result();
$outofstock_count = $outofstock_count_result->fetch_assoc()['count'];


$expired_count = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE date_expired = '$currentDate' ");
$expired_count->execute();
$expiredcountresulty = $expired_count->get_result();
$expired_count = $expiredcountresulty->fetch_assoc()['count'];


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
        <h1>View Stocks</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Inventory Management</a></li>
                <li class="breadcrumb-item">View Stocks</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View Stocks</h5>

                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                            <!-- <li class="nav-item" role="presentation">
                                <button class="btn btn-primary mb-2" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    Instock <span class="badge bg-white text-primary"><?php echo $instock_count; ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-success" style="margin-left: 20px;" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    Reorder <span class="badge bg-white text-primary"><?php echo $reorder_count; ?></span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="btn btn-danger" style="margin-left: 20px;" id="contact-tab" data-bs-toggle="tab" data-bs-target="#bordered-contact" type="button" role="tab" aria-controls="contact" aria-selected="false">
                                    Out of Stock <span class="badge bg-white text-primary"><?php echo $outofstock_count; ?></span>
                                </button>
                            </li> -->


                            <li class="nav-item" role="presentation">
                  <button class="btn btn-primary mb-2 active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                  Instock <span class="badge bg-white text-primary"><?php echo $instock_count; ?></span>
                  </button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-success"  style="margin-left: 20px;" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                  Reorder <span class="badge bg-white text-primary"><?php echo $reorder_count; ?></span>
                  </button>

                </li>
                <li class="nav-item" role="presentation">
                  <button class="btn btn-danger" style="margin-left: 20px;" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                  Out of Stock <span class="badge bg-white text-primary"><?php echo $outofstock_count; ?></span>
                  </button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="btn btn-warning" style="margin-left: 20px;" id="pills-expired-tab" data-bs-toggle="pill" data-bs-target="#pills-expired" type="button" role="tab" aria-controls="pills-expired" aria-selected="false">
                  Expired Item <span class="badge bg-white text-primary"><?php echo $expired_count; ?></span>
                  </button>
                </li>


                        </ul>
                        <div class="tab-content pt-2" id="borderedTabContent">



                            <!-- In Stock Tab -->
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="home-tab">
                                <table class="table table-hover" id="stock_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Parts Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $connection->prepare("SELECT * FROM motorparts_tbl WHERE QuantityInStock > 5");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['parts_name'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['QuantityInStock'] . "</td>";
                                            echo "</tr>";

                                            $count++;
                                        }
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
                                            <th scope="col">Parts Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $connection->prepare("SELECT * FROM motorparts_tbl WHERE QuantityInStock <= 5 AND QuantityInStock > 0");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['parts_name'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['QuantityInStock'] . "</td>";
                                            echo "</tr>";

                                            $count++;
                                        }
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
                                            <th scope="col">Parts Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $connection->prepare("SELECT * FROM motorparts_tbl WHERE QuantityInStock = 0");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                              echo "<td>" . $count . "</td>";
                                            echo "<td>" . $row['parts_name'] . "</td>";
                                            echo "<td>" . $row['price'] . "</td>";
                                            echo "<td>" . $row['QuantityInStock'] . "</td>";
                                            echo "</tr>";

                                            $count++;
                                        }
                                        ?>
                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>
                        </div><!-- End Bordered Tabs -->


                        <div class="tab-pane fade" id="pills-expired" role="tabpanel" aria-labelledby="expired-tab">

<table class="table table-hover" id="expired_table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Parts Name</th>
                <th scope="col">Price</th>
                <th scope="col">Stock</th>
                <th scope="col">Expired Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $connection->prepare("SELECT * FROM motorparts_tbl WHERE date_expired = '$currentDate' ");
            $stmt->execute();
            $result = $stmt->get_result();
            $count = 1;

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                  echo "<td>" . $count . "</td>";
                echo "<td>" . $row['parts_name'] . "</td>";
                echo "<td>" . $row['price'] . "</td>";
                echo "<td>" . $row['QuantityInStock'] . "</td>";
                echo "<td>" . $row['date_expired'] . "</td>";
                echo "</tr>";

                $count++;
            }
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
        $('#expired_table').DataTable();

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
