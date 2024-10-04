<?php
    include("user_header.php");

?>
<body>

     <!-- ======= Header ======= -->
     <!-- ======= Sidebar ======= -->
<?php
    include("user_topnav.php");
    include("user_sidenav.php");

       // SQL query to fetch services and prices
       $serviceSql = "
       SELECT
           services_tbl.services_name,
           services_tbl.price
       FROM
           services_tbl
       ORDER BY
           services_tbl.id DESC
    "; // Adjust limit as needed

       $serviceResult = $connection->query($serviceSql);
?>



  <!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="user_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">


            <!-- Reports -->
            <div class="col-12">
            <div class="card">
            <div class="card-body">
              <!-- Slides with fade transition -->
              <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="../assets_front/img/shop.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../assets_front/img/shop1.jpg" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="../assets_front/img/shop2.jpg" class="d-block w-100" alt="...">
                  </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>

              </div><!-- End Slides with fade transition -->

            </div>
          </div>
            </div><!-- End Reports -->



          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

<div class="card">
  <div class="filter">
    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
      <li class="dropdown-header text-start">
        <h6>Filter</h6>
      </li>
      <li><a class="dropdown-item" href="#">Today</a></li>
      <li><a class="dropdown-item" href="#">This Month</a></li>
      <li><a class="dropdown-item" href="#">This Year</a></li>
    </ul>
  </div>

  <div class="card-body">
    <h5 class="card-title">Services Offered</h5>

    <ul class="list-group">
      <!-- Fetch services and prices dynamically -->
      <?php if ($serviceResult->num_rows > 0): ?>
          <?php while ($serviceRow = $serviceResult->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo htmlspecialchars($serviceRow['services_name']); ?>
              <span class="badge bg-primary rounded-pill">₱<?php echo htmlspecialchars($serviceRow['price']); ?></span>
            </li>
          <?php endwhile; ?>
      <?php else: ?>
        <li class="list-group-item">No recent services found.</li>
      <?php endif; ?>
    </ul>

  </div>
</div><!-- End Recent Services Card -->

</div><!-- End Right side columns -->


</div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <?php
    include("user_footer.php");
?>