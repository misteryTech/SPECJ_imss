<?php
    include("connection.php");

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $parts_name = $_POST["parts_name"];
        $parts_number = $_POST["parts_number"];
        $category = $_POST["category"];
        $manufacturer = $_POST["manufacturer"];
        $price = $_POST["price"];
        $quantity_stock = $_POST["quantity_stock"];
        $supplier = $_POST["supplier"];
        $status = $_POST["condition"];
        $services_type = $_POST["services_type"];

        // Handle image upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["parts_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["parts_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.');</script>";
            echo "<script>window.location.href='../parts_page.php';</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["parts_image"]["size"] > 500000000) {
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            echo "<script>window.location.href='../parts_page.php';</script>";
            $uploadOk = 0;
        }

        // Check if everything is ok
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["parts_image"]["tmp_name"], $target_file)) {
                // Insert into database
                $stmt = $connection->prepare("INSERT INTO motorparts_tbl (parts_name, parts_number, category, manufacturer, price, QuantityInStock, supplier, services_type, status, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssdissss", $parts_name, $parts_number, $category, $manufacturer, $price, $quantity_stock, $supplier, $services_type, $status, $target_file);

                if ($stmt->execute()) {
                    echo "<script>alert('Registration Successful.');</script>";
                    echo "<script>window.location.href='../parts_page.php';</script>";
                } else {
                    echo "<script>alert('Failed to register.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    }

    $connection->close();
?>
