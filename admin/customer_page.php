<?php include("admin_header.php"); ?>
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
                            <h5 class="card-title">List of Customer</h5>
                            <table class="table table-hover" id="customer_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $connection->prepare("SELECT * FROM customers_tbl");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>".$count."</td>";
                                            echo "<td>".$row['c_firstname'].' '.substr($row['c_middlename'], 0, 1).'. '.$row['c_lastname']."</td>";
                                            echo "<td>".$row['phone']."</td>";
                                            echo "<td>".$row['address']."</td>";
                                            echo "<td>";
                                            echo "<button class='btn btn-primary' data-toggle='modal' data-target='#editModal" . $row['id'] . "'>Edit</button> ";
                                            echo "<button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal" . $row['id'] . "'>Delete</button>";
                                            echo "</td>";
                                            echo "</tr>";

                                            $count++;
                                            // Edit Modal
                                            echo "<div class='modal fade' id='editModal" . $row['id'] . "' tabindex='-1' role='dialog' aria-labelledby='editModalLabel" . $row['id'] . "' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel" . $row['id'] . "'>Edit Customer</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";


                                            echo "<form action='process_code/customer_edit_information.php' method='POST'>";
                                            echo "<input type='hidden' name='customer_id' value='" . $row['id'] . "'>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='editFirstname" . $row['id'] . "'>Firstname</label>";
                                            echo "<input type='text' class='form-control' id='editFirstname" . $row['id'] . "' name='edit_firstname' value='" . $row['c_firstname'] . "' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editMiddlename" . $row['id'] . "'>Middlename</label>";
                                            echo "<input type='text' class='form-control' id='editMiddlename" . $row['id'] . "' name='edit_middlename' value='" . $row['c_middlename'] . "' required>";
                                            echo "</div>";



                                            echo "<div class='form-group'>";
                                            echo "<label for='editLastname" . $row['id'] . "'>Lastname</label>";
                                            echo "<input type='text' class='form-control' id='editLastname" . $row['id'] . "' name='edit_lastname' value='" . $row['c_lastname'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='editEmail" . $row['id'] . "'>Email</label>";
                                            echo "<input type='text' class='form-control' id='editEmail" . $row['id'] . "' name='edit_email' value='" . $row['email'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='editPhone" . $row['id'] . "'>Phone</label>";
                                            echo "<input type='number' class='form-control' id='editPhone" . $row['id'] . "' name='edit_phone' value='" . $row['phone'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='editAddress" . $row['id'] . "'>Address</label>";
                                            echo "<input type='text' class='form-control' id='editAddress" . $row['id'] . "' name='edit_address' value='" . $row['address'] . "' required>";
                                            echo "</div>";

                                            echo "<div class='form-group'>";
                                            echo "<label for='editRegistrationDate" . $row['id'] . "'>Registration Date</label>";
                                            echo "<input type='text' class='form-control' id='editRegistrationDate" . $row['id'] . "' name='edit_registration_date' value='" . $row['registrationDate'] . "' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editRegistrationDate" . $row['id'] . "'>Username</label>";
                                            echo "<input type='text' class='form-control' id='editRegistrationDate" . $row['id'] . "' name='edit_username' value='" . $row['username'] . "' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editRegistrationDate" . $row['id'] . "'>Password</label>";
                                            echo "<input type='password' class='form-control' id='editRegistrationDate" . $row['id'] . "' name='edit_password' value='" . $row['password'] . "' required>";
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
                                            echo "<h5 class='modal-title' id='deleteModalLabel" . $row['id'] . "'>Delete Customer</h5>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete this customer?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<form action='process_code/customer_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='customer_id' value='" . $row['id'] . "'>";
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
    <?php include("admin_footer.php"); ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#customer_datatable').DataTable();
        });
    </script>

</body>
</html>
