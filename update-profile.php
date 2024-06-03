<?php

session_start();

if (!isset($_SESSION['login-status']) || $_SESSION['login-status'] !== TRUE) {

    header("location:login.php");
    die();
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

$id = $_SESSION['id'];

$selectUser = "SELECT * FROM user WHERE user_id = '$id'";
$resUser = mysqli_fetch_assoc(mysqli_query($conn, $selectUser));


if (isset($_POST['update-btn'])) {

    $name = test_input($_POST['update-name']);
    $email = test_input($_POST['update-email']);

    $file = $resUser['avatar'];


    if (empty($name) || empty($email)) {

        $err_msg['err_name'] = "*Fill this name field";
        $err_msg['err_email'] = "*Fill this email field";
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $err_msg['err_name'] = "*Only letters and white space allowed";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        if (!empty($_FILES['update-file']['name'])) {

            if ($file !== null) {
                unlink("../uploads/" . $file);
            }
            $file = time() . "_" . str_replace(" ", "_", "$name") . "_" . $_FILES['update-file']['name'];
            move_uploaded_file($_FILES['update-file']['tmp_name'], "uploads/" . $file);
        }

        $update_date = date("y-m-d H:i:s");

        $updateSQL = "UPDATE user SET user_name='$name', user_email='$email', avatar='$file', update_user_data='$update_date' 
                      WHERE user_id = '$id'";

        $resUpdate = mysqli_query($conn, $updateSQL);

        if ($resUpdate) {
            echo "<script>alert('Edit Successfull');window.location.href='profile.php';</script>";
        } else {
            echo "<script>alert('Edit Failed');window.location.href='profile.php';</script>";
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
                <section id="profile-main">


                    <form class="row g-3" name="update-profile-form" enctype="multipart/form-data" method="post">
                        <div class="col-12">
                            <div class="sec-title">
                                <h5 class="text-center">Update Profile</h5>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="profile-img">
                                <?php if ($resUser['avatar']) : ?>
                                    <img src="./uploads/<?php echo $resUser['avatar'] ?>" alt="Avatar">
                                <?php else : ?>
                                    <img src="./uploads/default_avatar.png" alt="Avatar">
                                <?php endif ?>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="update-name" value="<?php echo $resUser['user_name'] ?>">
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
                            <input type="text" class="form-control" name="update-email" value="<?php echo $resUser['user_email'] ?>">
                            <h6 id="err-reg-email">
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12 ">
                            <label for="formFile" class="form-label">Profile Pic</label>
                            <input class="form-control" type="file" name="update-file" id="formFile">
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="update-btn">Update</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/app.js" type="text/javascript"></script>

</body>

</html>