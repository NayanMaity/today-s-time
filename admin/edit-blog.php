<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$post_id = $_GET['post_id'];


$selectCate = "SELECT category_id, category_name FROM post_category WHERE category_show = '1'";
$resCate = mysqli_fetch_all(mysqli_query($conn, $selectCate), MYSQLI_ASSOC);

$selectBlog = "SELECT post.*, user.user_name FROM post LEFT JOIN user ON post.user_id = user.user_id WHERE post_id = '$post_id';";
$resSelBlog = mysqli_fetch_assoc(mysqli_query($conn, $selectBlog));


function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['update-blog-btn'])) {

    $title = test_input($_POST['blog-title']);
    $desc = $_POST['blog-desc'];
    $cate = $_POST['blog-cate'];

    $img = $resSelBlog['post_image'];

    if (empty($title) || empty($desc) || empty($cate)) {

        $err_msg['err_title'] = "*Fill this blog title.";
        $err_msg['err_desc'] = "*Fill this blog description.";
        $err_msg['err_cate'] = "*Select the blog category.";
    }

    if (count($err_msg) == 0) {

        if (!empty($_FILES['blog-img']['name'])) {
            unlink("../uploads/" . $img);
            $img = time() . "_" . "$cate" . "_" . "blog" . "_" . "{$resSelBlog['user_name']}" . "_" . $_FILES['blog-img']['name'];
            move_uploaded_file($_FILES['blog-img']['tmp_name'], "../uploads/" . $img);
        }

        date_default_timezone_set("Asia/Kolkata");
        $update_date = date("y-m-d H:i:s");

        $updateSQL = "UPDATE post SET post_title = '$title', post_desc = '$desc', post_image = '$img', category_id = '$cate',
                        update_post_data = '$update_date' WHERE post_id = '{$resSelBlog['post_id']}'";

        $resUpdate = mysqli_query($conn, $updateSQL);

        if ($resUpdate) {
            echo "<script>alert('Update Blog Successfull');window.location.href='manage-blog.php';</script>";
        } else {
            echo "<script>alert('Update Blog Failed');window.location.href='manage-blog.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page">Edit Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Edit Blog</h4>

                <section id="profile-main">
                    <form class="row g-3" method="post" name="edit-blog-from" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label">Blog Image</label>
                            <input class="form-control" type="file" name="blog-img">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Blog Title</label>
                            <input type="text" class="form-control" name="blog-title" value="<?php echo $resSelBlog['post_title']; ?>">
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
                                <?php foreach ($resCate as $c) : ?>
                                    <?php if ($c['category_id'] == $resSelBlog['category_id']) : ?>
                                        <option value="<?php echo $c['category_id']; ?>" selected><?php echo $c['category_name']; ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $c['category_id']; ?>"><?php echo $c['category_name']; ?></option>
                                    <?php endif ?>
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
                            <textarea name="blog-desc" class="form-control" rows="10"><?php echo $resSelBlog['post_desc']; ?></textarea>
                            <h6>
                                <?php
                                if (isset($err_msg['err_desc'])) {
                                    echo $err_msg['err_desc'];
                                }
                                ?>
                            </h6>
                        </div>


                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="update-blog-btn">Update</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </section>











    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>

</html>