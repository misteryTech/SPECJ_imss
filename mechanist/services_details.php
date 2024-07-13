<?php
    include("admin_header.php");



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
                  <label for="inputName5" class="form-label">Services Type</label>
                    <select name="services_type" id="services_type" class="form-select">
                            <option selected>Select Type Of Vehicle</option>
                            <option value="Car">Car</option>
                            <option value="Motorcycle">Motorcycle</option>

                    </select>
                </div>
                <div class="col-md-4">
                  <label for="inputEmail5" class="form-label">Services Name</label>
                  <input type="text" class="form-control" id="inputEmail5" name="services_name">
                </div>
                <div class="col-md-4">
                  <label for="inputPassword5" class="form-label">Price</label>
                  <input type="number" class="form-control" id="inputPassword5" name="price">
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
                        $stmt = $connection->prepare("SELECT * FROM services");

                        $stmt->execute();
                        $result = $stmt->get_result();
                        $row = $result->fetch_assoc();
                        $count = 1;
                        while($row = $result->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td>".$count."</td>";
                            echo "<td>".$row['services_name']."</td>";
                            echo "<td>".$row['services_type']."</td>";
                            echo "<td>".$row['price']."</td>";
                            echo "<td><a href='edit_services.php?id=".$row['id']."' class='btn btn-primary'>Edit</a>
                                    <a href='delete_services.php?id=".$row['id']."' class='btn btn-danger'>Delete</a>
                                    </td>";
                            echo "</tr>";
                            $count++;




                        }

                    ?>
   <!-- Table with hoverable rows -->
                </tbody>
              </table>
              <!-- End Table with hoverable rows -->

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

    <!-- Include jQuery and DataTables CSS/JS -->
    <script>
$(document).ready( function () {
    $('#services_datatable').DataTable();
} );

</script>