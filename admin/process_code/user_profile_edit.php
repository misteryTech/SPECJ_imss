<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $connection->prepare("UPDATE user_table SET firstname = ?, lastname = ?, username = ?, email = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssssi", $firstname, $lastname, $username, $email, $password, $user_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit Admin Profile');</script>";
        echo"<script>window.location.href='../admin_userprofile.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
