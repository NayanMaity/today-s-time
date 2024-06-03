<?php

session_start();

if (!isset($_SESSION['login-status']) || $_SESSION['login-status'] !== TRUE) {

    header("location:login.php");
    die();
}

require_once("./config/connect.php");

$id = $_SESSION['id'];

$selectUser = "SELECT * FROM user WHERE user_id = ?";
$userStmt = mysqli_prepare($conn, $selectUser);
mysqli_stmt_bind_param($userStmt, 's', $id);
mysqli_stmt_execute($userStmt);
$resUser = mysqli_fetch_assoc(mysqli_stmt_get_result($userStmt));

// $resUser = mysqli_fetch_assoc(mysqli_query($conn, $selectUser));

$selectCate = "SELECT * FROM post_category WHERE category_show = '1'";
$resCate = mysqli_query($conn, $selectCate);


// $category_id = $_GET['cate_id'];

$limit = 6;

$offset = isset($_GET['offset']) ? $_GET['offset'] : 0;

if (isset($_GET['cate_id'])) {

    $category_id = $_GET['cate_id'];

    $selectBlog = "SELECT * FROM post WHERE category_id = ? AND post_show = '1'";
    $blogStmt = mysqli_prepare($conn, $selectBlog);
    mysqli_stmt_bind_param($blogStmt, 's', $category_id);
    mysqli_stmt_execute($blogStmt);
    $totalBlog = mysqli_num_rows(mysqli_stmt_get_result($blogStmt));

    // $totalBlog = mysqli_num_rows(mysqli_query($conn, $selectBlog));
} elseif (isset($_GET['blog_user'])) {

    $selectBlog = "SELECT * FROM post WHERE user_id = ? AND post_show = '1'";
    $blogStmt = mysqli_prepare($conn, $selectBlog);
    mysqli_stmt_bind_param($blogStmt, 's', $id);
    mysqli_stmt_execute($blogStmt);
    $totalBlog = mysqli_num_rows(mysqli_stmt_get_result($blogStmt));

    // $totalBlog = mysqli_num_rows(mysqli_query($conn, $selectBlog));
} else {

    $selectBlog = "SELECT * FROM post WHERE post_show = '1'";
    $totalBlog = mysqli_num_rows(mysqli_query($conn, $selectBlog));
}

$pageCount = ceil($totalBlog / $limit);


// echo $totalBlog . "<br>";
// echo $pageCount;


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


    <section id="blog-main">
        <div class="container-lg">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php while ($blog = mysqli_fetch_assoc($resBlog)) : ?>
                    <div class="col">
                        <div class="card">
                            <img src="./uploads/<?php echo $blog['post_image']; ?>" class="card-img-top" alt="Blog-img">
                            <div class="card-body">
                                <h5 class="card-title"><a href="./single-blog.php?post_id=<?php echo $blog['post_id']; ?>"><?php echo $blog['post_title']; ?></a></h5>
                            </div>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
        </div>
    </section>

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>

            <?php for ($i = 0; $i < $pageCount; $i++) : ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?offset=<?php echo $i * $limit ?><?php if (isset($_GET['cate_id'])) {
                                                                                                echo "&cate_id=" . $_GET['cate_id'];
                                                                                            } ?>">
                        <?php echo $i + 1 ?>
                    </a>
                </li>
            <?php endfor ?>

            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="./assets/js/app.js"></script>
</body>

</html>