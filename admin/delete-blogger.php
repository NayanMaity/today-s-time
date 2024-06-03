<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$id = $_GET['user-id'];

date_default_timezone_set("Asia/Kolkata");
$update_date = date("y-m-d H:i:s");

$deleteSQl = "UPDATE user SET user_show = '0', update_user_data = '$update_date' WHERE user_id = '$id'";
$resDelete = mysqli_query($conn, $deleteSQl);

if ($resDelete) {
    echo "<script>alert('Delete Successfull');window.location.href='manage-blogger.php';</script>";
} else {
    echo "<script>alert('Delete Failed');window.location.href='manage-blogger.php';</script>";
}
