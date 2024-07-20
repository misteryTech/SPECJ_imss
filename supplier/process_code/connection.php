    <?php
    $localhost = "localhost";
        $username = "root";
        $password = "";
        $database = "specj_imss";


        $connection = mysqli_connect("$localhost","$username","$password","$database");


        session_start();

        if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
            header("location: ../login.php");
            exit();
        }

        ?>