<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $supplier_id = $_POST["supplier_id"];

            $stmt = $connection->prepare("DELETE FROM suppliers_tbl WHERE id=?");

            $stmt->bind_param("i",$supplier_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Delete Successfully');</script>";
                echo "<script>window.location.href='../supplier_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>