<?php

$hostName = "localhost";
$username = "root";
$password = "";
$db_name = "find medicine";

$con = mysqli_connect($hostName, $username, $password, $db_name);

if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();

mysqli_close($con);
}
?>
