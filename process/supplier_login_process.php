<?php

    session_start();

    include("connection.php");



    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];


        $stmt = $connection->prepare("SELECT id, m_firstname,m_lastname,email FROM suppliers_tbl WHERE username = ? AND password= ?");


        $stmt->bind_param("ss",$username,$password);

        $stmt->execute();
        $stmt->store_result();


        if($stmt->num_rows == 1){

                $stmt->bind_result($id,$firstname,$lastname,$email);
                $stmt->fetch();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;

                    header("location: ../supplier/supplier_dashboard.php");
                    exit();
        }else{
              echo "Invalid Data";
                }

            $stmt->close();
            $connection->close();
    }
?>