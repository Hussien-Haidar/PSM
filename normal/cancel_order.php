<?php
include('dbcon.php');
include('session.php');

$id=$_GET["id"];

mysqli_query($conn,"update orders set status='canceled' where order_id ='$id'");
mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Cancel Order $id')");

header("location: orders.php?status=canceled");
?>