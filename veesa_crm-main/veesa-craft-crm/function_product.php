<?php
include("conn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    // Fetch and sanitize input
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_desc = mysqli_real_escape_string($conn, $_POST['product_desc']);
    $price = floatval($_POST['price']); // Ensure price is treated as a decimal
    $stock = intval($_POST['stock']);   // Ensure stock is treated as an integer
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];
    $uploads = "uploads/" . $image;

    // Validate empty fields
    if (empty($product_name) || empty($product_desc) || empty($price) || empty($stock)) {
        echo "Please fill in all required fields.";
        exit();
    }

    // Handle image upload
    if (!empty($image)) {
        // Move uploaded file and check for success
        if (!move_uploaded_file($temp_name, $uploads)) {
            echo "Failed to upload image.";
            exit();
        }
    }

    // Check if it's an insert or update
    if (empty($_POST['id'])) {
        // Prepare insert statement
        $stmt = $conn->prepare("INSERT INTO `product` (`product_name`, `product_desc`, `price`, `stock`, `image`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $product_name, $product_desc, $price, $stock, $image);

        // Execute and check for errors
        if ($stmt->execute()) {
            header("Location: product-list.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // Update existing record
        $id = intval($_POST['id']); // Ensure ID is an integer

        if (!empty($image)) {
            // Update record including image
            $stmt = $conn->prepare("UPDATE `product` SET `product_name`=?, `product_desc`=?, `price`=?, `stock`=?, `image`=? WHERE `id`=?");
            $stmt->bind_param("ssdisi", $product_name, $product_desc, $price, $stock, $image, $id);
        } else {
            // Update record without changing the image
            $stmt = $conn->prepare("UPDATE `product` SET `product_name`=?, `product_desc`=?, `price`=?, `stock`=? WHERE `id`=?");
            $stmt->bind_param("ssdis", $product_name, $product_desc, $price, $stock, $id);
        }

        // Execute and check for errors
        if ($stmt->execute()) {
            header("Location: product-list.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    // Close the statement
    $stmt->close();
}
?>
