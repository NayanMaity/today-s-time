<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$selectBlog = "SELECT post.*, user.user_name, user.user_email, post_category.category_name FROM post LEFT JOIN user 
                ON post.user_id = user.user_id LEFT JOIN post_category ON post.category_id = post_category.category_id WHERE post_show = '1'";

$resBlog = mysqli_query($conn, $selectBlog);

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
        <div class="dash-sidebar  d-flex flex-column">
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
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <div class="d-flex align-items-center justify-content-between ">
                    <h4 class="dash-view-heading">Blog</h4>

                    <a href="./add-blog.php" class="add-btn">Add Blog <i class="fa-solid fa-plus"></i></a>
                </div>

                <table class="user-view-table table-responsive-lg table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Blog Id</th>
                            <th>Blog Img</th>
                            <th>Blog Title</th>
                            <th>Blog Category</th>
                            <th>Blogger Name</th>
                            <th>Blogger Email</th>
                            <th>View</th>
                            <!-- <th>Delete</th> -->
                        </tr>
                    </thead>

                    <tbody class="manage-blog-table">
                        <?php while ($row = mysqli_fetch_assoc($resBlog)) : ?>
                            <tr>
                                <td><?php echo $row['post_id']; ?></td>

                                <td>
                                    <div class="blog-list-img">
                                        <img src="../uploads/<?php echo $row['post_image']; ?>" alt="Blog Image">
                                    </div>
                                </td>

                                <td><?php echo $row['post_title']; ?></td>

                                <td><?php echo $row['category_name']; ?></td>

                                <td><?php echo $row['user_name']; ?></td>

                                <td><?php echo $row['user_email']; ?></td>

                                <td>
                                    <a href="./view-single-blog.php?post_id=<?php echo $row['post_id']; ?>" class="table-ac-btn-1">View</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>

            </div>
        </div>
    </section>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>