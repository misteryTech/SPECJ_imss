<?php
    include("admin_header.php");
?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");

        $sql = "SELECT id, supplierName, contactPerson, email, phone ,address, registrationDate FROM suppliers_tbl LIMIT 10";
        $result = $connection->query($sql);

        $supplier = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $suppliers[] = $row;
            }
        }



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
                            <form class="row g-3" action="process_code/parts_registration.php" method="POST" enctype="multipart/form-data">
                                <div class="col-md-4">
                                <img id="image_preview" src="" alt="Image Preview" style="max-width: 100%; margin-bottom: 15px;">
                                    <label for="parts_image" class="form-label">Product Picture</label>
                                    <input type="file" class="form-control" id="parts_image" name="parts_image" onchange="previewImage(event)">

                                </div>

                                <div class="col-md-12">
                                    <label for="parts_name" class="form-label">Parts Name</label>
                                    <input type="text" class="form-control" id="parts_name" name="parts_name">
                                </div>

                                <div class="col-md-4">
                                    <label for="services_type" class="form-label">Services Type</label>
                                    <select name="services_type" id="services_type" class="form-select">
                                        <option selected>Select Type Of Vehicle</option>
                                        <option value="Car">Car</option>
                                        <option value="Motorcycle">Motorcycle</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="parts_number" class="form-label">Parts Number</label>
                                    <input type="text" class="form-control" id="parts_number" name="parts_number">
                                </div>

                                <div class="col-md-4">
                                    <label for="date_expired" class="form-label">Date Expired</label>
                                    <input type="date" class="form-control" id="date_expired" name="date_expired" required> 
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
                                    <label for="manufacturer" class="form-label">Brand Name</label>
                                    <select class="form-control" id="manufacturer" name="manufacturer">
                                        <option value="">Select a Brand</option>
                                        <option value="Rusi">Rusi</option>
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

                                <div class="col-md-2">
                                    <label for="quantity_stock" class="form-label">Quantity in Stock</label>
                                    <input type="number" class="form-control" id="quantity_stock" name="quantity_stock">
                                </div>

                                
                                <div class="col-md-2">
                                    <label for="quantity_stock" class="form-label">Unit</label>
                                    <select class="form-control" id="unit" name="unit">
                                        <option value="" disabled>Unit</option>
                                        <option value="Pcs">Pieces</option>
                                        <option value="Set">Set</option>
                                        <option value="Roll">Roll</option>
                                        <option value="Pack">Pack</option>
                                      
                                    </select>
                                </div>


                                    <div class="col-md-4">
                                    <label for="customer_name" class="form-label">Supplier</label>
                                    <select name="supplier" id="supplier" class="form-select" onchange="updateCustomerInfo()">
                                        <option value="" selected>Select Supplier</option>
                                        <?php foreach ($suppliers as $supplier) : ?>
                                            <option value="<?php echo htmlspecialchars($supplier['id']); ?>">
                                                <?php echo htmlspecialchars($supplier['supplierName']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
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
                                    <button type="reset" class="btn btn-secondary" onclick="resetImagePreview()">Reset</button>
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
                                        <th scope="col">Brand</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                   $stmt = $connection->prepare("
                                   SELECT mp.*, s.supplierName, mp.parts_name, mp.parts_number, mp.price, mp.QuantityInStock, mp.manufacturer
                                   FROM motorparts_tbl mp
                                      INNER JOIN suppliers_tbl s ON mp.supplier = s.id
                                    WHERE mp.archive='0' ");
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

                                            echo "<td>".$row['supplierName']."</td>";
                                            echo "<td>".$row['manufacturer']."</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row['m_id'] . "'>Edit</button> ";
                                            echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $row['m_id'] . "'>Archive</button>";
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
                                                      echo "<form action='process_code/parts_edit_information.php' method='POST'  enctype='multipart/form-data'>";
                                                      echo "<input type='hidden' name='m_id' value='" . $row['m_id'] . "'>";



                                            echo "<div class='form-group'>";
                                            echo "<label for='current_image' class='col-form-label'>Current Image:</label><br>";
                                            echo "<img src='process_code/" . $row['image_path'] . "' alt='Current Image' style='max-width: 250px; max-height: 250px;'>";
                                            echo "</div>";

                                            // Add an input field for uploading a new image
                                            echo "<div class='form-group'>";
                                            echo "<label for='new_image' class='col-form-label'>Upload New Image:</label>";
                                            echo "<input type='file' class='form-control-file' id='new_image' name='new_image'>";
                                            echo "<small class='form-text text-muted'>Upload a new image if you want to replace the current one.</small>";
                                            echo "</div>";



                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_parts_name" . $row['m_id'] . "'>Parts Name</label>";
                                                      echo "<input type='text' class='form-control' id='edit_parts_name" . $row['m_id'] . "' name='edit_parts_name' value='" . $row['parts_name'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_parts_number" . $row['m_id'] . "'>Parts Number</label>";
                                                      echo "<input type='text' class='form-control' id='edit_parts_number" . $row['m_id'] . "' name='edit_parts_number' value='" . $row['parts_number'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_category" . $row['m_id'] . "'>Category</label>";
                                                      echo "<input type='text' class='form-control' id='edit_category" . $row['m_id'] . "' name='edit_category' value='" . $row['category'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_manufacturer" . $row['m_id'] . "'>Manufacturer</label>";
                                                      echo "<input type='text' class='form-control' id='edit_manufacturer" . $row['m_id'] . "' name='edit_manufacturer' value='" . $row['manufacturer'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_price" . $row['m_id'] . "'>Price</label>";
                                                      echo "<input type='text' class='form-control' id='edit_price" . $row['m_id'] . "' name='edit_price' value='" . $row['price'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_quantity_stock" . $row['m_id'] . "'>Stock</label>";
                                                      echo "<input type='text' class='form-control' id='edit_quantity_stock" . $row['m_id'] . "' name='edit_quantity_stock' value='" . $row['QuantityInStock'] . "' required>";
                                                      echo "</div>";

                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_supplier" . $row['m_id'] . "'>Supplier</label>";
                                                      echo "<input type='text' class='form-control' id='edit_supplier" . $row['m_id'] . "' name='edit_supplier' value='" . $row['supplier'] . "' required>";
                                                      echo "</div>";


                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_condition" . $row['m_id'] . "'>Condition</label>";
                                                      echo "<select class='form-control' id='edit_condition" . $row['m_id'] . "' name='edit_condition' required>";
                                                      echo "<option value='New'" . ($row['status'] == 'New' ? ' selected' : '') . ">New</option>";
                                                      echo "<option value='Generic'" . ($row['status'] == 'Generic' ? ' selected' : '') . ">Generic</option>";
                                                      echo "<option value='Replacement'" . ($row['status'] == 'Replacement' ? ' selected' : '') . ">Replacement</option>";
                                                      echo "</select>";
                                                      echo "</div>";



                                                      echo "<div class='form-group'>";
                                                      echo "<label for='edit_services_type" . $row['m_id'] . "'>Service Type</label>";
                                                      echo "<select class='form-control' id='edit_services_type" . $row['m_id'] . "' name='edit_services_type' required>";
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
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . $row['m_id'] . "'>Delete Parts</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to Archive this Parts?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";


                                       
                                            
                                            echo "<form action='process_code/parts_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='m_id' value='" . $row['m_id'] . "'>";
                                            echo "<button type='submit' class='btn btn-danger'>Archive</button>";
                                            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
                                            echo "</form>";



                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                        }
                                    ?>
                                </tbody>
                            </table>
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

    <!-- JavaScript to Preview Image -->
    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        function resetImagePreview() {
            document.getElementById('image_preview').src = "";
        }

        $(document).ready(function() {
            $('#parts_datatable').DataTable();
        });
    </script>

</body>

</html>
