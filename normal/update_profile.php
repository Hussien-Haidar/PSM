<?php
include('dbcon.php');
include('session.php');
if (isset($_POST['update'])){

$name = $_POST['name'];
$phone= $_POST['phone'];
$email= $_POST['email'];
$address= $_POST['address'];
$stmt = $conn->prepare("update users set name =?, phone=?,email=?,address=? where user_id = '$user_id' ");
$stmt->bind_param("ssss",$name,$phone,$email,$address);
$stmt->execute();
//mysqli_query($conn,"update users set name ='$name', phone='$phone',email='$email',address='$address' where user_id = '$user_id' ")or die(mysqli_error());

mysqli_query($conn,"insert into activity_log (username,date,action) values('$user_username',NOW(),'Updated His Profile')");
}
?>