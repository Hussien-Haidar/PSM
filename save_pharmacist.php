<?php
include('dbcon.php');
include('session.php');

$username = $_POST['full_name'];
$full_name = $_POST['full_name'];
$pharmacy_name = $_POST['pharmacy_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];

date_default_timezone_set('Asia/Beirut');
$current_date = date('d/m/Y');
$date = strval($current_date);

$length = 10;
$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
for ($i = 0; $i < $length; $i++) {
	$username .= $chars[rand(0, strlen($chars) - 1)];
	$password .= $chars[rand(0, strlen($chars) - 1)];
}

$exist = false;

$query = mysqli_query($con, "SELECT * FROM admins where username='$username' or email='$email'");
if (mysqli_num_rows($query) > 0) {
	$exist = true;
}

$query = mysqli_query($con, "SELECT * FROM requests where email='$email'");
if (mysqli_num_rows($query) > 0) {
	$exist = true;
}

$query = mysqli_query($con, "SELECT * FROM pharmacists where username='$username' or email='$email'");
if (mysqli_num_rows($query) > 0) {
	$exist = true;
}

if (!$exist) {
	if ($location != null) {
		$query = mysqli_query($con, "INSERT INTO PHARMACISTS
		(username, full_name, pharmacy_name, email, phone_number, password, location, status, created_at)
		VALUES
		('$username', '$full_name', '$pharmacy_name', '$email', '$phone_number', '$password', '$location', 'verified', '$date')");

		echo 'pharmacist_added';
	} else {
		echo 'empty_location';
	}
}
