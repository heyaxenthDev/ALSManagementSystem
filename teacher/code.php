<?php 
session_start();
include 'includes/conn.php';


if (isset($_POST['CreateAnnouncement'])) {
    
    // Retrieve Inputs
    $classFor = $conn->real_escape_string($_POST['classAnc']);
    $type = $conn->real_escape_string($_POST['typeAnc']);
    $title = $conn->real_escape_string($_POST['AncTitle']);
    $content = $conn->real_escape_string($_POST['AncContent']);
    $datetimeFor = $conn->real_escape_string($_POST['AncDate']);
    $link = $conn->real_escape_string($_POST['virtualLink']);
    $teacherCode = $_SESSION['user_id'];

    // Prepare and bind
    $query = "INSERT INTO `announcement`(`Title`, `Content`, `SubjectCode`, `forDate`, `Type`, `TeacherCode`, `VirtualLink`) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssss", $title, $content, $classFor, $datetimeFor, $type, $teacherCode, $link);

    // Execute the statement
    if ($stmt->execute()) {
            $_SESSION['status'] = "Success";
            $_SESSION['status_text'] = "Announcement Created.";
            $_SESSION['status_code'] = "success";
            $_SESSION['status_btn'] = "Done";
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }else {
            $_SESSION['status'] = "Error Saving Password";
            $_SESSION['status_text'] = "Error: " . $stmt->error;
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit;
        } 

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>