<?php
include("connection.php"); // Assuming you have a config file for database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $motorparts_id = $_POST['m_id'];

    // Prepare and execute delete statement
    $sql = "DELETE FROM motorparts_tbl WHERE m_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $motorparts_id);

    if ($stmt->execute()) {

        echo"<script>alert('Successfully Delete Parts');</script>";
        echo"<script>window.location.href='../parts_page.php'</script>";
    } else {
        // Error occurred
        header("Location: your_page.php?message=error");
    }

    $stmt->close();
    $connection->close();
}
?>
