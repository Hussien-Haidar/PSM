<?php
if (!isset($_SESSION)) {
    session_start();
}
include('dbcon.php');

$id_pharmacist = $_SESSION['id'];
$name = $_POST['name'];
$amount = $_POST['amount'];

date_default_timezone_set('Asia/Beirut');
$current_date = date('d/m/Y');
$date = strval($current_date);

$exist = false;

$query = mysqli_query($con, "SELECT * FROM medicines where id_pharmacist ='$id_pharmacist' and name='$name'");
if (mysqli_num_rows($query) > 0) {
    $exist = true;
}

if (!$exist) {
    mysqli_query($con, "INSERT INTO medicines (name, amount, id_pharmacist, created_at)
    values ('$name', '$amount', '$id_pharmacist', '$date')");

    echo 'medicine_added';
}
