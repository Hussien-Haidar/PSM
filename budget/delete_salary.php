<?php
include('dbcon.php');
include('session.php');

if (isset($_POST['salary_id'])){
$id=$_POST['salary_id'];

mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Deleted Salary $id')")or die ('Error SQL query');
mysqli_query($conn,"DELETE FROM salaries where emp_id =$id");

}
header("location: salaries.php");
?>