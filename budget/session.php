<?php
if (!isset($_SESSION)) {
session_start(); 
}
include('dbcon.php');
include_once('../config/secret.php');
//Check whether the session variable SESS_MEMBER_ID is present or not
if (!isset($_SESSION['id']) || (trim($_SESSION['id']) == '')) { ?>
<script>
window.location = "../index.php";
</script>
<?php
}
$session_id=$_SESSION['id'];
$query= mysqli_query($conn,"select * from users where user_id = '$session_id'");
$row = mysqli_fetch_array($query);
$user_username = decrypt($row['username']);
$user_id=$row["user_id"];
$campus = $row['status'];
?>