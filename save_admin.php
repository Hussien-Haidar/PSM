<?php
if (!isset($_SESSION)) {
    session_start();
}
include('dbcon.php');

$username = $_POST['username'];
$full_name = $_POST['full_name'];
$email = $_POST['email'];
$password = $_POST['password'];

date_default_timezone_set('Asia/Beirut');
$current_date = date('d/m/Y');
$date = strval($current_date);

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
    mysqli_query($con, "INSERT INTO admins (username, full_name, email, password, created_at)
    values ('$username', '$full_name', '$email', '$password', '$date')");

    echo 'admin_added';
}
