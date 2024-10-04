<?php
    // Include your database connection script
    include("connection.php");

    // Check if the form is submitted via POST method
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        // Collect data from the form fields
        $firstname = $_POST["firstname"];
        $lastname = $_POST["lastname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $username = $_POST["username"];
        $password = $_POST["password"];


        // Prepare an SQL statement to insert data into the database
        $stmt = $connection->prepare("INSERT INTO customers_tbl
                (c_firstname, c_lastname, email, phone, address, username, password)
                VALUES (?, ?, ?, ?, ?, ?, ?)",);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssss", $firstname, $lastname, $email, $phone, $address, $username, $password);

        // Execute the prepared statement
        if($stmt->execute()){
            echo "<script>alert('Customer successfully registered');</script>";
            echo "<script>window.location.href = '../registration.php';</script>";
        } else {
            echo "<script>alert('Failed to register customer');</script>";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $connection->close();
    }
?>
