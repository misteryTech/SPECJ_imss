<?php
include("connection.php");

if (isset($_POST['accept_return'])) {
    $id = $_POST['id'];

    $stmt = $connection->prepare("UPDATE return_item_tbl SET status = 'Reject' WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../return_defective_page.php");
    } else {
        header("Location: ../return_defective_page.php");
    }
    $stmt->close();
}
$connection->close();
?>
