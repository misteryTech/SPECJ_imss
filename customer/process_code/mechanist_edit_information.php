<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mechanist_id = $_POST['mechanist_id'];
    $editFirstname = $_POST['edit_firstname'];
    $editLastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];
    $edit_phone = $_POST['edit_phone'];
    $edit_address = $_POST['edit_address'];
    $edit_registration_date = $_POST['edit_registration_date'];
    $edit_username = $_POST['edit_username'];
    $edit_password = $_POST['edit_password'];

    $stmt = $connection->prepare("UPDATE mechanist_tbl SET m_firstname = ?, m_lastname = ?, email =? , phone = ?, address = ?, registrationDate = ?, username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $editFirstname, $editLastname, $edit_email, $edit_phone, $edit_address, $edit_registration_date, $edit_username, $edit_password, $mechanist_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit Mechanist');</script>";
        echo"<script>window.location.href='../mechanist_page.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
