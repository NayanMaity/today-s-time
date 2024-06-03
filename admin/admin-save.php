<?php

session_start();

if (!isset($_SESSION['admin-login-status']) || $_SESSION['admin-login-status'] !== TRUE || $_SESSION['admin-role'] !== 'admin') {

    header("location:admin-login.php");
    die();
}

require_once("../config/connect.php");

$id = $_SESSION['admin-id'];

$searchAdmin = "SELECT * FROM user WHERE user_id = '$id'";
$resSerAdmin = mysqli_fetch_assoc(mysqli_query($conn, $searchAdmin));
