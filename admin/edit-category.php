<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$cate_id = $_GET['cate-id'];

$selectSQL = "SELECT * FROM post_category WHERE category_id = '$cate_id'";
$data = mysqli_fetch_assoc(mysqli_query($conn, $selectSQL));

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['edit-cate-btn'])) {

    $name = test_input($_POST['name']);
    $desc = test_input($_POST['desc']);

    if (empty($name) || empty($desc)) {

        $err_msg['err_name'] = "*Fill the name";
        $err_msg['err_desc'] = "*Fill the description";
    }

    if (count($err_msg) == 0) {

        date_default_timezone_set("Asia/Kolkata");
        $update_date = date("y-m-d H:i:s");

        $updateSQL = "UPDATE post_category SET category_name = '$name', category_desc = '$desc', update_category_data = '$update_date'
                      WHERE category_id = '$cate_id'";
        $resUpdate = mysqli_query($conn, $updateSQL);

        if ($resUpdate) {
            echo "<script>alert('Update Category Successfull');window.location.href='manage-category.php';</script>";
        } else {
            echo "<script>alert('Update Category Failed');window.location.href='edit-category.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Edit Category</h4>

                <section id="profile-main">
                    <form class="row g-3" method="post" name="edit-cate-form">
                        <div class="col-12">
                            <label class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $data['category_name']; ?>">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Category Description</label>
                            <textarea name="desc" cols="30" rows="10" class="form-control">
                                <?php echo $data['category_desc']; ?>
                            </textarea>
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="edit-cate-btn">Update</button>
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