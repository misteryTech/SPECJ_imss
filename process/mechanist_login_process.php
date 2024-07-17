<?php

    session_start();

    include("connection.php");



    if($_SERVER["REQUEST_METHOD"] === "POST"){

        $username = $_POST["username"];
        $password = $_POST["password"];


        $stmt = $connection->prepare("SELECT id, m_firstname,m_lastname,email FROM mechanist_tbl WHERE username = ? AND password= ?");


        $stmt->bind_param("ss",$username,$password);

        $stmt->execute();
        $stmt->store_result();


        if($stmt->num_rows == 1){

                $stmt->bind_result($id,$firstname,$lastname,$email);
                $stmt->fetch();

                    $_SESSION['loggedin'] = true;
                    $_SESSION['id'] = $id;
                    $_SESSION['m_firstname'] = $firstname;
                    $_SESSION['m_lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    $_SESSION['username'] = $username;

                    header("location: ../mechanist/mech_dashboard.php");
                    exit();
        }else{
            echo "<script>alert('Invalid Username or Password')</script>";
            echo "<script>window.location.href='../mechanist_login.php'</script>";
                }

            $stmt->close();
            $connection->close();
    }
?>