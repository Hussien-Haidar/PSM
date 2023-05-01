<?php
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$resetUrl = 'https://hussien300.000webhostapp.com/PSM-main/reset_password.php?email=' . urlencode($_POST['email']);

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

$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$mail->Subject = 'Reset Password';
$mail->Body = '<p>To reset your password please click on the below button:</p>
    <a href="' . $resetUrl . '" style="display: inline-block; background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Reset Password
    </a>';

if (isset($_POST["email"])) {
    $email = $_POST['email'];
    $exist = false;
    $result = mysqli_query($con, "SELECT * FROM pharmacists where email = '$email'");

    if (mysqli_num_rows($result) > 0) {
        echo 'email_found';
        $mail->send();
    } else {
        echo 'no_email_found';
    }
}
