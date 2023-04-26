<?php
include('dbcon.php');
include('session.php');

$destination = $_POST['destination'];
$importance = $_POST['importance'];
$title = $_POST['title'];
$body = $_POST['body'];

date_default_timezone_set('Asia/Beirut');
$current_date = date('d/m/Y');
$date = strval($current_date);

$query = mysqli_query($con, "INSERT INTO notifications (title, body, importance, destination, created_at)
values ('$title', '$body', '$importance', '$destination', '$date')");

echo 'message_sent';
