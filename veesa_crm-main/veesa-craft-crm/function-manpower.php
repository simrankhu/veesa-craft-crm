<?php
include("conn.php");

if (isset($_POST['submit'])) {
    // Fetch and sanitize input
        $name = $_POST['name'];
        $work = $_POST['work'];
        $place = $_POST['place'];
    
    if (empty($name) || empty($work) || empty($place)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (empty($_POST['id'])) {
        
        $insert ="INSERT INTO `manpower`(`name`, `work`, `place`) VALUES ('$name','$work','$place')";
        $result = mysqli_query($conn, $insert);

        if ($result) {
            header("Location: manpower-list.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Update existing record
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $update_query = "UPDATE `manpower` SET 
                            `name`='$name',
                            `work`='$work',
                            `place`='$place' WHERE `id`='$id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            header("Location: manpower-list.php");
            exit(); 
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
