<?php

require_once("../config/connect.php");

require_once("./admin-save.php");


$post_id = $_GET['post_id'];

date_default_timezone_set("Asia/Kolkata");
$update_date = date("y-m-d H:i:s");

$updateSQL = "UPDATE post SET post_show = '0', update_post_data = '$update_date' WHERE post_id = '$post_id'";
$resUpdate = mysqli_query($conn, $updateSQL);

if ($resUpdate) {
    echo "<script>alert('Delete Blog Successfull');window.location.href='manage-blog.php';</script>";
} else {
    echo "<script>alert('Delete Blog Failed');window.location.href='manage-blog.php';</script>";
}
