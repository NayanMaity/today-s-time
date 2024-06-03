<?php

use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions


function sendMail($user_email, $user_name, $sub, $msg)
{

    $mail = new PHPMailer(true);


    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'nayanmaity963@gmail.com';                     //SMTP username
    $mail->Password   = 'onqfkltczmbjggwu';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = 



    $mail->setFrom('nayanmaity963@gmail.com', 'Todays_Time');
    $mail->addAddress($user_email, $user_name);


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $sub;
    $mail->Body    = $msg;

    $mail->send();

    // echo "<script>alert('Token is send to your email.');</script>";
}
