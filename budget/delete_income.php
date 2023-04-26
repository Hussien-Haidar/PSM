<?php
include('dbcon.php');
include('session.php');

if (isset($_POST['income_id'])){
$id=$_POST['income_id'];

mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Deleted Income $id')")or die ('Error SQL query');
mysqli_query($conn,"DELETE FROM incomes where income_id =$id");

}
header("location: incomes.php");
?>