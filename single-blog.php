<?php

session_start();

if (!isset($_SESSION['login-status']) || $_SESSION['login-status'] !== TRUE) {

    header("location:login.php");
    die();
}

require_once("./config/connect.php");

$id = $_SESSION['id'];

$selectUser = "SELECT * FROM user WHERE user_id = '$id'";
$resUser = mysqli_fetch_assoc(mysqli_query($conn, $selectUser));

$selectCate = "SELECT * FROM post_category";
$resCate = mysqli_query($conn, $selectCate);

$post_id = $_GET['post_id'];

$selectPost = "SELECT post.*, user.user_name, user.user_email, user.avatar, post_category.category_name FROM post LEFT JOIN user 
                ON post.user_id = user.user_id LEFT JOIN post_category ON post.category_id = post_category.category_id 
                WHERE post_id = '$post_id'";

$dataPost = mysqli_fetch_assoc(mysqli_query($conn, $selectPost));

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

                        <?php if ($resUser['user_role'] == 'user') : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./become-blogger.php">Become Blogger</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./index.php?blog_user=<?php echo $id ?>">My Blogs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="./add-post.php">Add Blog</a>
                            </li>
                        <?php endif ?>
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

                    <?php if ($resUser['user_role'] == 'user') : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./become-blogger.php">Become Blogger</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.php?blog_user=<?php echo $id ?>">My Blogs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./add-post.php">Add Blog</a>
                        </li>
                    <?php endif ?>

                    <li class="nav-item ">
                        <a href="logout.php" class="logout-btn">Logout</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="clearfix "></div>

    <!-- Start Single Blog -->
    <section id="single-blog" class="mt-5 d-flex flex-column gap-5">
        <div class="container-lg">
            <div class="sin-blog-main">
                <div class="author-info d-flex gap-2 align-items-center">
                    <div class="author-img">
                        <?php if ($dataPost['avatar']) : ?>
                            <img src="./uploads/<?php echo $dataPost['avatar']; ?>" alt="Blogger Image">
                        <?php else : ?>
                            <img src="./uploads/default_avatar.png" alt="Blogger Image">
                        <?php endif ?>
                    </div>

                    <div class="author-name d-flex flex-column ">
                        <h5><?php echo $dataPost['user_name']; ?></h5>
                        <span><?php echo $dataPost['user_email']; ?></span>
                    </div>
                </div>

                <div class="sin-blog">
                    <div class="row g-4 ">
                        <div class="col-lg-5">
                            <div class="sin-blog-img">
                                <img src="./uploads/<?php echo $dataPost['post_image']; ?>" class="img-fluid " alt="Post Image">
                            </div>
                        </div>

                        <div class="col-lg-7">
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
    </section>
    <!-- End Single Blog -->





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="./assets/js/app.js"></script>
</body>

</html>