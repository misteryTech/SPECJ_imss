<?php

    session_start();

    include("connection.php");



    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];


        $stmt = $connection->prepare("SELECT id, firstname,lastname,email FROM user_table WHERE username = ? AND password= ?");


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
                    $_SESSION['password'] = $username;

                    header("location: ../admin/admin_dashboard.php");
                    exit();
        }else{
            echo "<script>alert('Invalid Username or Password')</script>";
            echo "<script>window.location.href='../admin_login.php'</script>";
                }

            $stmt->close();
            $connection->close();
    }
?>