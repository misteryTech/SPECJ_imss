<?php
    include("supp_header.php");

?>
<body>

     <!-- ======= Header ======= -->
     <!-- ======= Sidebar ======= -->
<?php
    include("supp_topnav.php");
    include("supp_sidenav.php");

    $supplier_id = $_SESSION['id'];


    $sql = "
    SELECT
        rt.*,mt.m_id,mt.parts_name
    FROM
        reorders_tbl AS rt

    INNER JOIN motorparts_tbl AS mt ON mt.m_id = rt.parts_id
    WHERE rt.supplier_id = '$supplier_id'  AND rt.status= 'Delivered'
   
";
    $result = $connection->query($sql);



        // SQL to count scheduled services for the current month
        $sqlRequestItem = "
        SELECT COUNT(*) AS total_reorder_request
        FROM reorders_tbl
        WHERE supplier_id = '$supplier_id' AND status= 'Request'
    ";
    $resultRequestItem = $connection->query($sqlRequestItem);
    $totalRequestItem = $resultRequestItem->fetch_assoc()['total_reorder_request'];

    // SQL to count total customers
    $sqlTotalProduct = "
        SELECT COUNT(*) AS total_product
        FROM motorparts_tbl 
        WHERE supplier = '$supplier_id'
    ";
    $resultTotalProduct = $connection->query($sqlTotalProduct);
    $totalProduct = $resultTotalProduct->fetch_assoc()['total_product'];

    // SQL to count total services
    $sqlTotalServices = "
        SELECT COUNT(*) AS total_services
        FROM services_tbl
    ";
    $resultTotalServices = $connection->query($sqlTotalServices);
    $totalServices = $resultTotalServices->fetch_assoc()['total_services'];



    $request_return_query = $connection->prepare("SELECT COUNT(*) as count FROM return_item_tbl WHERE supplier_id = '$supplier_id'");
    $request_return_query->execute();
    $request_return_result = $request_return_query->get_result();
    $returnRequest = $request_return_result->fetch_assoc()['count'];
?>



  <!-- End Sidebar-->

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

                <a href="#" >
                <div class="card-body">
                  <h5 class="card-title">Reorder Item Request</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-calendar-check"></i>
                    </div>
                    <div class="ps-3">
                   <h6>
                    <?php echo $totalRequestItem; ?>
                  </h6>
                    </div>
                  </div>
                </div>
                </a> 
              </div>
            </div><!-- End Sales Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card">
              <a href="#" >
                <div class="card-body">
                <h5 class="card-title">Total Item</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wrench"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $totalProduct; ?></h6>
                    </div>
                  </div>
                </div>  
              </div>

                  </a>
            </div><!-- End Customers Card -->


            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

             
                <a href="#" >
                <div class="card-body">
                <h5 class="card-title">Request Return</h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-question-circle"></i>
                    </div>
                    <div class="ps-3">
                    <h6><?php echo $returnRequest; ?></h6>

                    </div>
                  </div>
                </div>
                </a>
              </div>
            </div><!-- End Revenue Card -->


   
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
              <h5 class="card-title">Schedule<span>| Deliver</span></h5>

              <table class="table table-borderless datatable">
                <thead>
                  <tr>

                 
                        <th scope="col">Parts Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Delivery Date</th>
                        <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                          <tr>


                            <td><?php echo htmlspecialchars($row['parts_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['quantity_to_reorder']); ?></td>
                            <td><?php echo htmlspecialchars($row['expected_delivery_date']); ?></td>
                            <td><?php if ($row['status'] == 'Request') {
                                       echo '<span class="badge bg-danger p-2" style="font-size: 1rem;">Request</span>';
                                   } elseif ($row['status'] == 'Accept') {
                                       echo '<span class="badge bg-warning p-2" style="font-size: 1rem;">Accept</span>';
                                   } elseif ($row['status'] == 'Reject') {
                                    echo '<span class="badge bg-danger p-2" style="font-size: 1rem;">Reject</span>';
                                }elseif ($row['status'] == 'Delivered') {
                                  echo '<span class="badge bg-success p-2" style="font-size: 1rem;">Delivered</span>';
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

  <!-- ======= Footer ======= -->
  <?php
    include("supp_footer.php");
?>