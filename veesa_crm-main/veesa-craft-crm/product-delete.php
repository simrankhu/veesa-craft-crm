<?php



include("conn.php");


session_start();


if(isset($_GET['id']))
{
  extract($_GET);
  $sql = "delete from product where id=$id";

  $delere = $conn->query($sql);
}


header("Location: our-product.php");
exit();
?>
