<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $m_id = $_POST["m_id"];
    $edit_parts_name = $_POST["edit_parts_name"];
    $edit_parts_number = $_POST["edit_parts_number"];
    $edit_category = $_POST["edit_category"];
    $edit_manufacturer = $_POST["edit_manufacturer"];
    $edit_price = $_POST["edit_price"];
    $edit_quantity_stock = $_POST["edit_quantity_stock"];
    $edit_supplier = $_POST["edit_supplier"];
    $status = $_POST["edit_condition"];
    $edit_services_type = $_POST["edit_services_type"];

    // Handle image upload
    if ($_FILES['new_image']['name']) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["new_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "<script>alert('Sorry, file already exists.');</script>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["new_image"]["size"] > 500000) {
            echo "<script>alert('Sorry, your file is too large.');</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "<script>alert('Sorry, your file was not uploaded.');</script>";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file)) {
                // Update database with new image path
                $stmt = $connection->prepare("UPDATE motorparts_tbl SET parts_name=?, parts_number=?, category=?, manufacturer=?, price=?, QuantityInStock=?, supplier=?, services_type=?, status=?, image_path=? WHERE m_id=?");
                $stmt->bind_param("ssssdissssi", $edit_parts_name, $edit_parts_number, $edit_category, $edit_manufacturer, $edit_price, $edit_quantity_stock, $edit_supplier, $edit_services_type, $status, $target_file, $m_id);
                if ($stmt->execute()) {
                    echo "<script>alert('Updated Successfully.');</script>";
                    echo "<script>window.location.href='../parts_page.php';</script>";
                } else {
                    echo "<script>alert('Failed to Update.');</script>";
                }
                $stmt->close();
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
            }
        }
    } else {
        // Update without changing the image
        $stmt = $connection->prepare("UPDATE motorparts_tbl SET parts_name=?, parts_number=?, category=?, manufacturer=?, price=?, QuantityInStock=?, supplier=?, services_type=?, status=? WHERE m_id=?");
        $stmt->bind_param("ssssdisssi", $edit_parts_name, $edit_parts_number, $edit_category, $edit_manufacturer, $edit_price, $edit_quantity_stock, $edit_supplier, $edit_services_type, $status, $m_id);
        if ($stmt->execute()) {
            echo "<script>alert('Updated Successfully.');</script>";
            echo "<script>window.location.href='../parts_page.php';</script>";
        } else {
            echo "<script>alert('Failed to Update.');</script>";
        }
        $stmt->close();
    }
}

$connection->close();
?>
