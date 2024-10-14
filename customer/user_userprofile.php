<?php
    include("user_header.php");

?>
<body>

     <!-- ======= Header ======= -->
     <!-- ======= Sidebar ======= -->
<?php
    include("user_topnav.php");
    include("user_sidenav.php");

    

    // Fetch user data from the database based on session ID using MySQLi
    $user_id = $_SESSION['id'];
    $query = "SELECT c_firstname, c_lastname, email, username, password FROM customers_tbl WHERE id = ?";
    $stmt = $connection->prepare($query); // Assuming $conn is your MySQLi connection variable
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Check if the user data was fetched successfully
    if (!$user) {
        echo "Error: User not found.";
        exit();
    }
    
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

              
              <h2><?php echo htmlspecialchars($_SESSION['c_firstname']). ' ' .  htmlspecialchars($_SESSION['c_lastname']); ?></h2>
              <h3>Customer</h3>
              
            </div>
          </div>

        </div>

        <div class="col-xl-8">

        <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Edit Profile</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <!-- Profile Edit Form -->
                                    <form action="process_code/customer_profile_edit.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['id']); ?>">

                                        <div class="row mb-3">
                                            <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="c_firstname" type="text" class="form-control" id="firstname" value="<?php echo htmlspecialchars($user['c_firstname']); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="c_lastname" type="text" class="form-control" id="lastname" value="<?php echo htmlspecialchars($user['c_lastname']); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['email']); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['username']); ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control" id="password" value="<?php echo htmlspecialchars($user['password']); ?>">
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
    include("user_footer.php");
?>