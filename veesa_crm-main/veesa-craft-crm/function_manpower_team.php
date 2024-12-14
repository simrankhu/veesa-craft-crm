<?php
include("conn.php");

if (isset($_POST['submit'])) {
    // Fetch and sanitize input
    $team_name = mysqli_real_escape_string($conn, $_POST['team_name']);
    $team_leader_name = mysqli_real_escape_string($conn, $_POST['team_leader_name']);
    $team_contact_num = mysqli_real_escape_string($conn, $_POST['team_contact_num']);
    
    // Check for empty fields
    if (empty($team_name) || empty($team_leader_name) || empty($team_contact_num)) {
        echo "Please fill in all required fields.";
        exit();
    }

    if (empty($_POST['id'])) {
        // Insert new record
        $insert = "INSERT INTO `manpower_team` (`team_name`, `team_leader_name`, `team_contact_num`) VALUES ('$team_name', '$team_leader_name', '$team_contact_num')";
        $res = mysqli_query($conn, $insert);

        if ($res) {
            echo "<script>window.location.href='team.php'</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // Update existing record
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $update_query = "UPDATE `manpower_team` SET 
                            `team_name`='$team_name',
                            `team_leader_name`='$team_leader_name',
                            `team_contact_num`='$team_contact_num' WHERE `id`='$id'";
        $result = mysqli_query($conn, $update_query);

        if ($result) {
            header("Location: team.php"); // Redirect to the same page for consistency
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>