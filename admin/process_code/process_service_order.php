<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve customer data
    $customer_name = mysqli_real_escape_string($connection, $_POST['customerName']);
    $customer_contact = mysqli_real_escape_string($connection, $_POST['customerContact']);
    $customer_address = mysqli_real_escape_string($connection, $_POST['customerAddress']);
    
    // Retrieve selected services (from the hidden input field)
    $selected_items = json_decode($_POST['selectedItems'], true);

    // Check if there are selected items
    if (!empty($selected_items)) {
        // Example: Insert customer details into the database (assuming you have a `customers` table)
        $insert_customer_query = "INSERT INTO walk_in_customers (customer_name, contact_number, address) VALUES ('$customer_name', '$customer_contact', '$customer_address')";
        mysqli_query($connection, $insert_customer_query);
        $customer_id = mysqli_insert_id($connection); // Get the last inserted customer ID

        // Loop through selected items and insert into an orders or order_items table
        foreach ($selected_items as $item) {
            // Insert the selected services into the database (assuming you have an `orders` table)
            $insert_order_query = "INSERT INTO service (customer_id, service_name, service_price) 
                                   VALUES ('$customer_id', '{$item['name']}', '{$item['price']}')";
            mysqli_query($connection, $insert_order_query);
        }

        // Redirect or display success message
  
echo "<script>alert('Service Successfully Process.');</script>";
echo "<script>window.location.href='../walk_in_service.php';</script>";
        exit;
    } else {
        echo "No services selected!";
    }
}
?>
