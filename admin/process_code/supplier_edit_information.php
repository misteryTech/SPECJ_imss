<?php
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $supplier_id = $_POST['supplier_id'];
    $supplierName = $_POST['supplierName'];
    $contactPerson = $_POST['contactPerson'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $registrationDate = $_POST['registrationDate'];
    $edit_username = $_POST['edit_username'];
    $edit_password = $_POST['edit_password'];

    $stmt = $connection->prepare("UPDATE suppliers_tbl SET supplierName = ?, contactPerson = ?, email = ?, phone = ?, address = ?, registrationDate = ?, username = ? , password = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $supplierName, $contactPerson, $email, $phone, $address, $registrationDate, $edit_username, $edit_password, $supplier_id);

    if ($stmt->execute()) {


        echo"<script>alert('Successfully Edit supplier');</script>";
        echo"<script>window.location.href='../supplier_page.php'</script>";

    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $connection->close();
}
?>
