<?php
if (!isset($_SESSION)) {
	session_start();
}
include('dbcon.php');

$username = $_POST['username'];
$password = $_POST['password'];

/* Check Credentials from pharmacists table*/
$query = "SELECT * FROM pharmacists WHERE username ='$username' AND password ='$password'";
$result = mysqli_query($con, $query);

$row = mysqli_fetch_array($result);
$num_row = mysqli_num_rows($result);

if ($num_row > 0) {
	if ($row['status'] == 'verified') {
		$_SESSION['id'] = $row['id'];
		$_SESSION['username'] = $row['username'];
		$_SESSION['status'] = $row['status'];
		$_SESSION['role'] = 'pharmacist';
		$_SESSION['password'] = $row['password'];
		echo 'true_pharmacist';
	} else if ($row['status'] == 'disabled') {
		echo 'disabled_pharmacist';
	}
}

/* Check Credentials from admins table*/
$query2 = "SELECT * FROM admins WHERE username ='$username' AND password ='$password'";
$result2 = mysqli_query($con, $query2);

$row2 = mysqli_fetch_array($result2);
$num_row2 = mysqli_num_rows($result2);

if ($num_row2 > 0) {
	$_SESSION['id'] = $row2['id'];
	$_SESSION['username'] = $row2['username'];
	$_SESSION['role'] = 'admin';
	$_SESSION['password'] = $row2['password'];

	echo 'true_admin';
}
