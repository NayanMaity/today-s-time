<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$id = $_SESSION['admin-id'];

$selectUser = "SELECT * FROM user WHERE user_id = '$id'";
$data = mysqli_fetch_assoc(mysqli_query($conn, $selectUser));

$selectCate = "SELECT * FROM post_category WHERE category_show = '1'";
$resCate = mysqli_fetch_all(mysqli_query($conn, $selectCate), MYSQLI_ASSOC);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['add-blog-btn'])) {

    $title = test_input($_POST['blog-title']);
    $desc = test_input($_POST['blog-desc']);
    $cate = $_POST['blog-cate'];

    $id = $_SESSION['admin-id'];

    // $img = $_FILES['blog-img']['name'];

    if (empty($title) || empty($desc) || empty($cate) || empty($_FILES['blog-img']['name'])) {

        $err_msg['err_title'] = "*Fill this blog title.";
        $err_msg['err_desc'] = "*Fill this blog description.";
        $err_msg['err_cate'] = "*Select the blog category.";
        $err_msg['err_img'] = "*Select the blog image.";
    }

    if (count($err_msg) == 0) {

        $img = time() . "_" . "$cate" . "_" . "blog" . "_" . "{$data['user_name']}" . "_" . $_FILES['blog-img']['name'];
        move_uploaded_file($_FILES['blog-img']['tmp_name'], "../uploads/" . $img);

        date_default_timezone_set("Asia/Kolkata");

        $create_date = date("y-m-d H:i:s");
        $update_date = date("y-m-d H:i:s");

        $insertBlog = "INSERT INTO post(post_title, post_desc, post_image, category_id, user_id, create_post_data, update_post_data)
                        VALUES('$title', '$desc', '$img', '$cate', '$id', '$create_date', '$update_date')";

        $resBlog = mysqli_query($conn, $insertBlog);

        if ($resBlog) {
            echo "<script>alert('Add Blog Successfull');window.location.href='manage-blog.php';</script>";
        } else {
            echo "<script>alert('Add Blog Failed');window.location.href='add-blog.php';</script>";
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
                            <h5>Hi, <span>
                                    <?php echo $resSerAdmin['user_name']; ?>
                                </span></h5>
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
                            <li class="breadcrumb-item"><a href="./manage-blog.php">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Add Blog</h4>

                <section id="profile-main">
                    <form class="row g-3" name="add-blog-form" method="post" enctype="multipart/form-data">
                        <div class="col-12 ">
                            <label class="form-label">Blog Image</label>
                            <input class="form-control" type="file" name="blog-img">
                            <h6>
                                <?php
                                if (isset($err_msg['err_img'])) {
                                    echo $err_msg['err_img'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Blog Title</label>
                            <input type="text" class="form-control" name="blog-title">
                            <h6>
                                <?php
                                if (isset($err_msg['err_title'])) {
                                    echo $err_msg['err_title'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Blog Category</label>
                            <select class="form-select" name="blog-cate">
                                <option selected>Open this select menu</option>
                                <?php foreach ($resCate as $c) : ?>
                                    <option value="<?php echo $c['category_id'] ?>"><?php echo $c['category_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                            <h6>
                                <?php
                                if (isset($err_msg['err_cate'])) {
                                    echo $err_msg['err_cate'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="blog-desc" cols="30" rows="10" class="form-control"></textarea>
                            <h6>
                                <?php
                                if (isset($err_msg['err_desc'])) {
                                    echo $err_msg['err_desc'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="add-blog-btn">Add</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>