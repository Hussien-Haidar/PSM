<?php
include('dbcon.php');
include('session.php');

$id = $_POST['id'];
$full_name = $_POST['full_name'];
$pharmacy_name = $_POST['pharmacy_name'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];

echo $id;
echo $full_name;
echo $pharmacy_name;
echo $phone_number;
echo $location;

$query = mysqli_query($con, "UPDATE pharmacists
	set full_name='$full_name', pharmacy_name='$pharmacy_name', phone_number='$phone_number'
	, location='$location' where id='$id'");
