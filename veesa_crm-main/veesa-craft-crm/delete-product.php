<?php



include("conn.php");


session_start();


if(isset($_GET['id']))
{
  extract($_GET);
  $sql = "delete from product where id=$id";

  $delere = $conn->query($sql);
}


header("Location: product-list.php");
exit();
?>
