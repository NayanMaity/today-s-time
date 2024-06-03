<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$id = $_GET['user-id'];

date_default_timezone_set("Asia/Kolkata");
$update_date = date("y-m-d H:i:s");

// $selectBlogger = "SELECT * FROM user WHERE user_id = '$id'";
// $resSelBlogger = mysqli_query($conn, $selectBlogger);

$removeSQl = "UPDATE user SET user_role = 'user', update_user_data = '$update_date' WHERE user_id = '$id'";
$resRemove = mysqli_query($conn, $removeSQl);

if ($resRemove) {
    echo "<script>alert('Remove Successfull');window.location.href='manage-blogger.php';</script>";
} else {
    echo "<script>alert('Remove Failed');window.location.href='manage-blogger.php';</script>";
}
