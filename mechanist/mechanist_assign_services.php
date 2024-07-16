<?php
include("mech_header.php");
// Assuming $_SESSION['id'] contains the logged-in mechanic's ID
$mechanic_id = $_SESSION['id'];
?>

<body>

    <!-- Header and Sidebar includes -->
    <?php
    include("mech_topnav.php");
    include("mech_sidenav.php");
    ?>

    <!-- Main content -->
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
                                    // Fetch mechanics with booked services
                                    $query = "
                                        SELECT
                                            m.id,
                                            CONCAT(m.m_firstname, ' ', m.m_lastname) AS mechanist_name
                                        FROM
                                            mechanist_tbl m
                                        INNER JOIN
                                            scheduling_services_tbl ss ON m.id = ss.mechanist_id
                                        WHERE
                                            ss.status IN ('Request', 'Working', 'Reject')
                                            AND ss.mechanist_id = ?
                                        GROUP BY
                                            m.id
                                    ";
                                    $stmt = $connection->prepare($query);
                                    $stmt->bind_param('i', $mechanic_id);
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

    <!-- Footer include -->
    <?php include("mech_footer.php"); ?>

    <!-- DataTables initialization -->
    <script>
        $(document).ready(function () {
            $('#mechanics_datatable').DataTable();
        });
    </script>
