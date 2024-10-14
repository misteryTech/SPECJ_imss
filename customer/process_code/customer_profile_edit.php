<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $c_firstname = $_POST['c_firstname'];
    $c_lastname = $_POST['c_lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $connection->prepare("UPDATE customers_tbl SET c_firstname = ?, c_lastname = ?, username = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $c_firstname, $c_lastname, $username, $email, $password, $user_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit User Profile');</script>";
        echo"<script>window.location.href='../user_userprofile.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
