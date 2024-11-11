<?php include("admin_header.php"); ?>
<body>

    <!-- Header and Sidebar -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");


        
if (isset($_GET['sched_id'])) {
    $sched_service_id = $_GET['sched_id'];
}
    ?>

    <!-- Main Content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Inventory Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Parts Management</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Release Parts</h5>

                            <!-- Multi Columns Form -->
                            <form action='process_code/process_release_parts.php' method='POST'>
                                <div id='partsContainer'>


                                <input type="text" name="sched_service_id" value="<?php echo $sched_service_id; ?>">


                                    <div class='row mb-3 parts-row'>
                                        <!-- Parts Dropdown -->
                                        <div class='col-md-8'>
                                          
                                            <div class='form-group'>
                                                <label for='parts_name'>Parts Name</label>

                                                <select class='form-control' name='parts_name[]'>
                                                    <?php
                                                    $parts_query = "SELECT m_id, parts_name, price FROM motorparts_tbl";
                                                    $parts_result = $connection->query($parts_query);
                                                    if ($parts_result && $parts_result->num_rows > 0) {
                                                        while ($part = $parts_result->fetch_assoc()) {
                                                            echo "<option value='" . $part['m_id'] . "'>" . $part['parts_name'] . " - " . $part['price'] . "</option>";
                                                        }
                                                    } else {
                                                        echo "<option value=''>No parts available</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Quantity Field -->
                                        <div class='col-md-4'>
                                            <div class='form-group'>
                                                <label for='quantity'>Quantity</label>
                                                <input type='number' class='form-control' name='quantity[]' min='1' value='1'>
                                            </div>
                                        </div>

                                        <div class='col-md-12 text-end'>
                                            <button type='button' class='btn btn-danger remove-item-btn mt-2'>Remove Item</button>
                                        </div>
                                    </div>
                                </div>

                                <button type='button' class='btn btn-success' onclick='addPartsRow()'>Add Item</button>
                                <button type='submit' class='btn btn-primary'>Release Item</button>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- Footer -->
    <?php include("admin_footer.php"); ?>

    <!-- JavaScript for Dynamic Form Elements -->
    <script>

   function addPartsRow() {
        // Create a new row with the same structure as the existing one
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-3', 'parts-row');

        newRow.innerHTML = `
            <div class='col-md-8'>
                <div class='form-group'>
                    <label for='parts_name'>Parts Name</label>
                    <select class='form-control' name='parts_name[]'>
                        <?php
                        $parts_query = "SELECT m_id, parts_name, price FROM motorparts_tbl";
                        $parts_result = $connection->query($parts_query);
                        if ($parts_result && $parts_result->num_rows > 0) {
                            while ($part = $parts_result->fetch_assoc()) {
                                echo "<option value='" . $part['m_id'] . "'>" . $part['parts_name'] . " - " . $part['price'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>No parts available</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class='col-md-4'>
                <div class='form-group'>
                    <label for='quantity'>Quantity</label>
                    <input type='number' class='form-control' name='quantity[]' min='1' value='1'>
                </div>
            </div>

            <div class='col-md-12 text-end'>
                <button type='button' class='btn btn-danger remove-item-btn mt-2'>Remove Item</button>
            </div>
        `;

        // Append the new row to the partsContainer
        document.getElementById('partsContainer').appendChild(newRow);
    }

    // Event delegation for dynamically added elements
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-item-btn')) {
            event.target.closest('.parts-row').remove(); // Remove the closest parts-row
        }
    });
     
    </script>

</body>
</html>
