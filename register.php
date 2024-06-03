<?php

session_start();

if (isset($_SESSION['login-status'])) {
    header("location:index.php");
}

require_once("./config/connect.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['reg-btn'])) {

    $name = test_input($_POST['reg-name']);
    $email = test_input($_POST['reg-email']);
    $password = md5(test_input($_POST['reg-password']));


    if (empty($name) || empty($email) || empty($password)) {

        $err_msg['err_name'] = "*Fill this name field";
        $err_msg['err_email'] = "*Fill this email field";
        $err_msg['err_password'] = "*Fill this password field";
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $err_msg['err_name'] = "*Only letters and white space allowed";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        $selectSQL = "SELECT * FROM user WHERE user_email = '$email'";
        $resSelect = mysqli_fetch_assoc(mysqli_query($conn, $selectSQL));

        if ($resSelect > 0) {

            echo "<script>alert('User already exist');window.location.href='login.php';</script>";
        } else {
            $file = null;

            if (!empty($_FILES['reg-avatar']['name'])) {

                $file = time() . "_" . str_replace(" ", "_", "$name") . "_" . $_FILES['reg-avatar']['name'];
                move_uploaded_file($_FILES['reg-avatar']['tmp_name'], "uploads/" . $file);
            }

            date_default_timezone_set("Asia/Kolkata");
            $create_date = date("y-m-d H:i:s");
            $update_date = date("y-m-d H:i:s");

            // $insertSQL = "INSERT INTO user(user_name, user_email, user_password, avatar, create_user_data, update_user_data) 
            //                 VALUES ('$name', '$email', '$password', '$file', '$create_date', '$update_date')";
            // $resInsert = mysqli_query($conn, $insertSQL);

            // if ($resInsert) {

            //     echo "<script>alert('Submit Successfull');window.location.href='login.php';</script>";
            // } else {

            //     echo "<script>alert('Submit Failed');window.location.href='register.php';</script>";
            // }
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

    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/media.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 m-auto ">
                <section id="form-sec">
                    <form class="row g-3" name="reg-form" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <div class="sec-title">
                                <h5 class="text-center">Registation Form</h5>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="reg-name">
                            <h6 id="err-reg-name">
                                <?php
                                if (isset($err_msg['err_name'])) {
                                    echo $err_msg['err_name'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="reg-email">
                            <h6 id="err-reg-email">
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Password</label>
                            <input type="text" class="form-control" name="reg-password">
                            <h6 id="err-reg-pass">
                                <?php
                                if (isset($err_msg['err_password'])) {
                                    echo $err_msg['err_password'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12 ">
                            <label class="form-label">Profile Pic</label>
                            <input class="form-control" type="file" name="reg-avatar">
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="reg-btn" title="register">Signup</button>
                        </div>

                        <span class="text-center form-text mt-3 ">Already have an account ? <a href="login.php">Login
                                Now.</a></span>
                    </form>
                </section>
            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js" type="text/javascript"></script>

</body>

</html>