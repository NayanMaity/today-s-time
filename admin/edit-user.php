<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$user_id = $_GET['user-id'];

$selectUser = "SELECT * FROM user WHERE user_id = '$user_id'";
$resSelUser = mysqli_query($conn, $selectUser);

$data = mysqli_fetch_assoc($resSelUser);

$selectRole = "SELECT role_name FROM user_role WHERE role_name != 'admin' AND role_name != '{$data['user_role']}'";
$dataRole = mysqli_fetch_all(mysqli_query($conn, $selectRole), MYSQLI_ASSOC);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$err_msg = [];

if (isset($_POST['edit-user-btn'])) {

    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $role = $_POST['role'];

    $file = $data['avatar'];

    if (empty($name) || empty($email)) {

        $err_msg['err_name'] = "*Fill this name field";
        $err_msg['err_email'] = "*Fill this email field";
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $err_msg['err_name'] = "*Only letters and white space allowed";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $err_msg['err_email'] = "*Invalid email format";
    }

    if (count($err_msg) == 0) {

        if (!empty($_FILES['avatar']['name'])) {

            if ($file !== null) {
                unlink("../uploads/" . $file);
            }
            $file = time() . "_" . str_replace(" ", "_", "$name") . "_" . $_FILES['avatar']['name'];
            move_uploaded_file($_FILES['avatar']['tmp_name'], "../uploads/" . $file);
        }

        date_default_timezone_set("Asia/Kolkata");
        $update_date = date("y-m-d H:i:s");

        $updateSQL = "UPDATE user SET user_name = '$name', user_email = '$email', avatar = '$file', user_role = '$role', 
                      update_user_data = '$update_date' WHERE user_id = '$user_id'";
        $resUpdate = mysqli_query($conn, $updateSQL);

        if ($resUpdate) {
            echo "<script>alert('Edit Successfull');window.location.href='manage-user.php';</script>";
        } else {
            echo "<script>alert('Edit Failed');window.location.href='manage-user.php';</script>";
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
                            <li class="breadcrumb-item"><a href="./manage-user.php">User</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Edit Users</h4>

                <section id="profile-main">
                    <div class="profile-img">
                        <?php if ($data['avatar']) : ?>
                            <img src="../uploads/<?php echo $data['avatar']; ?>" alt="Avatar">
                        <?php else : ?>
                            <img src="../uploads/default_avatar.png" alt="Avatar">
                        <?php endif ?>
                    </div>

                    <form class="row g-3" method="post" enctype="multipart/form-data">
                        <div class="col-12">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $data['user_name']; ?>">
                            <h6>
                                <?php
                                if (isset($err_msg['err_name'])) {
                                    echo $err_msg['err_name'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="email" Value="<?php echo $data['user_email']; ?>">
                            <h6>
                                <?php
                                if (isset($err_msg['err_email'])) {
                                    echo $err_msg['err_email'];
                                }
                                ?>
                            </h6>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Choose Role</label>
                            <select class="form-select" name="role">
                                <option selected value="<?php echo $data['user_role']; ?>">
                                    <?php echo $data['user_role']; ?>
                                </option>

                                <?php foreach ($dataRole as $r) : ?>
                                    <option value="<?php echo $r['role_name']; ?>"><?php echo $r['role_name']; ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Avatar</label>
                            <input class="form-control" type="file" name="avatar">
                        </div>

                        <div class="col-12 d-flex gap-3 justify-content-center align-items-center profile-btn">
                            <button type="submit" name="edit-user-btn">Update</button>
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