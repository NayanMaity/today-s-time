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

if (isset($_POST['add-cate-btn'])) {

    $name = test_input($_POST['name']);
    $desc = test_input($_POST['desc']);

    if (empty($name) || empty($desc)) {

        $err_msg['err_name'] = "*Fill the name";
        $err_msg['err_desc'] = "*Fill the description";
    }

    if (count($err_msg) == 0) {

        date_default_timezone_set("Asia/Kolkata");
        $create_date = date("y-m-d H:i:s");
        $update_date = date("y-m-d H:i:s");

        $insertSQL = "INSERT INTO post_category (category_name, category_desc, create_category_data, update_category_data)
                        VALUES ('$name', '$desc', '$create_date', '$update_date')";
        $resInsert = mysqli_query($conn, $insertSQL);

        if ($resInsert) {
            echo "<script>alert('Add Category Successfull');window.location.href='manage-category.php';</script>";
        } else {
            echo "<script>alert('Add Category Failed');window.location.href='add-category.php';</script>";
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
                            <li class="breadcrumb-item"><a href="./manage-category.php">Category</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Add Category</h4>

                <section id="profile-main">
                    <form class="row g-3" method="post" name="add-cate-form">
                        <div class="col-12">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name">
                            <h6>
                                <?php
                                if (isset($err_msg['err_name'])) {
                                    echo $err_msg['err_name'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Description</label>
                            <textarea name="desc" cols="30" rows="10" class="form-control"></textarea>
                            <h6>
                                <?php
                                if (isset($err_msg['err_desc'])) {
                                    echo $err_msg['err_desc'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="add-cate-btn">Add</button>
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