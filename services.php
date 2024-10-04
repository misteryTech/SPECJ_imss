<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Services - Motorcycle Brand</title>
    <link rel="stylesheet" href="assets_front/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap">
    <style>
        /* Glassmorphism Effect for Container */
        .glass-container {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            padding: 20px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        /* Tab Styles */
        .nav-pills .nav-link {
            border-radius: 0;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            margin-bottom: 10px;
        }

        .nav-pills .nav-link.active {
            background-color: #f8c471;
            color: #000;
        }

        .service-content {
            background-color: rgba(255, 255, 255, 0.7);
            color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .service-description {
            margin-top: 10px;
        }

        /* Background and Layout */
        body {
            background: linear-gradient(rgba(153, 150, 151, 0.65), rgba(255, 192, 0, 0.65), rgba(255, 5, 5, 0.65)), url('assets_front/img/bg-1.png');
            background-position: center;
        }

        /* Fancy Title Styles */
        .fancy-title {
            font-family: 'Lora', serif;
            font-weight: bold;
            font-size: 3rem;
            color: #f8c471;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
            text-align: center;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>

    <div class="text-center">
        <img src="assets_front/img/logo.jpg" alt="Motorcycle Brand Logo" class="img-fluid" style="width: 500px; height: 250px; margin: 20px; padding: 10px;">
    </div>

    <?php include("navigation.php"); ?>

    <!-- Services Section with Tab Pills -->
    <section class="page-section">
        <div class="container glass-container">
            <h1 class="fancy-title">Our Services</h1>

            <div class="row">
                <div class="col-md-4">
                    <!-- Nav pills -->
                    <ul class="nav nav-pills flex-column" id="serviceTabs" role="tablist">
                        <?php
                        include("process/connection.php");

                        // Fetch registered services
                        $sql = "SELECT id, services_name FROM services_tbl";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            $isFirst = true; // For making the first tab active
                            while ($row = $result->fetch_assoc()) {
                                $activeClass = $isFirst ? 'active' : '';
                                echo '<li class="nav-item">';
                                echo '<a class="nav-link ' . $activeClass . '" id="tab-' . htmlspecialchars($row['id']) . '" data-bs-toggle="pill" href="#service-' . htmlspecialchars($row['id']) . '" role="tab">' . htmlspecialchars($row['services_name']) . '</a>';
                                echo '</li>';
                                $isFirst = false;
                            }
                        } else {
                            echo '<p>No services found.</p>';
                        }
                        ?>
                    </ul>
                </div>

                <div class="col-md-8">
                    <!-- Tab panes -->
                    <div class="tab-content" id="serviceTabContent">
                        <?php
                        $result->data_seek(0); // Reset result pointer to fetch services again
                        $isFirst = true; // For making the first tab content active

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $activeClass = $isFirst ? 'show active' : '';
                                echo '<div class="tab-pane fade ' . $activeClass . '" id="service-' . htmlspecialchars($row['id']) . '" role="tabpanel">';
                                echo '<div class="service-content">';
                                echo '<h4>' . htmlspecialchars($row['services_name']) . '</h4>';

                                // Fetch service details (description, price)
                                $sqlDetails = "SELECT description, price FROM services_tbl WHERE id=" . htmlspecialchars($row['id']);
                                $detailsResult = $connection->query($sqlDetails);

                                if ($detailsResult->num_rows > 0) {
                                    $detailsRow = $detailsResult->fetch_assoc();
                                    echo '<p class="service-description">' . htmlspecialchars($detailsRow['description']) . '</p>';
                                    echo '<p>Price: ₱ ' . htmlspecialchars($detailsRow['price']) . '</p>';
                                }

                                echo '</div>';
                                echo '</div>';

                                $isFirst = false;
                            }
                        }
                        $connection->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-center footer text-faded py-5">
        <div class="container">
            <p class="m-0 small">Copyright © SPECj 2024</p>
        </div>
    </footer>

    <script src="assets_front/bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
