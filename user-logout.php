<?php
session_start();

include_once('includes/conn.php');

// Check if user is authenticated as an admin
if (isset($_SESSION['user_auth'])) {
    
    $user_id = $_SESSION['user_id'];
    $table = $_SESSION['tablename'];

    $update_status = "UPDATE `$table` SET `is_online`='0' WHERE `ID_Number` = '$user_id'";
    $run = mysqli_query($conn, $update_status);
    if ($run) {
        // Set session variables for status message
        $_SESSION['status'] = "Logged Out Successfully!";
        $_SESSION['status_text'] = "You have been logged out.";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_btn'] = "Done";

        // Unset session variables
        unset($_SESSION['user_id']);
        unset($_SESSION['tablename']);
        unset($_SESSION['user_auth']);

        // Redirect to index page
        header("Location: index");
    } else {
        $_SESSION['status'] = "Error";
        $_SESSION['status_text'] = "Log out Failed. Try Again";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    exit; // Exit script to prevent further execution
}