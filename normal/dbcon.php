<?php
$conn = new mysqli('localhost','hexakjzd_delv234','Serd@rSlimani@20','hexakjzd_delv22') or die(mysqli_error());
mysqli_set_charset($conn,'utf8');
$prefix="HFM";
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
?>