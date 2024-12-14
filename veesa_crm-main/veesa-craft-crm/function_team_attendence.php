<?php
include("conn.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);


if (isset($_POST['submit'])) {
    // Fetch and sanitize input
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $member_name = mysqli_real_escape_string($conn, $_POST['member_name']);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    // Check for empty fields
    if (empty($team_name) || empty($member_name) || empty($post) || empty($date) || empty($status)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (empty($_POST['id'])) {
        // Insert new record
        $insert = "INSERT INTO `manpower_team_attendence` (`team_name`, `member_name`, `post`, `date`, `status`) 
                   VALUES ('$team_name', '$member_name', '$post', '$date', '$status')";
        $res = mysqli_query($conn, $insert);

        if ($res) {
            header("Location: our-product.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Update existing record
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $update_query = "UPDATE `manpower_team_attendence` SET 
                            `team_name`='$team_name',
                            `member_name`='$member_name',
                            `post`='$post',
                            `date`='$date',
                            `status`='$status'
                         WHERE `id`='$id'"; // Removed extra comma here
                         
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            header("Location: our-product.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
