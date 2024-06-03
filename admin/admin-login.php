<?php

session_start();

if (isset($_SESSION['admin-login-status'])) {
    header("location:dashboard.php");
}


require_once("../config/connect.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['login-btn'])) {

    $email = test_input($_POST['login-email']);
    $password = md5(test_input($_POST['login-password']));

    if (empty($email) || empty($password)) {

        $err_msg['err_email'] = "*Fill the email field.";
        $err_msg['err_password'] = "*Fill the password field.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        $selectSQL = "SELECT * FROM user WHERE user_email = '$email' AND user_password = '$password'";
        $resSelect = mysqli_query($conn, $selectSQL);

        if (mysqli_num_rows($resSelect) == 1) {

            $data = mysqli_fetch_assoc($resSelect);

            if ($data['user_role'] === 'admin') {
                session_start();

                $_SESSION['admin-login-status'] = true;
                $_SESSION['admin-id'] = $data['user_id'];
                $_SESSION['admin-role'] = $data['user_role'];

                header("location: dashboard.php");
            } else {

                echo "<script>alert('Something went wrong');window.location.href='admin-login.php';</script>";
            }
        } else {
            echo "<script>alert('Email and password does not match');window.location.href='admin-login.php';</script>";
        }
    }
}

?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/media.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>


    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 m-auto ">
                <section id="profile-main">
                    <form class="row g-3" name="login-form" method="post">
                        <div class="col-12">
                            <div class="sec-title">
                                <h5 class="text-center">Admin Login</h5>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="login-email">
                            <h6 id="err-login-email">
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="login-password">
                            <h6 id="err-login-password">
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <p class="text-end"><a href="../search-user.php">Forgot your password ?</a>
                            </p>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="login-btn" title="login">Login</button>
                        </div>

                        <!-- <span class="text-center form-text mt-3 ">You don't have any account ? <a href="register.php">Register
                    Now.</a></span> -->
                    </form>
                </section>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>

</body>

</html>