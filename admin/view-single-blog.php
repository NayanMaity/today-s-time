<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$post_id = $_GET['post_id'];

$selectBlog = "SELECT post.*, user.user_name, user.user_email, user.avatar, post_category.category_name FROM post LEFT JOIN user 
                ON post.user_id = user.user_id LEFT JOIN post_category ON post.category_id = post_category.category_id 
                WHERE post_id = '$post_id' AND post_show = '1'";

$resBlog = mysqli_query($conn, $selectBlog);

$dataPost = mysqli_fetch_assoc($resBlog);
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
                            <li class="breadcrumb-item active" aria-current="page">Single Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4 class="dash-view-heading">Single Blog</h4>

                    <div class="">
                        <a href="./edit-blog.php?post_id=<?php echo $dataPost['post_id']; ?>" class="table-ac-btn-1">Edit</a>
                        <a href="./delete-blog.php?post_id=<?php echo $dataPost['post_id']; ?>" class="table-ac-btn-2">Remove</a>
                    </div>
                </div>

                <div class="sin-blog-main">
                    <div class="author-info d-flex gap-2 align-items-center">
                        <div class="author-img">
                            <?php if ($dataPost['avatar']) : ?>
                                <img src="../uploads/<?php echo $dataPost['avatar']; ?>" alt="Blogger Image">
                            <?php else : ?>
                                <img src="../uploads/default_avatar.png" alt="Blogger Image">
                            <?php endif ?>
                        </div>

                        <div class="author-name d-flex flex-column ">
                            <h5><?php echo $dataPost['user_name']; ?></h5>
                            <span><?php echo $dataPost['user_email']; ?></span>
                        </div>
                    </div>

                    <div class="sin-blog">
                        <div class="row g-4 ">
                            <div class="col-5">
                                <div class="sin-blog-img">
                                    <img src="../uploads/<?php echo $dataPost['post_image']; ?>" class="img-fluid " alt="Post Image">
                                </div>
                            </div>

                            <div class="col-7">
                                <div class="sin-blog-title">
                                    <h3><?php echo $dataPost['post_title']; ?></h3>
                                </div>

                                <h5 class="sin-blog-date">Posted on <span><?php echo $dataPost['update_post_data']; ?></span></h5>
                                <h5 class="sin-blog-date">Category <span><?php echo $dataPost['category_name']; ?></span></h5>

                                <p class="sin-blog-para"><?php echo $dataPost['post_desc']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>