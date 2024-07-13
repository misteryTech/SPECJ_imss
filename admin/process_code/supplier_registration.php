<?php
    // Include your database connection script
    include("connection.php");

    // Check if the form is submitted via POST method
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // Collect data from the form fields
        $supplierName = $_POST["supplierName"];
        $contactPerson = $_POST["contactPerson"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $username = $_POST["username"];
        $password = $_POST["password"];


        // Prepare an SQL statement to insert data into the database
        $stmt = $connection->prepare("INSERT INTO suppliers_tbl
                (supplierName, contactPerson, email, phone, address, username, password)
                VALUES (?, ?, ?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssss", $supplierName, $contactPerson, $email, $phone, $address, $username, $password);

        // Execute the prepared statement
        if($stmt->execute()){
            echo "<script>alert('Supplier successfully registered');</script>";
            echo "<script>window.location.href = '../supplier_page.php';</script>";
        } else {
            echo "<script>alert('Failed to register supplier');</script>";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $connection->close();
    }
?>
