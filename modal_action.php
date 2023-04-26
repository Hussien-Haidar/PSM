<?php
include('dbcon.php');
include('session.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a nfuction
//It is used to send emails for specific emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['id']) && $_POST['id'] != '') {
    $id = $_POST['id'];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'example@gmail.com';                     //SMTP username
    $mail->Password   = 'your password';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('72030603@students.liu.edu.lb', 'PMS - Pharmacist Management System');

    if (isset($_POST['enable_pharmacist'])) {
        mysqli_query($con, "UPDATE pharmacists set status='verified' where id='$id'");

        $mail->addAddress($_POST['email'], $_POST['username']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Account is Enabled';
        $mail->Body    = "Your account has been enabled and you can use it again.";

        $mail->send(); //send the email

        header("location: pharmacists.php");
    }

    if (isset($_POST['disable_pharmacist'])) {
        mysqli_query($con, "UPDATE pharmacists set status='disabled' where id='$id'");

        $mail->addAddress($_POST['email'], $_POST['username']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Account is Disabled';
        $mail->Body    = "Your account has been disabled and you cannot use it rightnow, if you think the problem is by accident contact us.";

        $mail->send(); //send the email

        header("location: pharmacists.php");
    }

    if (isset($_POST['delete_pharmacist'])) {
        mysqli_query($con, "DELETE FROM pharmacists where id =$id");

        $mail->addAddress($_POST['email'], $_POST['username']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Account Permanently Deleted';
        $mail->Body    = "Your account has been Permanently deleted by the administration and it is no more available.";

        $mail->send(); //send the email

        if ($_POST['certificate'] != '') {
            $image_path = 'img/' . $_POST['certificate'];
            unlink($image_path);
        }

        header("location: pharmacists.php");
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

        $mail->addAddress($_POST['email'], $_POST['full_name']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Request Rejected';
        $mail->Body    = "Your request has been rejected and no account is created for you, if you think the problem is by accident contact us.";

        $mail->send(); //send the email

        header("location: requests.php");
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
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_';
        for ($i = 0; $i < $length; $i++) {
            $username .= $chars[rand(0, strlen($chars) - 1)];
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        mysqli_query($con, "DELETE FROM requests where id ='$id'");

        mysqli_query($con, "INSERT INTO pharmacists (username, full_name, pharmacy_name, email, phone_number, password, certificate, location, status, created_at)
        values('$username', '$full_name', '$pharmacy_name', '$email', '$phone_number', '$password', '$certificate', '$location', 'verified', '$date')");

        $mail->addAddress($_POST['email'], $_POST['full_name']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Request Accepted';
        $mail->Body    = "Your request has been Accepted and your account is created. Use username: " . $username . ", Password: " . $password . " to login to system";

        $mail->send(); //send the email

        header("location: requests.php");
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
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*_';
        for ($i = 0; $i < $length; $i++) {
            $username .= $chars[rand(0, strlen($chars) - 1)];
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }

        mysqli_query($con, "DELETE FROM requests where id ='$id'");

        mysqli_query($con, "INSERT INTO pharmacists (username, full_name, pharmacy_name, email, phone_number, password, certificate, location, status, created_at)
        values('$username', '$full_name', '$pharmacy_name', '$email', '$phone_number', '$password', '$certificate', '$location', 'verified', '$date')");

        $mail->addAddress($_POST['email'], $_POST['full_name']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Request Accepted After Rejected';
        $mail->Body    = "Your request has been Accepted after it is rejected, and your account is created. Use username: " . $username . ", Password: " . $password . " to login to system";

        $mail->send(); //send the email

        header("location: requests.php?status=rejected");
    }
}
