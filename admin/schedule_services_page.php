<?php
    include("admin_header.php");
?>
<body>

     <!-- ======= Header ======= -->
     <!-- ======= Sidebar ======= -->
<?php
    include("admin_topnav.php");
    include("admin_sidenav.php");



     // Query to fetch limited number of customers
     $sql = "SELECT id, c_firstname, c_lastname, phone, email, address FROM customers_tbl LIMIT 10";
     $result = $connection->query($sql);

     $customers = [];
     if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             $customers[] = $row;
         }
     }
     $connection->close();



?>

  <!-- Main-->
  <main id="main" class="main">

<div class="pagetitle">
    <h1>Services Management</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Schedule Services</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Schedule Services</h5>

                    <!-- Multi Columns Form -->
                    <form class="row g-3" action="process_code/Services_registration.php" method="POST">

                        <!-- Customer Information -->
                        <div class="col-12">
                            <h6>Customer Information</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                                <label for="customer_name" class="form-label">Customer Name</label>
                                <select name="customer_name" id="customer_name" class="form-select" onchange="updateCustomerInfo()">
                                    <option value="" selected>Select Customer</option>
                                    <?php foreach ($customers as $customer) : ?>
                                        <option value="<?php echo htmlspecialchars(json_encode($customer)); ?>">
                                            <?php echo htmlspecialchars($customer['c_firstname'] . ' ' . $customer['c_lastname']); ?>

                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="contact_number" class="form-label">Contact Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="email_address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" readonly>
                            </div>

                        <!-- Vehicle Information -->
                        <div class="col-12">
                            <h6>Vehicle Information</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label for="vehicle_make" class="form-label">Vehicle Make</label>
                            <input type="text" class="form-control" id="vehicle_make" name="vehicle_make">
                        </div>
                        <div class="col-md-6">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" id="vehicle_model" name="vehicle_model">
                        </div>
                        <div class="col-md-4">
                            <label for="vehicle_year" class="form-label">Vehicle Year</label>
                            <input type="number" class="form-control" id="vehicle_year" name="vehicle_year">
                        </div>

                        <div class="col-md-4">
                            <label for="license_plate" class="form-label">License Plate Number</label>
                            <input type="text" class="form-control" id="license_plate" name="license_plate">
                        </div>

                        <!-- Service Details -->
                        <div class="col-12">
                            <h6>Service Details</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label for="service_type" class="form-label">Service Type</label>
                            <select name="service_type" id="service_type" class="form-select">
                                <option selected>Select Service Type</option>
                                <option value="Oil Change">Oil Change</option>
                                <option value="Tire Rotation">Tire Rotation</option>
                                <option value="Brake Inspection">Brake Inspection</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="service_description" class="form-label">Service Description</label>
                            <textarea class="form-control" id="service_description" name="service_description"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="service_date" class="form-label">Service Date</label>
                            <input type="date" class="form-control" id="service_date" name="service_date">
                        </div>
                        <div class="col-md-4">
                            <label for="preferred_time" class="form-label">Preferred Time Slot</label>
                            <input type="time" class="form-control" id="preferred_time" name="preferred_time">
                        </div>
                        <div class="col-md-4">
                            <label for="estimated_mileage" class="form-label">Estimated Mileage at Service Time</label>
                            <input type="number" class="form-control" id="estimated_mileage" name="estimated_mileage">
                        </div>

                        <!-- Technician Information -->
                        <div class="col-12">
                            <h6>Technician Information</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label for="assigned_technician" class="form-label">Assigned Technician</label>
                            <input type="text" class="form-control" id="assigned_technician" name="assigned_technician">
                        </div>
                        <div class="col-md-6">
                            <label for="technician_notes" class="form-label">Technician Notes</label>
                            <textarea class="form-control" id="technician_notes" name="technician_notes"></textarea>
                        </div>

                       <!-- Comments/Notes -->
                        <div class="col-12">
                            <h6>Comments/Notes</h6>
                            <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="customer_comments" class="form-label">Customer Comments</label>
                            <textarea class="form-control" id="customer_comments" name="customer_comments"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="special_instructions" class="form-label">Special Instructions</label>
                            <textarea class="form-control" id="special_instructions" name="special_instructions"></textarea>
                        </div>



                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form><!-- End Multi Columns Form -->
                </div>
            </div>
        </div>
    </div>
</section>
</main><!-- End #main -->

  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
    include("admin_footer.php");
?>

<script>
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
                alert('No User Foumd');
            }
        }
    }
</script>
