<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_id = $_POST['supplier_id'];
    $supplierName = $_POST['supplierName'];
    $contactPerson = $_POST['contactPerson'];
    $email = $_POST['edit_email'];
    $phone = $_POST['edit_phone'];
    $address = $_POST['edit_address'];

    $username = $_POST['edit_username'];
    $password = $_POST['edit_password'];

    $stmt = $connection->prepare("UPDATE suppliers_tbl SET supplierName = ?, contactPerson = ?, email = ?, phone = ?, address = ?, username = ?, password = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $supplierName, $contactPerson, $email, $phone, $address, $username, $password, $supplier_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit supplier');</script>";
        echo"<script>window.location.href='../supp_userprofile.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
