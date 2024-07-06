<?php

    include("connection.php");

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $services_type = $_POST["services_type"];
        $services_name = $_POST["services_name"];
        $services_price = $_POST["price"];



        $stmt = $connection->prepare("INSERT INTO services_tbl(services_type,services_name,price)
                VALUES (?,?,?)");

        $stmt->bind_param("sss",$services_type,$services_name,$services_price);


        if($stmt->execute()){
            echo "<script>alert('Successfully Registered');</script>";
           echo "<script>window.location.href='../services_page.php'</script>";
        }else{
            echo "<script>alert('Failed To Register);</script>";
        }

        $stmt->close();
        $connection->close();
    }
    ?>