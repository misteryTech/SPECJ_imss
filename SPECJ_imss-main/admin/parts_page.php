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

    <!-- Main-->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Inventory Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Add/Edit Parts</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Parts</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" action="process_code/parts_registration.php" method="POST">

                                <div class="col-md-4">
                                    <label for="services_type" class="form-label">Services Type</label>
                                    <select name="services_type" id="services_type" class="form-select">
                                        <option selected>Select Type Of Vehicle</option>
                                        <option value="Car">Car</option>
                                        <option value="Motorcycle">Motorcycle</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="parts_name" class="form-label">Parts Name</label>
                                    <input type="text" class="form-control" id="parts_name" name="parts_name">
                                </div>

                                <div class="col-md-4">
                                    <label for="parts_number" class="form-label">Parts Number</label>
                                    <input type="text" class="form-control" id="parts_number" name="parts_number">
                                </div>

                                <div class="col-md-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select class="form-control" id="category" name="category">
                                        <option value="">Select a category</option>
                                        <option value="engine-components">Engine Components</option>
                                        <option value="exhaust-system">Exhaust System</option>
                                        <option value="electrical-and-lighting">Electrical and Lighting</option>
                                        <option value="fuel-system">Fuel System</option>
                                        <option value="braking-system">Braking System</option>
                                        <option value="transmission-and-drivetrain">Transmission and Drivetrain</option>
                                        <option value="suspension-and-steering">Suspension and Steering</option>
                                        <option value="body-and-frame">Body and Frame</option>
                                        <option value="wheels-and-tires">Wheels and Tires</option>
                                        <option value="controls-and-levers">Controls and Levers</option>
                                        <option value="cooling-system">Cooling System</option>
                                        <option value="accessories">Accessories</option>
                                        <option value="protective-gear">Protective Gear</option>
                                        <option value="maintenance-tools">Maintenance Tools</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="manufacturer" class="form-label">Manufacturer</label>
                                    <select class="form-control" id="manufacturer" name="manufacturer">
                                        <option value="">Select a manufacturer</option>
                                        <option value="bosch">Bosch</option>
                                        <option value="brembo">Brembo</option>
                                        <option value="did">DID</option>
                                        <option value="dunlop">Dunlop</option>
                                        <option value="ebc-brakes">EBC Brakes</option>
                                        <option value="fmf-racing">FMF Racing</option>
                                        <option value="hinson">Hinson</option>
                                        <option value="kn">K&N</option>
                                        <option value="michelin">Michelin</option>
                                        <option value="ngk">NGK</option>
                                        <option value="ohlins">Ohlins</option>
                                        <option value="pirelli">Pirelli</option>
                                        <option value="renthal">Renthal</option>
                                        <option value="rk-excel">RK Excel</option>
                                        <option value="scorpion-exhausts">Scorpion Exhausts</option>
                                        <option value="shinko">Shinko</option>
                                        <option value="showa">Showa</option>
                                        <option value="vance-hines">Vance & Hines</option>
                                        <option value="wiseco">Wiseco</option>
                                        <option value="yoshimura">Yoshimura</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                </div>

                                <div class="col-md-4">
                                    <label for="quantity_stock" class="form-label">Quantity in Stock</label>
                                    <input type="number" class="form-control" id="quantity_stock" name="quantity_stock">
                                </div>

                                <div class="col-md-4">
                                    <label for="supplier" class="form-label">Supplier</label>
                                    <input type="text" class="form-control" id="supplier" name="supplier">
                                </div>

                                <div class="col-md-4">
                                    <label for="condition" class="form-label">Condition</label>
                                    <select name="condition" id="condition" class="form-select">
                                        <option selected>Select Condition</option>
                                        <option value="New">New</option>
                                        <option value="Replacement">Replacement</option>
                                        <option value="Generic">Generic</option>
                                    </select>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Multi Columns Form -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Parts</h5>
                            <table class="table table-hover" id="parts_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Parts Name</th>
                                        <th scope="col">Parts Number</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $connection->prepare("SELECT * FROM motorparts_tbl");
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
                                            echo "<button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row['m_id'] . "'>Edit</button> ";
                                            echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $row['m_id'] . "'>Delete</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $count++;
                                            // Edit Modal
                                            echo "<div class='modal fade' id='editModal" . $row['m_id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['m_id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel" . $row['m_id'] . "'>Edit Service</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<form action='process_code/parts_edit_information.php' method='POST'>";
                                            echo "<input type='hidden' name='parts_id' value='" . $row['m_id'] . "'>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_parts_name" . $row['m_id'] . "'>Parts Name</label>";
                                            echo "<input type='text' class='form-control' id='edit_parts_name" . $row['m_id'] . "' name='parts_name' value='" . $row['parts_name'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_parts_number" . $row['m_id'] . "'>Parts Number</label>";
                                            echo "<input type='text' class='form-control' id='edit_parts_number" . $row['m_id'] . "' name='parts_number' value='" . $row['parts_number'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_category" . $row['m_id'] . "'>Category</label>";
                                            echo "<input type='text' class='form-control' id='edit_category" . $row['m_id'] . "' name='category' value='" . $row['category'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_manufacturer" . $row['m_id'] . "'>Manufacturer</label>";
                                            echo "<input type='text' class='form-control' id='edit_manufacturer" . $row['m_id'] . "' name='manufacturer' value='" . $row['manufacturer'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_price" . $row['m_id'] . "'>Price</label>";
                                            echo "<input type='text' class='form-control' id='edit_price" . $row['m_id'] . "' name='price' value='" . $row['price'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_quantity_stock" . $row['m_id'] . "'>Stock</label>";
                                            echo "<input type='text' class='form-control' id='edit_quantity_stock" . $row['m_id'] . "' name='quantity_stock' value='" . $row['QuantityInStock'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_supplier" . $row['m_id'] . "'>Supplier</label>";
                                            echo "<input type='text' class='form-control' id='edit_supplier" . $row['m_id'] . "' name='supplier' value='" . $row['supplier'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_condition" . $row['m_id'] . "'>Condition</label>";
                                            echo "<input type='text' class='form-control' id='edit_condition" . $row['m_id'] . "' name='condition' value='" . $row['condition'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='edit_services_type" . $row['m_id'] . "'>Service Type</label>";
                                            echo "<select class='form-control' id='edit_services_type" . $row['m_id'] . "' name='services_type' required>";
                                            echo "<option value='Car'" . ($row['services_type'] == 'Car' ? ' selected' : '') . ">Car</option>";
                                            echo "<option value='Motorcycle'" . ($row['services_type'] == 'Motorcycle' ? ' selected' : '') . ">Motorcycle</option>";
                                            echo "</select>";
                                            echo "</div>";

                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<button type='submit' class='btn btn-primary'>Save Changes</button>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>";
                                            echo "</form>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            // Delete Modal
                                            echo "<div class='modal fade' id='deleteModal" . $row['m_id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel" . $row['m_id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog' role='document'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . $row['m_id'] . "'>Delete Service</h5>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete this service?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<form action='process_code/parts_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='parts_id' value='" . $row['m_id'] . "'>";
                                            echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
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

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#parts_datatable').DataTable();
        });
    </script>

</body>
</html>
