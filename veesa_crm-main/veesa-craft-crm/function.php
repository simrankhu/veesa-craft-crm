<?php
include("conn.php");

if (isset($_POST['submit'])) {
    // Fetch and sanitize input
    $c_name = mysqli_real_escape_string($conn, $_POST['c_name']);
    $c_contact = mysqli_real_escape_string($conn, $_POST['c_contact']);
    $i_product = mysqli_real_escape_string($conn, $_POST['i_product']);
    $priority = mysqli_real_escape_string($conn, $_POST['priority']);
    $advance_payment = mysqli_real_escape_string($conn, $_POST['advance_payment']);
    $balance_payment = mysqli_real_escape_string($conn, $_POST['balance_payment']);
    $total_payment = mysqli_real_escape_string($conn, $_POST['total_payment']);
    $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_modes']);
    $remark = mysqli_real_escape_string($conn, $_POST['remarks']);

    
    if (empty($c_name) || empty($c_contact) || empty($i_product)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (empty($_POST['id'])) {
       
        $insert = "INSERT INTO `enquiry`(`c_name`, `c_contact`, `i_product`, `priority`, `advance_payment`, `balance_payment`, `total_payment`, `payment_mode`, `remark`) 
                    VALUES ('$c_name', '$c_contact', '$i_product', '$priority', '$advance_payment', '$balance_payment', '$total_payment', '$payment_mode', '$remark')";
        $result = mysqli_query($conn, $insert);

        if ($result) {
            header("Location: order.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Update existing record
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $update_query = "UPDATE `enquiry` SET 
                            `c_name`='$c_name',
                            `c_contact`='$c_contact',
                            `i_product`='$i_product',
                            `priority`='$priority',
                            `advance_payment`='$advance_payment',
                            `balance_payment`='$balance_payment',
                            `total_payment`='$total_payment',
                            `payment_mode`='$payment_mode',
                            `remark`='$remark' 
                         WHERE `id`='$id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            header("Location: order.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
