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


        // Prepare an SQL statement to insert data into the database
        $stmt = $connection->prepare("INSERT INTO mechanist_tbl
                (m_firstname, m_lastname, email, phone, address)
                VALUES (?, ?, ?, ?, ?)");

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $address);

        // Execute the prepared statement
        if($stmt->execute()){
            echo "<script>alert('customer successfully registered');</script>";
            echo "<script>window.location.href = '../mechanist_page.php';</script>";
        } else {
            echo "<script>alert('Failed to register mechanist');</script>";
        }

        // Close the prepared statement and database connection
        $stmt->close();
        $connection->close();
    }
?>
