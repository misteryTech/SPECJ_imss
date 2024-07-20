<?php
    include("supp_header.php");
?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("supp_topnav.php");
        include("supp_sidenav.php");
    ?>

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Supplier Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Supplier Information</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Supplier</h5>

                            <!-- Multi Columns Form -->
                            <form class="row g-3" action="process_code/supplier_registration.php" method="POST">
                                <div class="col-md-6">
                                    <label for="supplierName" class="form-label">Supplier Name</label>
                                    <input type="text" class="form-control" id="supplierName" name="supplierName" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="contactPerson" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="contactPerson" name="contactPerson" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="Username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="Password" class="form-label">Password</label>
                                    <input type="passowrd" class="form-control" id="password" name="password" required>
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
                            <h5 class="card-title">List of Suppliers</h5>
                            <table class="table table-hover" id="supplier_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Supplier Name</th>
                                        <th scope="col">Contact Person</th>
                                        <th scope="col">Phone No.</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $stmt = $connection->prepare("SELECT * FROM suppliers_tbl");
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        $count = 1;

                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>{$count}</td>";
                                            echo "<td>{$row['supplierName']}</td>";
                                            echo "<td>{$row['contactPerson']}</td>";
                                            echo "<td>{$row['phone']}</td>";
                                            echo "<td>{$row['address']}</td>";
                                            echo "<td>
                                                <button class='btn btn-primary' data-toggle='modal' data-target='#editModal{$row['id']}'>Edit</button>
                                                <button class='btn btn-danger' data-toggle='modal' data-target='#deleteModal{$row['id']}'>Delete</button>
                                            </td>";
                                            echo "</tr>";

                                            // Edit Modal
                                            echo "<div class='modal fade' id='editModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='editModalLabel{$row['id']}' aria-hidden='true'>";
                                            echo "<div class='modal-dialog'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='editModalLabel{$row['id']}'>Edit Supplier</h5>";
                                            echo "<button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<form action='process_code/supplier_edit_information.php' method='POST'>";
                                            echo "<input type='hidden' name='supplier_id' value='{$row['id']}'>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editSupplierName{$row['id']}'>Supplier Name</label>";
                                            echo "<input type='text' class='form-control' id='editSupplierName{$row['id']}' name='supplierName' value='{$row['supplierName']}' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editContactPerson{$row['id']}'>Contact Person</label>";
                                            echo "<input type='text' class='form-control' id='editContactPerson{$row['id']}' name='contactPerson' value='{$row['contactPerson']}' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editEmail{$row['id']}'>Email</label>";
                                            echo "<input type='email' class='form-control' id='editEmail{$row['id']}' name='email' value='{$row['email']}' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editPhone{$row['id']}'>Phone</label>";
                                            echo "<input type='tel' class='form-control' id='editPhone{$row['id']}' name='phone' value='{$row['phone']}' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editAddress{$row['id']}'>Address</label>";
                                            echo "<input type='text' class='form-control' id='editAddress{$row['id']}' name='address' value='{$row['address']}' required>";
                                            echo "</div>";
                                            echo "<div class='form-group'>";
                                            echo "<label for='editRegistrationDate{$row['id']}'>Registration Date</label>";
                                            echo "<input type='text' class='form-control' id='editRegistrationDate{$row['id']}' name='registrationDate' value='{$row['registrationDate']}' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editUsername{$row['id']}'>Username</label>";
                                            echo "<input type='text' class='form-control' id='editUsername{$row['id']}' name='edit_username' value='{$row['username']}' required>";
                                            echo "</div>";


                                            echo "<div class='form-group'>";
                                            echo "<label for='editPassword{$row['id']}'>Password</label>";
                                            echo "<input type='password' class='form-control' id='editPassword{$row['id']}' name='edit_password' value='{$row['password']}' required>";
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
                                            echo "<div class='modal fade' id='deleteModal{$row['id']}' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel{$row['id']}' aria-hidden='true'>";
                                            echo "<div class='modal-dialog' role='document'>";
                                            echo "<div class='modal-content'>";
                                            echo "<div class='modal-header'>";
                                            echo "<h5 class='modal-title' id='deleteModalLabel{$row['id']}'>Delete Supplier</h5>";
                                            echo "</div>";
                                            echo "<div class='modal-body'>";
                                            echo "<p>Are you sure you want to delete this supplier?</p>";
                                            echo "</div>";
                                            echo "<div class='modal-footer'>";
                                            echo "<form action='process_code/supplier_delete.php' method='POST' style='display:inline;'>";
                                            echo "<input type='hidden' name='supplier_id' value='{$row['id']}'>";
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
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
        include("supp_footer.php");
    ?>

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
        $(document).ready(function() {
            $('#supplier_datatable').DataTable();
        });
    </script>

</body>
</html>
