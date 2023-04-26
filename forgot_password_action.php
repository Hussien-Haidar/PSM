<?php
include('dbcon.php');

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a nfuction
//It is used to send emails for specific emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
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

if (isset($_POST["email"])) {
    $email = $_POST['email'];
    $exist = false;
    $result = mysqli_query($con, "SELECT * FROM pharmacists where email = '$email'");

    if (mysqli_num_rows($result) > 0) {
        'email_found';

        //Recipients
        $mail->setFrom('72030603@students.liu.edu.lb', 'PMS - Pharmacist Management System');

        $mail->addAddress($_POST['email']);

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Reset Password';
        $mail->Body = '
        <h1>Reset Password Button</h1>
        <p>To reset your password please click on the below button:</p>
        <a href="http://www.example.com" style="display: inline-block; background-color: #007bff; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Reset Password</a>
        ';

        $mail->send();
    } else {
        echo 'no_email_found';
    }
}
