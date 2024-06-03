<?php

require_once("./config/connect.php");

$id = $_GET['id'];

$err_msg = [];

if (isset($_POST['re-pass-btn'])) {

    $token = $_POST['re-token'];
    $pass = md5($_POST['re-pass']);

    if (empty($token) || empty($pass)) {
        $err_msg['err_token'] = "*Fill this Token.";
        $err_msg['err_pass'] = "*Fill this Password.";
    }

    if (count($err_msg) == 0) {

        $searchSQL = "SELECT * FROM user WHERE user_id = '$id' AND token = '$token'";
        $resSearch = mysqli_query($conn, $searchSQL);

        if (mysqli_num_rows($resSearch) == 1) {

            $data = mysqli_fetch_assoc($resSearch);

            date_default_timezone_set("Asia/Kolkata");
            $update_date = date("y-m-d H:i:s");

            $updateSQL = "UPDATE user SET token = null, user_password = '$pass', update_user_data = '$update_date' WHERE user_id = '{$data['user_id']}' AND user_show = '1'";
            $resUpdate = mysqli_query($conn, $updateSQL);

            if ($resUpdate) {
                echo "<script>alert('Password reset successfull');window.location.href='login.php';</script>";
            } else {
                echo "<script>alert('Password reset failed');window.location.href='search-user.php';</script>";
            }
        } else {
            echo "<script>alert('Token not match');window.location.href='search-user.php';</script>";
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

    <div class="clearfix "></div>

    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 m-auto ">
                <section id="bloger">
                    <section id="profile-main">
                        <form class="row g-3" method="post" name="re-pass-form" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="sec-title text-center ">
                                    <span>Reset Your Password</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Token</label>
                                <input type="text" class="form-control" name="re-token">
                                <h6 id="err-search-email">
                                    <?php
                                    if (isset($err_msg['err_token'])) {
                                        echo $err_msg['err_token'];
                                    }
                                    ?>
                                </h6>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="re-pass">
                                <h6 id="err-search-email">
                                    <?php
                                    if (isset($err_msg['err_pass'])) {
                                        echo $err_msg['err_pass'];
                                    }
                                    ?>
                                </h6>
                            </div>

                            <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                                <button type="submit" name="re-pass-btn">Reset</button>
                            </div>
                        </form>
                    </section>
                </section>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="./assets/js/app.js"></script>
</body>

</html>