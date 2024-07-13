<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $customer_id = $_POST["customer_id"];

            $stmt = $connection->prepare("DELETE FROM customers_tbl WHERE id=?");

            $stmt->bind_param("i",$customer_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Delete Successfully');</script>";
                echo "<script>window.location.href='../customer_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>