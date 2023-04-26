<?php
include('dbcon.php');
include('session.php');

if (isset($_POST['order_id'])){
	
	$id=$_POST['order_id'];
	mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Deleted Order $id')")or die ('Error SQL query');
	mysqli_query($conn,"DELETE FROM orders where order_id =$id");
	//mysqli_query($conn,"DELETE FROM payment_check where student_id ='$id[$i]'");
}
header("location: orders.php?");
?>