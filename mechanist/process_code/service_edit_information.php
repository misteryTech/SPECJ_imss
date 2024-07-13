<?php
    include("connection.php");

    if($_SERVER['REQUEST_METHOD'] === "POST"){


        $service_edit_id = $_POST["service_id"];
        $services_type_edit = $_POST["editServiceType"];
        $services_name = $_POST["edit_service_name"];
        $service_price = $_POST["edit_price"];


        $stmt = $connection->prepare("UPDATE services_tbl SET services_type=?, services_name=?, price=?
         WHERE id=?");

        $stmt->bind_param("sssi",  $services_type_edit, $services_name,$service_price,$service_edit_id);

        if($stmt->execute()){
                echo "<script>alert('Updated Successfully');</script>";
                echo "<script>window.location.href='../services_page.php'</script>";
        }else{
                echo "<script>alert('Failed to Update');</script>";
        }


        $stmt->close();


    }

    $connection->close();

?>