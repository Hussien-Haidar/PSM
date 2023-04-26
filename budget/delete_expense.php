<?php
include('dbcon.php');
include('session.php');

if (isset($_POST['expense_id'])){
$id=$_POST['expense_id'];
mysqli_query($conn,"DELETE FROM expenses where expense_id =$id");
mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Deleted Expense $id')")or die ('Error SQL query');


}
header("location: expenses.php");
?>