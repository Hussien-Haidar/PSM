<?php
include('dbcon.php');
include('session.php');

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];

    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'example@gmail.com';
    $mail->Password   = 'your password';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('72030603@students.liu.edu.lb', 'PSM - Pharmacist System Management');

    if (isset($_POST['enable_pharmacist'])) {
        mysqli_query($con, "UPDATE pharmacists set status='verified' where id='$id'");

        header("location: pharmacists.php");

        $mail->addAddress($_POST['email'], $_POST['username']);
        $mail->isHTML(true);
        $mail->Subject = 'Account is Enabled';
        $mail->Body    = "Your account has been enabled and you can use it again.";
        $mail->send();
    }

    if (isset($_POST['disable_pharmacist'])) {
        mysqli_query($con, "UPDATE pharmacists set status='disabled' where id='$id'");

        header("location: pharmacists.php");

        $mail->addAddress($_POST['email'], $_POST['username']);
        $mail->isHTML(true);
        $mail->Subject = 'Account is Disabled';
        $mail->Body    = "Your account has been disabled and you cannot use it rightnow, if you think the problem is by accident contact us.";
        $mail->send();
    }

    if (isset($_POST['delete_pharmacist'])) {
        mysqli_query($con, "DELETE FROM pharmacists where id =$id");

        header("location: pharmacists.php");

        $mail->addAddress($_POST['email'], $_POST['username']);
        $mail->isHTML(true);
        $mail->Subject = 'Account Permanently Deleted';
        $mail->Body    = "Your account has been Permanently deleted by the administration and it is no more available.";
        $mail->send();

        if ($_POST['certificate'] != '') {
            $image_path = 'img/' . $_POST['certificate'];
            unlink($image_path);
        }
    }

    if (isset($_POST['delete_admin'])) {
        mysqli_query($con, "DELETE FROM admins where id ='$id'");
        header("location: users.php");
    }

    if (isset($_POST['delete_notification'])) {
        mysqli_query($con, "DELETE FROM notifications where id ='$id'");
        header("location: notifications.php?status=sent");
    }

    if (isset($_POST['delete_request'])) {
        mysqli_query($con, "DELETE FROM requests where id ='$id'");

        $image_path = 'img/' . $_POST['certificate'];
        unlink($image_path);

        header("location: requests.php?status=rejected");
    }

    if (isset($_POST['reject_request'])) {
        mysqli_query($con, "UPDATE requests set status='rejected' where id ='$id'");

        header("location: requests.php");

        $mail->addAddress($_POST['email'], $_POST['full_name']);
        $mail->isHTML(true);
        $mail->Subject = 'Request Rejected';
        $mail->Body    = "Your request has been rejected and no account is created for you, if you think the problem is by accident contact us.";
        $mail->send();
    }

    if (isset($_POST['accept_request'])) {
        $username = $_POST['full_name'];
        $full_name = $_POST['full_name'];
        $pharmacy_name = $_POST['pharmacy_name'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $certificate = $_POST['certificate'];
        $location = $_POST['location'];
        $password = '';

        date_default_timezone_set('Asia/Beirut');
        $current_date = date('d/m/Y');
        $date = strval($current_date);

        $length = 10;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
        for ($i = 0; $i < $length; $i++) {
            $username .= $chars[rand(0, strlen($chars) - 1)];
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        mysqli_query($con, "DELETE FROM requests where id ='$id'");

        mysqli_query($con, "INSERT INTO pharmacists (username, full_name, pharmacy_name, email, phone_number, password, certificate, location, status, created_at)
        values('$username', '$full_name', '$pharmacy_name', '$email', '$phone_number', '$password', '$certificate', '$location', 'verified', '$date')");

        header("location: requests.php");

        $mail->addAddress($_POST['email'], $_POST['full_name']);
        $mail->isHTML(true);
        $mail->Subject = 'Request Accepted';
        $mail->Body    = "Your request has been Accepted and your account is created. Use the following credential:<br>
            <b>Username: </b><strong style='color: grey'>" . $username . "</strong>
            <b>Password: </b><strong style='color: grey'>" . $password . "</strong>";
        $mail->send();
    }

    if (isset($_POST['edit_and_accept_request'])) {
        $username = $_POST['full_name'];
        $full_name = $_POST['full_name'];
        $pharmacy_name = $_POST['pharmacy_name'];
        $email = $_POST['email'];
        $certificate = $_POST['certificate'];
        $phone_number = $_POST['phone_number'];
        $location = $_POST['location'];
        $password = '';

        date_default_timezone_set('Asia/Beirut');
        $current_date = date('d/m/Y');
        $date = strval($current_date);

        $length = 10;
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';
        for ($i = 0; $i < $length; $i++) {
            $username .= $chars[rand(0, strlen($chars) - 1)];
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        mysqli_query($con, "DELETE FROM requests where id ='$id'");

        mysqli_query($con, "INSERT INTO pharmacists (username, full_name, pharmacy_name, email, phone_number, password, certificate, location, status, created_at)
        values('$username', '$full_name', '$pharmacy_name', '$email', '$phone_number', '$password', '$certificate', '$location', 'verified', '$date')");

        header("location: requests.php?status=rejected");

        $mail->addAddress($_POST['email'], $_POST['full_name']);
        $mail->isHTML(true);
        $mail->Subject = 'Request Accepted After Edited';
        $mail->Body    = "Your request has been Accepted after we change some information. please use the following credential:<br>
            <b>Username: </b><strong style='color: grey'>" . $username . "</strong>
            <b>Password: </b><strong style='color: grey'>" . $password . "</strong>
            <br>
            <p style='color: red'>Note, if you want to see the edited information you can check your profile after you login to the system</p>";
        $mail->send();
    }
}
