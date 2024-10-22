<?php
include("admin_header.php");
include("admin_topnav.php");
include("admin_sidenav.php");

// Check if the form has been submitted
$query = '';
$searchResults = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = trim($_POST['query']);

    // SQL query to search in motorparts_tbl
    $sql = "SELECT MT.*,ST.*
    
     FROM motorparts_tbl AS MT
     INNER JOIN suppliers_tbl AS ST ON ST.id = MT.supplier
     
     
     WHERE parts_name LIKE '%$query%' OR parts_number LIKE '%$query%'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row;
        }
    } else {
        echo "<p>No results found for '<strong>$query</strong>'</p>";
    }
    $connection->close();
}
?>

<body>
    <!-- Main -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Search Item</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">List of Item</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search Results</h5>

                            <!-- Search Results Table -->
                            <?php if (!empty($searchResults)) : ?>
                                <table class="table table-striped" id="search_results_table">
                                    <thead>
                                        <tr>
                                            <th>Part Name</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                            <th>Supplier</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($searchResults as $item) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($item['parts_name']); ?></td>
                                                <td><?php echo htmlspecialchars($item['parts_number']); ?></td>
                                                <td><?php echo htmlspecialchars($item['QuantityInStock']); ?></td>
                                                <td><?php echo htmlspecialchars($item['supplierName']); ?></td>
                                                <td>
                                                    <button class="btn btn-warning" data-toggle="modal" data-target="#returnModal<?php echo $item['m_id']; ?>">Return Item</button>
                                                </td>
                                            </tr>

                                            <!-- Return Item Modal -->
                                            <div class="modal fade" id="returnModal<?php echo $item['m_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel<?php echo $item['m_id']; ?>" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="returnModalLabel<?php echo $item['m_id']; ?>">Return Item</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="process_code/process_return.php" method="POST">
                                                            <div class="modal-body">
                                                               
                                                                <h1><?php echo $item['contactPerson']; ?></h1>
                                                                <h6>Contact Person</h6>
                                                                <input type="hidden" name="item_id" value="<?php echo $item['m_id']; ?>">
                                                                <div class="form-group">
                                                                    <label for="return_quantity">Quantity Instock</label>
                                                                    <input type="text" class="form-control" name="stock" value="<?php echo $item['QuantityInStock']; ?> "readonly>
                                                                </div>


                                                           
                                                                <input type="hidden" name="supplier" value="<?php echo $item['supplier']; ?>">
                                                                <div class="form-group">
                                                                    <label for="return_quantity">Quantity to Return</label>
                                                                    <input type="number" class="form-control" name="return_quantity" min="1" max="<?php echo $item['QuantityInStock']; ?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="return_reason">Reason for Return</label>
                                                                    <textarea class="form-control" name="return_reason" rows="3" required></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Submit Return</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Return Item Modal -->

                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php else : ?>
                                <p>No items found matching your search criteria.</p>
                            <?php endif; ?>
                            <!-- End Search Results Table -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include("admin_footer.php"); ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#search_results_table').DataTable();
        });
    </script>
</body>
</html>
