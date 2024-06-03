<?php

session_start();

if (!isset($_SESSION['login-status']) || $_SESSION['login-status'] !== TRUE) {

    header("location:login.php");
    die();
}

if ($_SESSION['role'] == 'user') {

    header("location:index.php");
    die();
}

require_once("./config/connect.php");

$id = $_SESSION['id'];

$selectUser = "SELECT * FROM user WHERE user_id = '$id'";
$resUser = mysqli_fetch_assoc(mysqli_query($conn, $selectUser));

$selectCate = "SELECT * FROM post_category WHERE category_show = '1'";
$resCate = mysqli_query($conn, $selectCate);

$dataCate = mysqli_fetch_all($resCate, MYSQLI_ASSOC);

$limit = 6;

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;



if (isset($_GET['cate_id'])) {

    $selectBlog = "SELECT * FROM post WHERE category_id = '{$_GET['cate_id']}' AND post_show = '1' 
                    ORDER BY post_id DESC LIMIT $limit OFFSET $offset ";

    $resBlog = mysqli_query($conn, $selectBlog);
} elseif (isset($_GET['blog_user'])) {

    $selectBlog = "SELECT * FROM post WHERE user_id = '$id' AND post_show = '1' 
                    ORDER BY post_id DESC LIMIT $limit OFFSET $offset ";

    $resBlog = mysqli_query($conn, $selectBlog);
} else {

    $selectBlog = "SELECT * FROM post WHERE post_show = '1' 
                    ORDER BY post_id DESC LIMIT $limit OFFSET $offset ";

    $resBlog = mysqli_query($conn, $selectBlog);
}





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

    if (empty($title) || empty($desc) || empty($cate) || empty($_FILES['blog-img']['name'])) {

        $err_msg['err_title'] = "*Fill this blog title.";
        $err_msg['err_desc'] = "*Fill this blog description.";
        $err_msg['err_cate'] = "*Select the blog category.";
        $err_msg['err_img'] = "*Select the blog image.";
    }

    if (count($err_msg) == 0) {

        $img = time() . "_" . "$cate" . "_" . "blog" . "_" . "{$resUser['user_name']}" . "_" . $_FILES['blog-img']['name'];
        move_uploaded_file($_FILES['blog-img']['tmp_name'], "./uploads/" . $img);

        date_default_timezone_set("Asia/Kolkata");

        $create_date = date("y-m-d H:i:s");
        $update_date = date("y-m-d H:i:s");

        $insertBlog = "INSERT INTO post(post_title, post_desc, post_image, category_id, user_id, create_post_data, update_post_data)
                        VALUES('$title', '$desc', '$img', '$cate', '$id', '$create_date', '$update_date')";

        $resBlog = mysqli_query($conn, $insertBlog);

        if ($resBlog) {
            echo "<script>alert('Add Blog Successfull');window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Add Blog Failed');window.location.href='add-post.php';</script>";
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
                                <?php foreach ($dataCate as $cate) : ?>
                                    <li><a class="dropdown-item" href="./index.php?cate_id=<?php echo $cate['category_id']; ?>"><?php echo $cate['category_name']; ?></a></li>
                                <?php endforeach ?>
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
                            <?php foreach ($dataCate as $cate) : ?>
                                <li><a class="dropdown-item" href="./index.php?cate_id=<?php echo $cate['category_id']; ?>"><?php echo $cate['category_name']; ?></a></li>
                            <?php endforeach ?>
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


    <section id="add-post" class="mt-5 mb-5 ">
        <div class="container-lg">
            <div class="row">
                <div class="col-lg-8 m-auto ">
                    <section id="form-sec">
                        <form class="row g-3" method="post" enctype="multipart/form-data">
                            <div class="col-12">
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
                                    <option value="" selected>Select a category</option>
                                    <?php foreach ($dataCate as $c) : ?>
                                        <option value="<?php echo $c['category_id']; ?>"><?php echo $c['category_name']; ?></option>
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
                                <label class="form-label">Blog Description</label>
                                <textarea type="text" name="blog-desc" class="form-control" rows="7"></textarea>
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
        </div>
    </section>







    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="./assets/js/app.js" type="text/javascript"></script>

</body>

</html>