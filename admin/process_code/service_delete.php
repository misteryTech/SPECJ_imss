<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $services_id = $_POST["services_id"];

            $stmt = $connection->prepare("DELETE FROM services_tbl WHERE id=?");

            $stmt->bind_param("i",$services_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Delete Successfully');</script>";
                echo "<script>window.location.href='../services_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>