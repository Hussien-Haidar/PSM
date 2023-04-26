<?php
include('dbcon.php');
include('session.php');

if (isset($_POST['category_id'])){
$id=$_POST['category_id'];

mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Deleted Category $id')")or die ('Error SQL query');
mysqli_query($conn,"DELETE FROM categories where cat_id =$id");

}
header("location: categories.php");
?>