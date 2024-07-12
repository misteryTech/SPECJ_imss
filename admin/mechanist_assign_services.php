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

    <!-- Main -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Mechanic Schedule Management</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Booked Service Vehicles</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Mechanics</h5>
                            <table class="table table-hover" id="mechanics_datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Mechanic Name</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch all mechanics
                                    $query = "SELECT id, CONCAT(m_firstname, ' ', m_lastname) AS mechanist_name FROM mechanist_tbl";
                                    $stmt = $connection->prepare($query);
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $count = 1;

                                    // Loop through the results and display the mechanics in a table
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($count) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['mechanist_name']) . "</td>";
                                        echo "<td>";
                                        echo "<a class='btn btn-primary' href='mechanic_list_of_services.php?mechanist_id=" . htmlspecialchars($row['id']) . "'>View Booked Services</a>";
                                        echo "</td>";
                                        echo "</tr>";

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
    include("admin_footer.php");
    ?>

    <script>
        $(document).ready(function () {
            $('#mechanics_datatable').DataTable();
        });
    </script>
</body>
</html>
