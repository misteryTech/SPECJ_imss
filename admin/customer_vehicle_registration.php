<?php include("admin_header.php"); ?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("admin_topnav.php");
        include("admin_sidenav.php");

        // Database connection assumed to be established earlier
        // Fetch limited number of customers
        $sql = "SELECT id, c_firstname, c_lastname, phone, email, address FROM customers_tbl LIMIT 10";
        $result = $connection->query($sql);

        $customers = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $customers[] = $row;
            }
        }


    // Query to fetch customers with their vehicle registration details
    $sql_vehicle = "SELECT  c.id, c.c_firstname, c.c_lastname, c.phone, c.email, c.address,
    v.vehicle_model, v.vehicle_year, v.license_plate, v.mileage, v.vin, v.registration_date, v.notes , v.id
FROM customers_tbl c
INNER JOIN c_vehicles_registration_tbl v ON c.id = v.customer_id";

$result = $connection->query($sql_vehicle);

$c_vehicle = [];
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$c_vehicle[] = $row;
}
}



    ?>

    <!-- Main -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Customer Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Customer Information</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Customer Registration</h5>

                            <!-- Customer Registration Form -->
                            <form class="row g-3" action="process_code/customer_vehicle_registration.php" method="POST">
                                <div class="col-md-6">
                                    <label for="customer_name" class="form-label">Customer Name</label>
                                    <select name="customer_name" id="customer_name" class="form-select" onchange="updateCustomerInfo()">
                                        <option value="" selected>Select Customer</option>
                                        <?php foreach ($customers as $customer) : ?>
                                            <option value="<?php echo htmlspecialchars($customer['id']); ?>">
                                                <?php echo htmlspecialchars($customer['c_firstname'] . ' ' . $customer['c_lastname']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="vehicle_model" class="form-label">Vehicle Model</label>
                                    <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="vehicle_year" class="form-label">Vehicle Year</label>
                                    <input type="number" class="form-control" id="vehicle_year" name="vehicle_year" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="license_plate" class="form-label">License Plate Number</label>
                                    <input type="text" class="form-control" id="license_plate" name="license_plate" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="mileage" class="form-label">Current Mileage</label>
                                    <input type="number" class="form-control" id="mileage" name="mileage">
                                </div>
                                <div class="col-md-6">
                                    <label for="vin" class="form-label">Vehicle Identification Number (VIN)</label>
                                    <input type="text" class="form-control" id="vin" name="vin">
                                </div>
                                <div class="col-md-6">
                                    <label for="registration_date" class="form-label">Registration Date</label>
                                    <input type="date" class="form-control" id="registration_date" name="registration_date">
                                </div>
                                <div class="col-md-12">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                            </form><!-- End Customer Registration Form -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Customers</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="customer_vehicle_datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Plate Number</th>
                                            <th scope="col">Date Registration</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $count = 1;
                                            foreach ($c_vehicle as $vehicle) {
                                                echo "<tr>";
                                                echo "<td>".$count."</td>";
                                                echo "<td>".$vehicle['c_firstname'].' '.$vehicle['c_lastname']."</td>";
                                                echo "<td>".$vehicle['license_plate']."</td>";
                                                echo "<td>".$vehicle['registration_date']."</td>";
                                                echo "<td>";
                                                echo "<button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $vehicle['id'] . "'>Edit</button> ";
                                                echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $vehicle['id'] . "'>Delete</button>";
                                                echo "</td>";
                                                echo "</tr>";

                                                // Edit Modal
                                                echo "<div class='modal fade' id='editModal" . $vehicle['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $vehicle['id'] . "' aria-hidden='true'>";
                                                echo "<div class='modal-dialog'>";
                                                echo "<div class='modal-content'>";
                                                echo "<div class='modal-header'>";
                                                echo "<h5 class='modal-title' id='editModalLabel" . $vehicle['id'] . "'>Edit Customer</h5>";
                                                echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                                echo "</div>";
                                                echo "<div class='modal-body'>";
                                                echo "<form action='process_code/customer_edit_information.php' method='POST'>";
                                                echo "<input type='hidden' name='customer_id' value='" . $vehicle['id'] . "'>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editFirstname" . $vehicle['id'] . "'>Firstname</label>";
                                                echo "<input type='text' class='form-control' id='editFirstname" . $vehicle['id'] . "' name='edit_firstname' value='" . $vehicle['c_firstname'] . "' required>";
                                                echo "</div>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editLastname" . $vehicle['id'] . "'>Lastname</label>";
                                                echo "<input type='text' class='form-control' id='editLastname" . $vehicle['id'] . "' name='edit_lastname' value='" . $vehicle['c_lastname'] . "' required>";
                                                echo "</div>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editEmail" . $vehicle['id'] . "'>Email</label>";
                                                echo "<input type='text' class='form-control' id='editEmail" . $vehicle['id'] . "' name='edit_email' value='" . $vehicle['email'] . "' required>";
                                                echo "</div>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editPhone" . $vehicle['id'] . "'>Phone</label>";
                                                echo "<input type='text' class='form-control' id='editPhone" . $vehicle['id'] . "' name='edit_phone' value='" . $vehicle['phone'] . "' required>";
                                                echo "</div>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editAddress" . $vehicle['id'] . "'>Address</label>";
                                                echo "<input type='text' class='form-control' id='editAddress" . $vehicle['id'] . "' name='edit_address' value='" . $vehicle['address'] . "' required>";
                                                echo "</div>";

                                                echo "<div class='form-group'>";
                                                echo "<label for='editAddress" . $vehicle['id'] . "'>Plate Number</label>";
                                                echo "<input type='text' class='form-control' id='editAddress" . $vehicle['id'] . "' name='edit_address' value='" . $vehicle['license_plate'] . "' required>";
                                                echo "</div>";



                                                echo "<div class='form-group'>";
                                                echo "<label for='editRegistrationDate" . $vehicle['id'] . "'>Registration Date</label>";
                                                echo "<input type='text' class='form-control' id='editRegistrationDate" . $vehicle['id'] . "' name='edit_registration_date' value='" . $vehicle['registration_date'] . "' required>";
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
                                                echo "<div class='modal fade' id='deleteModal" . $vehicle['id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel" . $vehicle['id'] . "' aria-hidden='true'>";
                                                echo "<div class='modal-dialog' role='document'>";
                                                echo "<div class='modal-content'>";
                                                echo "<div class='modal-header'>";
                                                echo "<h5 class='modal-title' id='deleteModalLabel" . $vehicle['id'] . "'>Delete Customer</h5>";
                                                echo "</div>";
                                                echo "<div class='modal-body'>";
                                                echo "<p>Are you sure you want to delete this customer?</p>";
                                                echo "</div>";
                                                echo "<div class='modal-footer'>";
                                                echo "<form action='process_code/customer_delete.php' method='POST' style='display:inline;'>";
                                                echo "<input type='hidden' name='customer_id' value='" . $vehicle['id'] . "'>";
                                                echo "<button type='submit' class='btn btn-danger'>Delete</button>";
                                                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancel</button>";
                                                echo "</form>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";

                                                $count++;
                                            }
                                        ?>
                                    </tbody>
                                </table><!-- End Table with hoverable rows -->
                            </div>
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
            $('#customer_vehicle_datatable').DataTable();
        });

        function updateCustomerInfo() {
            var customer = JSON.parse(document.getElementById('customer_name').value);

            document.getElementById('phone').value = customer.phone;
            document.getElementById('email').value = customer.email;
            document.getElementById('address').value = customer.address;
        }

        function filterCustomers() {
            var searchInput = document.getElementById('customer_search').value.toLowerCase();
            var dropdown = document.getElementById('customer_name');
            var options = dropdown.getElementsByTagName('option');

            for (var i = 0; i < options.length; i++) {
                var optionText = options[i].textContent || options[i].innerText;
                if (optionText.toLowerCase().indexOf(searchInput) > -1) {
                    options[i].style.display = "";
                } else {
                    options[i].style.display = "none";
                    alert('No User Found');
                }
            }
        }
    </script>
</body>
</html>
