<?php

require_once("../config/connect.php");

require_once("./admin-save.php");


function selectFromUser($role_name, $conn)
{
    $select = "SELECT * FROM user WHERE user_role = '$role_name' AND user_show = '1' ";
    $res = mysqli_num_rows(mysqli_query($conn, $select));
    return $res;
}

function selectFromOther($table, $show, $conn)
{
    $select = "SELECT * FROM $table WHERE $show = '1' ";
    $res = mysqli_num_rows(mysqli_query($conn, $select));
    return $res;
}

$flag = ['pending', 'approve', 'reject'];

$selectNoti = "SELECT notification.*, user.* FROM notification LEFT JOIN user ON notification.user_id = user.user_id 
                WHERE notification_show = '1'";

$resNoti = mysqli_query($conn, $selectNoti);

if (isset($_POST['noti-ac-btn'])) {

    $user_id = $_POST['user-id'];
    $noti_id = $_POST['noti-id'];
    $noti_flag = $_POST['noti-flag'];

    if (empty($noti_id) || empty($noti_flag)) {

        echo "<script>alert('Something went wrong.');window.location.href='dashboard.php';</script>";
    } else {

        date_default_timezone_set("Asia/Kolkata");
        $update_date = date("y-m-d H:i:s");

        $updateNoti = "UPDATE notification SET notification_status = '$noti_flag', update_notification_data = '$update_date'
                        WHERE notification_id = '$noti_id'";
        $resNoti = mysqli_query($conn, $updateNoti);

        if ($resNoti) {

            $selectNotiOne = "SELECT * FROM notification WHERE notification_id = '$noti_id' AND notification_show = '1'";
            $resNotiOne = mysqli_query($conn, $selectNotiOne);

            $dataNoti = mysqli_fetch_assoc($resNotiOne);

            if ($dataNoti['notification_status'] == 'approve') {

                $updateUser = "UPDATE user SET user_role = 'blogger', update_user_data = '$update_date' 
                                WHERE user_id = '{$dataNoti['user_id']}'";

                $resUser = mysqli_query($conn, $updateUser);

                echo "<script>alert('Change Notification Flag Successful 1.');window.location.href='dashboard.php';</script>";
            } else {

                echo "<script>alert('Change Notification Flag Successful.');window.location.href='dashboard.php';</script>";
            }
        } else {

            echo "<script>alert('Change Notification Flag Failed.');window.location.href='dashboard.php';</script>";
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
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="dash-view-main">
                <h4 class="dash-view-heading">Dashboard</h4>

                <div class="dash-view-card-sec d-flex align-items-center justify-content-between">
                    <div class="dash-card" style="background-color: #fbad4c;">
                        <i class="fa-solid fa-users"></i>

                        <div class="dash-card-text">
                            Users <p class="m-0"><?php echo selectFromUser($role_name = 'user', $conn); ?></p>
                        </div>
                    </div>

                    <div class="dash-card" style="background-color: #59d05d;">
                        <i class="fa-solid fa-user-pen"></i>

                        <div class="dash-card-text">
                            Blogers <p class="m-0"><?php echo selectFromUser($role_name = 'blogger', $conn); ?></p>
                        </div>
                    </div>

                    <div class="dash-card" style="background-color: #ff646d;">
                        <i class="fa-regular fa-newspaper"></i>

                        <div class="dash-card-text">
                            Blogs <p class="m-0"><?php echo selectFromOther($table = 'post', $show = 'post_show', $conn); ?></p>
                        </div>
                    </div>

                    <div class="dash-card" style="background-color: #1d62f0;">
                        <i class="fa-regular fa-rectangle-list"></i>

                        <div class="dash-card-text">
                            Category <p class="m-0"><?php echo selectFromOther($table = 'post_category', $show = 'category_show', $conn); ?></p>
                        </div>
                    </div>
                </div>

                <div class="noti-sec">
                    <h4 class="noti-sec-heading">Become Blogger Notification</h4>

                    <table class="table table-responsive-lg table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Notification Id</th>
                                <th>Notification Title</th>
                                <th>User Avatar</th>
                                <th>User Name</th>
                                <th>User Email</th>
                                <th>Flag</th>
                                <th>Remove</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($resNoti)) : ?>
                                <tr>
                                    <td><?php echo $row['notification_id']; ?></td>

                                    <td><?php echo $row['notification_title']; ?></td>

                                    <td>
                                        <div class="user-list-img">
                                            <?php if ($row['avatar']) : ?>
                                                <img src="../uploads/<?php echo $row['avatar']; ?>" alt="Avatar">
                                            <?php else : ?>
                                                <img src="../uploads/default_avatar.png" alt="Avatar">
                                            <?php endif ?>
                                        </div>
                                    </td>

                                    <td><?php echo $row['user_name']; ?></td>

                                    <td><?php echo $row['user_email']; ?></td>

                                    <td>
                                        <form class="row g-3 align-items-center mt-1" method="post">
                                            <div class="col-auto mt-0 ">
                                                <input type="hidden" name="noti-id" <?php if ($row['notification_status'] !== 'pending') {
                                                                                        echo "disabled";
                                                                                    }
                                                                                    ?> value="<?php echo $row['notification_id']; ?>">
                                            </div>
                                            <div class="col-auto mt-0 ">
                                                <input type="hidden" name="user-id" value="<?php echo $row['user_id']; ?>">
                                            </div>
                                            <div class="col-auto mt-0 ">
                                                <select class="form-select" name="noti-flag" <?php if ($row['notification_status'] !== 'pending') {
                                                                                                    echo "disabled";
                                                                                                }
                                                                                                ?>>
                                                    <?php foreach ($flag as $f) : ?>
                                                        <?php if ($f == $row['notification_status']) : ?>
                                                            <option value="<?php echo $f ?>" selected><?php echo $f ?></option>
                                                        <?php else : ?>
                                                            <option value="<?php echo $f ?>"><?php echo $f ?></option>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-auto mt-0 ">
                                                <button type="submit" name="noti-ac-btn" class="table-ac-btn-1" <?php if ($row['notification_status'] !== 'pending') {
                                                                                                                    echo "disabled";
                                                                                                                }
                                                                                                                ?>>Action</button>
                                            </div>
                                        </form>
                                    </td>
                                    <td><a href="./delete-noti.php?noti_id=<?php echo $row['notification_id']; ?>" class="table-ac-btn-2">Remove</a></td>
                                </tr>
                            <?php endwhile ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="../assets/js/app.js"></script>
</body>

</html>