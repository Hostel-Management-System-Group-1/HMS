<?php

session_start();
include ('includes/config.php');
include ('includes/checklogin.php');
check_login();

if (isset($_GET["notice"])) {
    $notice = $_GET["notice"];
    $query = "INSERT INTO notice_board VALUES (\"" . date('Y-m-d H:i') . "\",\"" . $notice . "\")";
    $mysqli->execute_query($query);
    echo "Added!";
}
header("Location: dashboard.php")
?>