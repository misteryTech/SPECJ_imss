<?php
    include("admin_header.php");
    include("connection.php");
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
            <h1>Service Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">List of Service</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Services</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" action="process_code/Services_registration.php" method="POST">
                                <div class="col-md-4">
                                    <label for="services_type" class="form-label">Services Type</label>
                                    <select name="services_type" id="services_type" class="form-select">
                                        <option selected>Select Type Of Vehicle</option>
                                        <option value="Car">Car</option>
                                        <option value="Motorcycle">Motorcycle</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="services_name" class="form-label">Services Name</label>
                                    <input type="text" class="form-control" id="services_name" name="services_name">
                                </div>
                                <div class="col-md-4">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control" id="price" name="price">
                                    </div>
                                <div class="col-md-12">
                                <label for="description" class="form-label">Desciption</label>
                                <textarea name="description" class="form-control" id=""></textarea>
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
                            <h5 class="card-title">List of Services</h5>
                            <table class="table table-hover" id="services_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Services Name</th>
                                        <th scope="col">Services Type</th>
                                        <th scope="col">Prices</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $connection->prepare("SELECT * FROM services_tbl");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>".$count."</td>";
                                            echo "<td>".$row['services_name']."</td>";
                                            echo "<td>".$row['services_type']."</td>";
                                            echo "<td>".$row['price']."</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row['id'] . "'>Edit</button> ";
                                            echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $row['id'] . "'>Delete</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $count++;
                                            // Edit Modal
                                            echo "<div class='modal fade'  id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Service</h5>";
                                            echo " <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";



                                            echo "<form action='process_code/service_edit_information.php' method='POST'>";
                                            echo "<input type='hidden' name='service_id' value='" . $row['id'] . "'>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editServiceName" . $row['id'] . "'>Service Name</label>";
                                            echo "<input type='text' class='form-control' id='editServiceName" . $row['id'] . "' name='edit_service_name' value='" . $row['services_name'] . "' required>";
                                            echo "</div>";




                                            echo "<div class='form-group'>";
                                            echo "<label for='editServiceType'>Service Type</label>";
                                            echo "<select class='form-control' id='editServiceType' name='editServiceType' required>";

                                            echo "<option value='Car'" . ($row['services_type'] == 'Car' ? ' selected' : '') . ">Car</option>";
                                            echo "<option value='Motorcycle'" . ($row['services_type'] == 'Motorcycle' ? ' selected' : '') . ">Motorcycle</option>";


                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editPrice" . $row['id'] . "'>Price</label>";
                                            echo "<input type='number' class='form-control' id='editPrice" . $row['id'] . "' name='edit_price' value='" . $row['price'] . "' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editDescription" . $row['id'] . "'>Description</label>";
                                            echo "<input type='text' class='form-control' id='editDescription" . $row['id'] . "' name='edit_description' value='" . $row['description'] . "' required>";
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
                                            echo "<div class='modal fade' id='deleteModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog' role='document'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . $row['id'] . "'>Delete Service</h5>";

                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete this service?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";

                                            echo "<form action='process_code/service_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='services_id' value='" . $row['id'] . "'>";
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
            $('#services_datatable').DataTable();
        });
    </script>

</body>
</html>
