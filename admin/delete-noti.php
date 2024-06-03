<?php

require_once("../config/connect.php");

require_once("./admin-save.php");


$noti_id = $_GET['noti_id'];

date_default_timezone_set("Asia/Kolkata");
$update_date = date("y-m-d H:i:s");

$selNoti = "SELECT * FROM notification WHERE notification_id = '$noti_id'";
$dataNoti = mysqli_fetch_assoc(mysqli_query($conn, $selNoti));


if ($dataNoti['notification_status'] == 'approve') {

    $removeNoti = "UPDATE notification SET notification_show = '0', update_notification_data = '$update_date'
                    WHERE notification_id = '$noti_id'";

    $resRemove = mysqli_query($conn, $removeNoti);
} else {

    $removeNoti = "UPDATE notification SET notification_status = 'reject', notification_show = '0', 
                    update_notification_data = '$update_date' WHERE notification_id = '$noti_id'";

    $resRemove = mysqli_query($conn, $removeNoti);
}


if ($resRemove) {
    echo "<script>alert('Remove Notification Successful.');window.location.href='dashboard.php';</script>";
} else {
    echo "<script>alert('Remove Notification Failed.');window.location.href='dashboard.php';</script>";
}
