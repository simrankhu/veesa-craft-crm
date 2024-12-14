<?php
include("conn.php");

if (isset($_POST['submit'])) {
    // Fetch and sanitize input
    $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $project_start = mysqli_real_escape_string($conn, $_POST['project_start']);
    $project_end = mysqli_real_escape_string($conn, $_POST['project_end']);
    $project_status = mysqli_real_escape_string($conn, $_POST['project_status']);
    $project_url = mysqli_real_escape_string($conn, $_POST['project_url']);
    
    // Check for empty fields
    if (empty($customer_name) || empty($team_name) || empty($project_start) || empty($project_end) || empty($project_status) || empty($project_url)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (empty($_POST['id'])) {
        // Insert new record
        $insert = "INSERT INTO `project` (`customer_name`, `team_name`, `project_start`, `project_end`, `project_status`, `project_url`) 
                   VALUES ('$customer_name', '$team_name', '$project_start', '$project_end', '$project_status', '$project_url')";
        $res = mysqli_query($conn, $insert);

        if ($res) {
            header("Location: project.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Update existing record
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $update_query = "UPDATE `project` SET 
                            `customer_name`='$customer_name',
                            `team_name`='$team_name',
                            `project_start`='$project_start',
                            `project_end`='$project_end',
                            `project_status`='$project_status',
                            `project_url`='$project_url' 
                         WHERE `id`='$id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            header("Location: project.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>
