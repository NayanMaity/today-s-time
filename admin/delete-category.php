<?php

require_once("../config/connect.php");

require_once("./admin-save.php");

$cate_id = $_GET['cate-id'];

date_default_timezone_set("Asia/Kolkata");
$update_date = date("y-m-d H:i:s");

$updateSQL = "UPDATE post_category SET category_show = '0', update_category_data = '$update_date'WHERE category_id = '$cate_id'";
$resUpdate = mysqli_query($conn, $updateSQL);

if ($resUpdate) {
    echo "<script>alert('Delete Category Successfull');window.location.href='manage-category.php';</script>";
} else {
    echo "<script>alert('Delete Category Failed');window.location.href='manage-category.php';</script>";
}
