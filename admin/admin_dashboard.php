<?php
    include("admin_header.php");
    include("admin_topnav.php");
    include("admin_sidenav.php");


    $timestamp = time();
    $currentDate = gmdate('Y-m-d', $timestamp);

    $sql = "
    SELECT
        scheduling_services_tbl.service_date,
        scheduling_services_tbl.sched_service_id,
        scheduling_services_tbl.services_id,
        customers_tbl.c_firstname,
        customers_tbl.c_lastname,
        services_tbl.services_name,
        scheduling_services_tbl.status
    FROM
        scheduling_services_tbl
    INNER JOIN
        customers_tbl
        ON scheduling_services_tbl.customer_id = customers_tbl.id
    INNER JOIN
        services_tbl
        ON scheduling_services_tbl.services_id = services_tbl.id
    WHERE
        MONTH(scheduling_services_tbl.service_date) = MONTH(CURDATE())
    AND
        YEAR(scheduling_services_tbl.service_date) = YEAR(CURDATE())
    ORDER BY
        scheduling_services_tbl.service_date DESC
";
    $result = $connection->query($sql);



        // SQL to count scheduled services for the current month
        $sqlScheduledServices = "
        SELECT COUNT(*) AS total_scheduled
        FROM scheduling_services_tbl
        WHERE MONTH(service_date) = MONTH(CURDATE())
        AND YEAR(service_date) = YEAR(CURDATE())
    ";
    $resultScheduledServices = $connection->query($sqlScheduledServices);
    $totalScheduledServices = $resultScheduledServices->fetch_assoc()['total_scheduled'];

    // SQL to count total customers
    $sqlTotalCustomers = "
        SELECT COUNT(*) AS total_customers
        FROM customers_tbl
    ";
    $resultTotalCustomers = $connection->query($sqlTotalCustomers);
    $totalCustomers = $resultTotalCustomers->fetch_assoc()['total_customers'];

    // SQL to count total services
    $sqlTotalServices = "
        SELECT COUNT(*) AS total_services
        FROM services_tbl
    ";
    $resultTotalServices = $connection->query($sqlTotalServices);
    $totalServices = $resultTotalServices->fetch_assoc()['total_services'];



    $outofstock_count_query = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE QuantityInStock = 0");
    $outofstock_count_query->execute();
    $outofstock_count_result = $outofstock_count_query->get_result();
    $outOfStockItems = $outofstock_count_result->fetch_assoc()['count'];

    
$expired_count = $connection->prepare("SELECT COUNT(*) as count FROM motorparts_tbl WHERE date_expired = '$currentDate' ");
$expired_count->execute();
$expiredcountresulty = $expired_count->get_result();
$expired_count = $expiredcountresulty->fetch_assoc()['count'];
?>
<body>

  <!-- ======= Header ======= -->

  <!-- End Sidebar -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">


        <!-- Left side columns -->
        <div class="col-lg-8">
     <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

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
                <a href="http://localhost/SPECJ_imss/admin/services_calendar_schedule.php" >
                <div class="card-body">
                  <h5 class="card-title">Scheduled Services </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="ps-3">
                   <h6><?php echo $totalScheduledServices; ?></h6>
                    </div>
                  </div>
                </div>
                </a> 
              </div>
            </div><!-- End Sales Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
              <a href="http://localhost/SPECJ_imss/admin/customer_page.php" >
                <div class="card-body">
                <h5 class="card-title">Total Customers</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-lines-fill"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $totalCustomers; ?></h6>
                    </div>
                  </div>
                </div>
              </div>

                  </a>
            </div><!-- End Customers Card -->


            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

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
                <a href="http://localhost/SPECJ_imss/admin/services_page.php" >
                <div class="card-body">
                <h5 class="card-title">Total Services</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wrench"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $totalServices; ?></h6>

                    </div>
                  </div>
                </div>
                </a>
              </div>
              
            </div><!-- End Revenue Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

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
                <a href="http://localhost/SPECJ_imss/admin/view_stock_level.php" >
                <div class="card-body">
                <h5 class="card-title">Expired Item</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wrench"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $expired_count; ?></h6>

                    </div>
                  </div>
                </div>
                </a>
              </div>

              
            </div><!-- End Revenue Card -->


            <!-- Additional Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card out-of-stock-card">
              <a href="http://localhost/SPECJ_imss/admin/view_stock_level.php" >
                <div class="card-body">
                  <h5 class="card-title">Out of Stock </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $outOfStockItems; ?></h6>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Additional Customers Card -->
            
  </a>
          </div>
        </div><!-- End Left side columns -->


        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Sales -->
          <div class="card recent-sales overflow-auto">

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
              <h5 class="card-title">Schduled<span>| Today</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>

                 
                        <th scope="col">Customer Name</th>
                        <th scope="col">Service Date</th>
                        <th scope="col">Service Type</th>
                        <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                          <tr>


                            <td><?php echo htmlspecialchars($row['c_firstname'].''.$row['c_lastname']); ?></td>
                            <td><?php echo htmlspecialchars($row['service_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['services_name']); ?></td>
                            <td><?php if ($row['status'] == 'Request') {
                                       echo '<span class="badge bg-danger p-2" style="font-size: 1rem;">Request</span>';
                                   } elseif ($row['status'] == 'Accept') {
                                       echo '<span class="badge bg-warning p-2" style="font-size: 1rem;">Accept</span>';
                                   } elseif ($row['status'] == 'Decline') {
                                    echo '<span class="badge bg-danger p-2" style="font-size: 1rem;">Reject</span>';
                                }elseif ($row['status'] == 'Completed') {
                                  echo '<span class="badge bg-success p-2" style="font-size: 1rem;">Completed</span>';
                              }else {
                                       echo '<span class="badge p-2" style="font-size: 1.2rem;">' . htmlspecialchars($row['status']) . '</span>';
                                   }
                               ?></td>
                          </tr>
                        <?php endwhile; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6">No scheduled services found.</td>
                        </tr>
                      <?php endif; ?>
                </tbody>
              </table>

            </div>

          </div><!-- End Recent Sales -->



        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

<?php
    include("admin_footer.php");
    $connection->close();
?>
