<?php 
session_start();
include "includes/conn.php";


if (isset($_POST['AdminLogin'])) {
    // Get form data
    $admin_id = $conn->real_escape_string($_POST['idNumber']);
    $password = $conn->real_escape_string($_POST['password']);

    // Query the database for the admin
    $sql = "SELECT * FROM `admin` WHERE `adminID` = $admin_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Password is correct
            $_SESSION['admin_auth'] = true;
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_code'] = $row['adminID'];
            // Redirect to dashboard or any other page
            $_SESSION['logged'] = "Logged in successfully";
            $_SESSION['logged_icon'] = "success";
            header("Location: admin/dashboard.php");
        } else {
            // Password is incorrect, display an error message
            $_SESSION['entered_id'] = $adminID;
            $_SESSION['status'] = "Password Error";
            $_SESSION['status_text'] = "Incorrect password. Please try again.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "Back";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        }
    } else {
        // User not found
        $_SESSION['status'] = "Login Error";
        $_SESSION['status_text'] = "No user found with this credentials.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Back";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
}
if (isset($_POST['UserLogin'])) {
    // Get form data
    $userType = $conn->real_escape_string($_POST['SelectRadio']);
    $ID_number = $conn->real_escape_string($_POST['idNumber']);
    $password = $conn->real_escape_string($_POST['password']);

    switch ($userType) {
        case "Student":
            authenticateUser($conn, $ID_number, $password, "students", "student/home");
            break;
        case "Teacher":
            authenticateUser($conn, $ID_number, $password, "teachers", "teacher/home");
            break;
        default:
            // User not found
            setSessionStatus("Login Error", "No user found with these credentials.", "error", "Back");
            header("Location: {$_SERVER['HTTP_REFERER']}");
            break;
    }
}

function authenticateUser($conn, $ID_number, $password, $table, $redirectPath) {
    $query = $conn->prepare("SELECT * FROM `$table` WHERE `ID_Number` = ?");
    $query->bind_param('s', $ID_number);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $updateQuery = $conn->prepare("UPDATE `$table` SET `is_online` = '1' WHERE `ID_Number` = ?");
            $updateQuery->bind_param('s', $ID_number);
            if ($updateQuery->execute()) {
                $_SESSION['user_auth'] = true;
                $_SESSION['user_id'] = $row['ID_Number'];
                $_SESSION['tablename'] = $table;
                $_SESSION['logged'] = "Logged in successfully";
                $_SESSION['logged_icon'] = "success";
                header("Location: $redirectPath");
            } else {
                setSessionStatus("Error", "Cannot update your status. Try again.", "error", "OK");
                header("Location: {$_SERVER['HTTP_REFERER']}");
            }
        } else {
            setSessionStatus("Error", "Incorrect password! Please try again.", "error", "OK");
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    } else {
        setSessionStatus("Wrong ID Number or Password", "Please check your credentials.", "error", "OK");
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
}

function setSessionStatus($status, $statusText, $statusCode, $statusBtn) {
    $_SESSION['status'] = $status;
    $_SESSION['status_text'] = $statusText;
    $_SESSION['status_code'] = $statusCode;
    $_SESSION['status_btn'] = $statusBtn;
}
?>