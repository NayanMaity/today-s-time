<?php

$sub = 'Password reset OTP';

$msg = '<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Password Reset</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
        color: #333333;
    }
    p {
        color: #666666;
    }
    .otp {
        background-color: #f8f8f8;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 20px;
    }
    .btn {
        background-color: #007bff;
        color: #ffffff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        display: inline-block;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Password Reset</h2>
    <p>Hello <span id="username">' . $user_name . '</span>,</p>
    <p>We received a request to reset your password. To proceed, please use the following one-time passcode (OTP):</p>
    <div class="otp" id="otp">' . $token . '</div>
    <p>"If you didnt request this, you can safely ignore this email. Your password will remain unchanged."</p>
    <p>If you have any questions, please contact our support team.</p>
</div>
</body>
</html>
';
