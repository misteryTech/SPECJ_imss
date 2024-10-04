<?php
    include("user_header.php");
    include("user_topnav.php");
    include("user_sidenav.php");

    // Ensure the database connection is established
    // Example connection code (you should adapt it to your actual connection setup)
    // $connection = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Query mechanist
    $sql_mechanist = "SELECT * FROM mechanist_tbl";
    $result_mechanist = $connection->query($sql_mechanist);
    $mechanist = [];
    if ($result_mechanist->num_rows > 0) {
        while ($row_result_mechanist = $result_mechanist->fetch_assoc()) {
            $mechanist[] = $row_result_mechanist;
        }
    }

    // Query registered services
    $sql_services = "SELECT DISTINCT * FROM services_tbl";
    $result_services = $connection->query($sql_services);
    $services = [];
    if ($result_services->num_rows > 0) {
        while ($row_result_services = $result_services->fetch_assoc()) {
            $services[] = $row_result_services;
        }
    }

    // Query to fetch customers and their registered vehicles
    if (isset($_SESSION['id'])) {
        $customer_id = $_SESSION['id'];
        $sql = "
            SELECT c.id AS customer_id, c.c_firstname, c.c_lastname, c.phone, c.email, c.address,
                   v.license_plate, v.vehicle_model, v.id AS vehicle_id
            FROM customers_tbl c
            INNER JOIN c_vehicles_registration_tbl v ON c.id = v.customer_id
            WHERE c.id = ?
        ";

        // Prepare and bind parameters to avoid SQL injection
        if ($stmt = $connection->prepare($sql)) {
            $stmt->bind_param("i", $customer_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $customers = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $customers[$row['customer_id']]['customer_info'] = [
                        'c_firstname' => $row['c_firstname'],
                        'c_lastname' => $row['c_lastname'],
                        'phone' => $row['phone'],
                        'email' => $row['email'],
                        'address' => $row['address']
                    ];
                    $customers[$row['customer_id']]['vehicles'][] = [
                        'license_plate' => $row['license_plate'],
                        'vehicle_model' => $row['vehicle_model'],
                        'vehicle_id' => $row['vehicle_id']
                    ];
                }
            }
            $stmt->close();
        } else {
            echo "Error preparing the statement: " . $connection->error;
        }
    } else {
        echo "Customer ID not found in session.";
    }

    $connection->close();
?>
<body>

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
                    <form class="row g-3" action="process_code/services_schedule_registration.php" method="POST">

                        <!-- Customer Information -->
                        <div class="col-md-6">
                          
                            <input type="hidden" class="form-control" id="customer_name" name="customer_name" value="<?php echo htmlspecialchars($_SESSION['id']); ?>" readonly>
                        </div>

                        <!-- Vehicle Information -->
                        <div class="col-12">
                            <h6>Vehicle Information</h6>
                            <hr>
                        </div>
                        <div class="col-md-4">
                            <label for="license_plate" class="form-label">License Plate Number</label>
                            <select name="license_plate" id="license_plate" class="form-select" onchange="updateVehicleModel()">
                                <option value="" selected>Select License Plate</option>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="vehicle_model" class="form-label">Vehicle Model</label>
                            <input type="text" class="form-control" id="vehicle_model" name="vehicle_model" readonly>
                        </div>
                        <div class="col-md-6">
                     
                            <input type="hidden" class="form-control" id="vehicle_id" name="vehicle_id" readonly>
                        </div>

                        <!-- Service Details -->
                        <div class="col-12">
                            <h6>Service Details</h6>
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <label for="services_name" class="form-label">Select Services</label>
                            <select name="services_name" id="services_name" class="form-select">
                                <option value="" selected>Select Services</option>
                                <?php foreach ($services as $services_data) : ?>
                                    <option value="<?php echo $services_data['id']; ?>">
                                    <?php echo htmlspecialchars($services_data['services_name']); ?>
                                    </option>
                                <?php endforeach; ?>
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

                        <!-- Mechanist Information -->
                        <div class="col-12">
                            <h6>Mechanist Information</h6>
                            <hr>
                        </div>
                        <div class="col-md-6">
                            <label for="select_mechanist" class="form-label">Assigned Mechanist</label>
                            <select name="select_mechanist" id="select_mechanist" class="form-select">
                                <?php foreach ($mechanist as $mechanist_data) : ?>
                                    <option value="<?php echo $mechanist_data['id']; ?>">
                                    <?php echo htmlspecialchars($mechanist_data['m_firstname'] . ' ' . $mechanist_data['m_lastname']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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

<!-- ======= Footer ======= -->
<?php
    include("user_footer.php");
?>

<script>
    var customers = <?php echo json_encode($customers); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        updateCustomerInfo();
    });

    function updateCustomerInfo() {
        var customerId = document.getElementById('customer_name').value;
        if (customerId) {
            var customer = customers[customerId].customer_info;
            var vehicles = customers[customerId].vehicles;

            // Populate license plate dropdown
            var licensePlateDropdown = document.getElementById('license_plate');
            licensePlateDropdown.innerHTML = '<option value="" selected>Select License Plate</option>';
            vehicles.forEach(function(vehicle) {
                var option = document.createElement('option');
                option.value = vehicle.license_plate;
                option.textContent = vehicle.license_plate;
                licensePlateDropdown.appendChild(option);
            });
        }
    }

    function updateVehicleModel() {
        var customerId = document.getElementById('customer_name').value;
        var licensePlate = document.getElementById('license_plate').value;
        if (customerId && licensePlate) {
            var vehicles = customers[customerId].vehicles;
            var vehicle = vehicles.find(function(v) {
                return v.license_plate === licensePlate;
            });
            if (vehicle) {
                document.getElementById('vehicle_model').value = vehicle.vehicle_model;
                document.getElementById('vehicle_id').value = vehicle.vehicle_id;
            }
        }
    }
</script>
