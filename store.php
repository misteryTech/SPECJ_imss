<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Motorcycle Brand</title>
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

        /* Card Styles */
        .card-body {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .card-title,
        .card-text {
            color: #fff;
        }

        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-img-top {
            height: 200px;
            object-fit: contain;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
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

    <?php

        include("navigation.php");
    ?>

    <!-- Product Section with Glassmorphism -->
    <section class="page-section">
        <div class="container glass-container">
            <div class="row">

                <!-- Search Products -->
                <div class="col-md-12 mb-4">
                    <h1 class="fancy-title">Explore Our Products</h1>
                    <label for="productSearch" class="form-label text-white">Search Products:</label>
                    <input type="text" id="productSearch" class="form-control" placeholder="Search for products..." onkeyup="searchProduct()">
                </div>

                <!-- Product List Section -->
                <div class="col-md-12">
                    <div class="row" id="productList">
                        <?php
                        include("process/connection.php");

                        // Fetch registered products
                        $sql = "SELECT parts_name, price, category, image_path FROM motorparts_tbl";
                        $result = $connection->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="col-md-4 mb-3 product-item" data-name="' . htmlspecialchars($row['parts_name']) . '">';
                                echo '<div class="card" style="width: 100%;">';
                                echo '<img class="card-img-top" src="admin/process_code/' . htmlspecialchars($row['image_path']) . '" alt="Card image cap">';
                                echo '<div class="card-body">';
                                echo '<h5 class="card-title">' . htmlspecialchars($row['parts_name']) . '</h5>';
                                echo '<p class="card-text">Category: ' . htmlspecialchars($row['category']) . '</p>';
                                echo '<p class="card-text">Price: ₱ ' . htmlspecialchars($row['price']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No products found.</p>';
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
    <script>
        // JavaScript function to search products by name
        function searchProduct() {
            var searchQuery = document.getElementById("productSearch").value.toLowerCase();
            var productItems = document.querySelectorAll(".product-item");

            productItems.forEach(function(item) {
                var productName = item.getAttribute("data-name").toLowerCase();

                if (productName.includes(searchQuery)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        }
    </script>

</body>

</html>
