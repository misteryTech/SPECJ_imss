<?php
    session_start();
    session_unset();
    session_destroy();


    header("location: ../mechanist_login.php");
    exit();
?>