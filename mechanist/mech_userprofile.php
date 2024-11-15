<?php
    include("mech_header.php");
?>
<body>

    <!-- ======= Header ======= -->
    <!-- ======= Sidebar ======= -->
    <?php
        include("mech_topnav.php");
        include("mech_sidenav.php");


        $mech_id = htmlspecialchars($_SESSION['id']);
        $stmt = $connection->prepare("SELECT id, m_firstname, m_lastname, phone, address, username, password, email, registrationDate FROM mechanist_tbl WHERE id='$mech_id'");
        $stmt->execute();
        $result = $stmt->get_result();

        $mech_details = $result->fetch_assoc();

        $fullname = $mech_details['m_firstname']. ' ' . $mech_details['m_lastname'];
        $firstname = $mech_details['m_firstname'];
        $lastname = $mech_details['m_lastname'];
        $phone = $mech_details['phone'];
        $address = $mech_details['address'];
        $username = $mech_details['username'];
        $password = $mech_details['password'];
        $email = $mech_details['email'];
        $regdate = $mech_details['registrationDate'];

// Create a DateTime object from the date string
$date = new DateTime($regdate);

// Format the date to get the full month name
$monthName = $date->format('F/d/Y'); // 'F' gives the full month name
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <h2><?php echo $fullname; ?></h2>
                            <h3>Mechanist</h3>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $fullname; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $email; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Phone</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $phone; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Address</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $address; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Registration Date</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $monthName; ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Username</div>
                                        <div class="col-lg-9 col-md-8"><?php echo $username; ?></div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->
                                    <form method="POST" action="process_code/mechanist_edit_information.php">

                                            <input type="text" value="<?php echo $mech_id; ?>"  name="mechanist_id" hidden>

                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Firstname</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_firstname" type="text" class="form-control" id="fullName" value="<?php echo $firstname; ?>">
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Lastname</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_lastname" type="text" class="form-control" id="fullName" value="<?php echo $lastname; ?>">
                                            </div>
                                        </div>



                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="edit_email" type="email" class="form-control" id="email" value="<?php echo $email; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_phone" type="number" class="form-control" id="company" value="<?php echo $phone; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Job" class="col-md-4 col-lg-3 col-form-label">Address</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_address" type="text" class="form-control" id="address" value="<?php echo $address; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Country" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_username" type="text" class="form-control" id="Country" value="<?php echo $username; ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Address" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="edit_password" type="password" class="form-control" id="password" value="<?php echo $password; ?>">
                                            </div>
                                        </div>




                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php
        include("mech_footer.php");
    ?>
