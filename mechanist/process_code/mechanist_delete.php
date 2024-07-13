<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $mechanist_id = $_POST["mechanist_id"];

            $stmt = $connection->prepare("DELETE FROM mechanist_tbl WHERE id=?");

            $stmt->bind_param("i",$mechanist_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Delete Successfully');</script>";
                echo "<script>window.location.href='../mechanist_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>