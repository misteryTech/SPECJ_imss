<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $editFirstname = $_POST['edit_firstname'];
    $editLastname = $_POST['edit_lastname'];
    $edit_email = $_POST['edit_email'];
    $edit_phone = $_POST['edit_phone'];
    $edit_address = $_POST['edit_address'];
    $edit_registration_date = $_POST['edit_registration_date'];

    $stmt = $connection->prepare("UPDATE customers_tbl SET c_firstname = ?, c_lastname = ?, email =? , phone = ?, address = ?, registrationDate = ? WHERE id = ?");
    $stmt->bind_param("ssssssi", $editFirstname, $editLastname, $edit_email, $edit_phone, $edit_address, $edit_registration_date, $customer_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit Customer');</script>";
        echo"<script>window.location.href='../customer_page.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
