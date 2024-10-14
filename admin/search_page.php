<?php

    include("admin_header.php");
 
?>  
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_header.php");
      
        ?>
        <body>
        
            <!-- ======= Header ======= -->
            <!-- ======= Sidebar ======= -->
            <?php
                include("admin_topnav.php");
                include("admin_sidenav.php");
        
                // Check if the form has been submitted
                $query = '';
                $searchResults = [];
        
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $query = trim($_POST['query']);
                    
                  
                    
                    // SQL query to search in motorparts_tbl
                    $sql = "SELECT * FROM motorparts_tbl WHERE parts_name LIKE '%$query%' OR parts_number LIKE '%$query%'";
        
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
        
            <!-- Main-->
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
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($searchResults as $item) : ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($item['parts_name']); ?></td>
                                                        <td><?php echo htmlspecialchars($item['parts_number']); ?></td>
                                                        <td><?php echo htmlspecialchars($item['QuantityInStock']); ?></td>
                                                        <td><?php echo htmlspecialchars($item['supplier']); ?></td>
                                                    </tr>
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
            <?php
                include("admin_footer.php");
            ?>
        
            <!-- Include jQuery and DataTables CSS/JS -->
            <script>
                $(document).ready(function() {
                    $('#search_results_table').DataTable();
                });
            </script>
        
        </body>
        </html>
    