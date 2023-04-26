<?php
include('header.php');
include('dbcon.php');

if (!isset($_SESSION)) {
    session_start();
}

$full_name = $_POST['full_name'];
$pharmacy_name = $_POST['pharmacy_name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$location = $_POST['location'];

date_default_timezone_set('Asia/Beirut');
$current_date = date('d/m/Y');
$date = strval($current_date);

$certificate = $_FILES['certificate']['name'];
$tmp_img_name = $_FILES['certificate']['tmp_name'];
$folder = "img/";

$exist = false;

$check_query = mysqli_query($con, "SELECT * FROM requests WHERE email='$email'");
if (mysqli_num_rows($check_query) > 0) {
    $exist = true;
}

// Check admins table
$check_query = mysqli_query($con, "SELECT * FROM admins WHERE email='$email'");
if (mysqli_num_rows($check_query) > 0) {
    $exist = true;
}

// Check pharmacists table
$check_query = mysqli_query($con, "SELECT * FROM pharmacists WHERE email='$email'");
if (mysqli_num_rows($check_query) > 0) {
    $exist = true;
}

if (!$exist) {
    $result = mysqli_query($con, "INSERT INTO requests (full_name, pharmacy_name, email, phone_number, certificate, location, status, created_at)
    values ('$full_name', '$pharmacy_name', '$email', '$phone_number', '$certificate', '$location', 'active', '$date')");

    if (move_uploaded_file($tmp_img_name, $folder . $certificate)) {

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['certificate']['name']);
    }

    if ($result) { ?>
        <b style="padding-left: 20px; font-size: 20px;" class="text-info">Your request has been sent successfully to the administration, please wait to review
            the information you provided, when we are done you will get email notification holding your
            username and password if accepted
        </b>;
    <?php }
} else { ?>
    <b style="padding-left: 20px; font-size: 20px;" class="text-warning">The email you entered is already exists</b>
<?php }
