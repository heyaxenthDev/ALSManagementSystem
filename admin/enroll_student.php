<?php
// Start the session
session_start();

// Database connection
include 'includes/conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $subjectCode = $_POST['subjectCode'];
    $teacherCode = $_POST['teacherCode'];
    $category = $_POST['category'];
    $studentIDs = $_POST['student_ids']; // This will be an array of student IDs
    $dateCreated = date('Y-m-d H:i:s');

    // Prepare and execute insertion
    $sql = "INSERT INTO `enrollments` (`enrollmentID`, `studentID`, `subjectCode`, `teacherCode`, `category`, `date_created`) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $success = true; // Track success status

    foreach ($studentIDs as $studentID) {
        // Generate a unique enrollmentID
        $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $datePart = date('Ymd'); // Format: YYYYMMDD
        $enrollmentID = $datePart ."-". $randomNumber;

        // Bind parameters and execute
        $stmt->bind_param('ssssss', $enrollmentID, $studentID, $subjectCode, $teacherCode, $category, $dateCreated);
        if (!$stmt->execute()) {
            $success = false; // Set success to false if any query fails
            break;
        }
    }

    $stmt->close();
    $conn->close();

    // Set session variables and redirect based on success status
    if ($success) {
        $_SESSION['status'] = "Success";
        $_SESSION['status_text'] = "Students enrolled successfully.";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_btn'] = "Done";
    } else {
        $_SESSION['status'] = "Error";
        $_SESSION['status_text'] = "An error occurred while enrolling students.";
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "Retry";
    }

    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    $_SESSION['status'] = "Error";
    $_SESSION['status_text'] = "Invalid request method.";
    $_SESSION['status_code'] = "error";
    $_SESSION['status_btn'] = "Retry";
    
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
}
?>