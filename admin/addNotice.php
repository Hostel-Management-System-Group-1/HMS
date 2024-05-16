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


if (isset($_GET["clear_notice_board"])) {
    $query = "TRUNCATE TABLE notice_board"; // Deletes all rows from the table
    
    if ($mysqli->query($query) === TRUE) {
        echo "Notice board cleared!";
    } else {
        echo "Error: Unable to clear notice board.";
    }
}

header("Location: dashboard.php");
?>