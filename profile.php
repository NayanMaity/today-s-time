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



$selectCate = "SELECT * FROM post_category WHERE category_show = '1'";
$resCate = mysqli_query($conn, $selectCate);


// $category_id = $_GET['cate_id'];

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
                </ul>
            </nav>
        </div>
    </header>

    <div class="container-lg">
        <div class="row">
            <div class="col-lg-8 m-auto ">
                <section id="profile-main">
                    <div class="profile-img">
                        <?php if ($resUser['avatar']) : ?>
                            <img src="./uploads/<?php echo $resUser['avatar'] ?>" alt="Avatar">
                        <?php else : ?>
                            <img src="./uploads/default_avatar.png" alt="Avatar">
                        <?php endif ?>
                    </div>

                    <form class="row g-3">
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Name</label>
                            <input type="text" class="form-control" id="inputEmail4" value="<?php echo $resUser['user_name'] ?>" disabled>
                        </div>

                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="text" class="form-control" id="inputEmail4" Value="<?php echo $resUser['user_email'] ?>" disabled>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <a href="update-profile.php">Update</a>
                            <a href="logout.php">Logout</a>
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