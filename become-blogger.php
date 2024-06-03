<?php

session_start();

if (!isset($_SESSION['login-status']) || $_SESSION['login-status'] !== TRUE) {

    header("location:login.php");
    die();
}

if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'blogger') {

    header("location:index.php");
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

$selectCate = "SELECT * FROM post_category WHERE category_show = '1'";
$resCate = mysqli_query($conn, $selectCate);

if (isset($_POST['blogger-btn'])) {

    $email = test_input($_POST['blogger-email']);
    $pass = md5(test_input($_POST['blogger-pass']));

    if (empty($email) || empty($pass)) {

        $err_msg['err_email'] = "*Fill the email field.";
        $err_msg['err_password'] = "*Fill the password field.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        $bloggerSearch = "SELECT * FROM user WHERE user_id = '$id' AND user_email = '$email' AND user_password = '$pass'";
        $resBlogger = mysqli_query($conn, $bloggerSearch);

        if (mysqli_num_rows($resBlogger) == 1) {

            date_default_timezone_set("Asia/Kolkata");
            $create_date = date("y-m-d H:i:s");
            $update_date = date("y-m-d H:i:s");

            $setNoti = "INSERT INTO notification(user_id, create_notification_data, update_notification_data)
                                VALUES ('$id', '$create_date', '$update_date')";
            $resNoti = mysqli_query($conn, $setNoti);

            if ($resNoti) {
                echo "<script>alert('Request Submit Successful.');window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Request Submit Failed.');window.location.href='become-blogger.php';</script>";
            }
        } else {
            echo "<script>alert('Incorrect email and password');window.location.href='become-blogger.php';</script>";
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

    <header id="header">
        <div class="container-xl ">

            <div class="navbar-normal">
                <a class="logo" href="index.php">Today's Time</a>


                <div class="nav-inner">
                    <ul class="navbar-nav" id="menu">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Category
                            </a>
                            <ul class="dropdown-menu">
                                <?php while ($cate = mysqli_fetch_assoc($resCate)) : ?>
                                    <li><a class="dropdown-item" href="./index.php?cate_id=<?php echo $cate['category_id']; ?>"><?php echo $cate['category_name']; ?></a></li>
                                <?php endwhile ?>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <?php if ($resUser['user_role'] == 'user') : ?>
                                <a class="nav-link active" aria-current="page" href="./become-blogger.php">Become Blogger</a>
                            <?php else : ?>
                                <a class="nav-link active" aria-current="page" href="./add-post.php">Add Blog</a>
                            <?php endif ?>
                        </li>
                    </ul>

                    <div class="nav-r">
                        <div class="avatar">
                            <a href="profile.php" class="profile">
                                <?php if ($resUser['avatar']) : ?>
                                    <img src="./uploads/<?php echo $resUser['avatar'] ?>" alt="Avatar">
                                <?php else : ?>
                                    <img src="./uploads/default_avatar.png" alt="Avatar">
                                <?php endif ?>
                            </a>
                        </div>

                        <a href="logout.php" class="logout-btn">Logout</a>

                        <button id="menu-toggle">
                            <i class="fa-solid fa-bars-staggered"></i>
                        </button>
                    </div>

                </div>
            </div>

            <nav class="mobile-nav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 mobile-menu">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Category
                        </a>
                        <ul class="dropdown-menu">
                            <?php while ($cate = mysqli_fetch_assoc($resCate)) : ?>
                                <li><a class="dropdown-item" href="./index.php?cate_id=<?php echo $cate['category_id']; ?>"><?php echo $cate['category_name']; ?></a></li>
                            <?php endwhile ?>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <?php if ($resUser['user_role'] == 'user') : ?>
                            <a class="nav-link active" aria-current="page" href="./become-blogger.php">Become Blogger</a>
                        <?php else : ?>
                            <a class="nav-link active" aria-current="page" href="./add-post.php">Add Blog</a>
                        <?php endif ?>
                    </li>

                    <li class="nav-item ">
                        <a href="logout.php" class="logout-btn">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="clearfix "></div>


    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 m-auto ">
                <section id="bloger">
                    <h3>You want's to become a blogger</h3>
                    <p>Fill this request form below</p>


                    <section id="form-sec">
                        <form class="row g-3" method="post" name="blogger-form" enctype="multipart/form-data">
                            <div class="col-12">
                                <div class="sec-title">
                                    <h5 class="text-center">Blogger Form</h5>
                                </div>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="blogger-email">
                                <h6 id="err-blogger-email">
                                    <?php
                                    if (isset($err_msg['err_email'])) {
                                        echo $err_msg['err_email'];
                                    }
                                    ?>
                                </h6>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="text" class="form-control" name="blogger-pass">
                                <p class="text-end"><a href="./search-user.php">Forgot your password ?</a>
                                </p>
                                <h6 id="err-blogger-pass">
                                    <?php
                                    if (isset($err_msg['err_pass'])) {
                                        echo $err_msg['err_pass'];
                                    }
                                    ?>
                                </h6>
                            </div>

                            <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                                <button type="submit" name="blogger-btn" title="blogger">Send Request</button>
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