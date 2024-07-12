<?php

    include("connection.php");


    if($_SERVER["REQUEST_METHOD"] === "POST"){

            $parts_id = $_POST["parts_id"];
            $stmt = $connection->prepare("DELETE FROM motorparts_tbl WHERE m_id=?");
            $stmt->bind_param("i",$parts_id);

            $stmt->execute();


            if($stmt->affected_rows > 0){
                echo "<script>alert('Delete Successfully');</script>";
                echo "<script>window.location.href='../parts_page.php'</script>";
            }else{
                echo "<script>alert('Failed to Update');</script>";
            }

            $stmt->close();
    }
    $connection->close();

?>