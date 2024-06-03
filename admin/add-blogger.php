<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];


if (isset($_POST['add-blogger-btn'])) {

    $email = test_input($_POST['email']);

    if (empty($email)) {

        $err_msg['err_email'] = "*Fill the email field.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        $serachUser = "SELECT * FROM user WHERE user_email = '$email' AND user_role != 'admin'";
        $resSearch = mysqli_query($conn, $serachUser);

        $data = mysqli_fetch_assoc($resSearch);

        if (mysqli_num_rows($resSearch) == 1) {

            if ($data['user_role'] == 'blogger') {
                echo "<script>alert('" . $email . " is already a blogger');window.location.href='add-blogger.php';</script>";
            } else {

                date_default_timezone_set("Asia/Kolkata");
                $update_date = date("y-m-d H:i:s");

                $updateSQl = "UPDATE user SET user_role = 'blogger', update_user_data = '$update_date' WHERE user_id = '{$data['user_id']}' AND user_email = '$email'";
                $resUpdate = mysqli_query($conn, $updateSQl);

                if ($resUpdate) {
                    echo "<script>alert('Add blogger Successfull');window.location.href='manage-blogger.php';</script>";
                } else {
                    echo "<script>alert('Add blogger Failed');window.location.href='add-blogger.php';</script>";
                }
            }
        } else {
            echo "<script>alert('User not found');window.location.href='add-blogger.php';</script>";
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

    <section id="dash-main" class="d-flex ">
        <div class="dash-sidebar d-flex flex-column">
            <div class="dash-logo">
                <a href="./dashboard.php">Today's Time</a>
                <button id="dash-sidebar-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="dash-side-menu">
                <ul class="p-0 m-0 ">
                    <li>
                        <a href="./dashboard.php"><i class="fa-solid fa-gauge-high"></i> Dashboard</a>
                    </li>

                    <li>
                        <a href="./manage-user.php"><i class="fa-solid fa-users"></i> Users</a>
                    </li>

                    <li>
                        <a href="./manage-blog.php"><i class="fa-solid fa-file-signature"></i> Blogs</a>
                    </li>

                    <li>
                        <a href="./manage-category.php"><i class="fa-solid fa-list"></i> Categories</a>
                    </li>

                    <li>
                        <a href="./manage-blogger.php"><i class="fa-solid fa-user-pen"></i> Bloggers</a>
                    </li>
                </ul>
            </div>

            <div class="dash-logout text-center ">
                <a href="./admin-logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>

        </div>

        <div class="dash-view">
            <div class="dash-view-top sticky-top ">
                <header class="dash-view-header d-flex align-items-center justify-content-between">
                    <div class="dash-v-header-l">
                        <button id="dash-side-toggle"><i class="fa-solid fa-bars"></i></button>

                        <a href="./admin-profile.php" class="dash-head-link">Profile</a>
                    </div>

                    <div class="dash-v-header-r d-flex align-items-center gap-2">
                        <div class="dash-head-text">
                            <h5>Hi, <span><?php echo $resSerAdmin['user_name']; ?></span></h5>
                        </div>

                        <div class="dash-head-img">
                            <?php if ($resSerAdmin['avatar']) : ?>
                                <img src="../uploads/<?php echo $resSerAdmin['avatar']; ?>" alt="Avatar">
                            <?php else : ?>
                                <img src="../uploads/default_avatar.png" alt="Avatar">
                            <?php endif ?>
                        </div>
                    </div>
                </header>

                <div class="dash-bread">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 ">
                            <li class="breadcrumb-item"><a href="./dashboard.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="./manage-blogger.php">Blogger</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Blogger</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Add Blogger</h4>

                <section id="profile-main">
                    <form class="row g-3" name="add-blogger" method="post">
                        <div class="col-12">
                            <label class="form-label">User Email</label>
                            <input type="text" class="form-control" name="email">
                            <h6 id="err-user-email">
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="add-blogger-btn">Add</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>