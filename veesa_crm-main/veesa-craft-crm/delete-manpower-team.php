<?php



include("conn.php");


session_start();


if(isset($_GET['id']))
{
  extract($_GET);
  $sql = "delete from manpower_team where id=$id";

  $delere = $conn->query($sql);
}


header("Location: team.php");
exit();
?>
