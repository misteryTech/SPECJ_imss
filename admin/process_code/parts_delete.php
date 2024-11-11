<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $m_id = $_POST["m_id"];

            $stmt = $connection->prepare("UPDATE motorparts_tbl SET archive='1' WHERE m_id=?");
            $stmt->bind_param("i",$m_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Archive Successfully');</script>";
                echo "<script>window.location.href='../parts_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>