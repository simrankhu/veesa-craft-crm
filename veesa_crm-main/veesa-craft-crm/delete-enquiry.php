<?php



include("conn.php");


session_start();


if(isset($_GET['id']))
{
  extract($_GET);
  $sql = "delete from enquiry where id=$id";

  $delere = $conn->query($sql);
}


header("Location: order.php");
exit();
?>
