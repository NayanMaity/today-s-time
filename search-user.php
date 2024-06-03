<?php

require_once("./config/connect.php");


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['search-btn'])) {

    $email = test_input($_POST['search-email']);

    if (empty($email)) {
        $err_msg['err_email'] = "*Fill the email.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        $searchUser = "SELECT * FROM user WHERE user_email = '$email' AND user_show = '1'";
        $resSearch = mysqli_query($conn, $searchUser);

        if (mysqli_num_rows($resSearch) == 1) {

            $data = mysqli_fetch_assoc($resSearch);
            $token = random_int(100000, 999999);

            $updateToken = "UPDATE user SET token = '$token' WHERE user_id = '{$data['user_id']}'";
            $resToken = mysqli_query($conn, $updateToken);

            if ($resToken) {

                $user_email = $data['user_email'];
                $user_name = $data['user_name'];

                require_once("./vendor/mail/mail.php");
                require_once("./vendor/mail/re-pass.mail.php");

                sendMail($user_email, $user_name, $sub, $msg);
                header("location:reset-password.php?id=" . $data['user_id']);
            }
        } else {
            echo "<script>alert('User Not Found');window.location.href='search-user.php';</script>";
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
                        <form class="row g-3" method="post" name="search-user-form" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="sec-title text-center ">
                                    <span>Conform Your Email</span>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="search-email">
                                <h6 id="err-search-email">
                                    <?php
                                    if (isset($err_msg['err_email'])) {
                                        echo $err_msg['err_email'];
                                    }
                                    ?>
                                </h6>
                            </div>

                            <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                                <button type="submit" name="search-btn">Submit</button>
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