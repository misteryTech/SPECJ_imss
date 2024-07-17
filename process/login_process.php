<?php

    session_start();

    include("connection.php");



    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];


        $stmt = $connection->prepare("SELECT id, c_firstname,c_lastname,email FROM customers_tbl WHERE username = ? AND password= ?");


        $stmt->bind_param("ss",$username,$password);

        $stmt->execute();
        $stmt->store_result();


        if($stmt->num_rows == 1){

                $stmt->bind_result($id,$firstname,$lastname,$email);
                $stmt->fetch();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['c_firstname'] = $firstname;
                    $_SESSION['c_lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;

                    header("location: ../customer/user_dashboard.php");
                    exit();
        }else{
            echo "<script>alert('Invalid Username or Password')</script>";
            echo "<script>window.location.href='../login.php'</script>";
                }

            $stmt->close();
            $connection->close();
    }
?>