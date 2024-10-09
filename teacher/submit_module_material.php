<?php 
session_start();
include 'includes/conn.php';

// Handle file upload
if (isset($_POST['add-module'])) {
    // Sanitize inputs to avoid SQL injection
    $moduleTitle = trim($_POST['moduleTitle']);
    $moduleShortDesc = trim($_POST['moduleShortDesc']);
    $moduleSelectStudentsFor = $_POST['moduleSelectStudentsFor'];
    $moduleTopicOption = $_POST['moduleTopicOption'];
    $moduleClassCode = $_POST['moduleClassCode'];
    $moduleTeacherCode = $_POST['moduleTeacherCode'];

    // Initialize file upload variables
    $fileName = null;
    $targetFilePath = null;

    // Check if a file has been uploaded and is valid
    if (isset($_FILES['uploadModuleMaterial']) && $_FILES['uploadModuleMaterial']['error'] === UPLOAD_ERR_OK) {
        // Get file details
        $fileTmpPath = $_FILES['uploadModuleMaterial']['tmp_name'];
        $fileName = time() . "_" . basename($_FILES['uploadModuleMaterial']['name']);
        $targetFilePath = "uploads/" . $fileName;

        // Validate the file type
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ['pdf', 'doc', 'docx', 'ppt', 'pptx']; // Specify allowed types
        if (!in_array($fileType, $allowedTypes)) {
            // If file type is not allowed, prevent form submission
            $_SESSION['status'] = "Invalid File Type";
            $_SESSION['status_text'] = "Only PDF, DOC, DOCX, PPT, and PPTX files are allowed.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit; // Stop script execution
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($fileTmpPath, $targetFilePath)) {
            $_SESSION['status'] = "File Upload Failed";
            $_SESSION['status_text'] = "There was an error uploading your file.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "ok";
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit; // Stop script execution
        }
    }

    // SQL Insert statement
    $stmt = $conn->prepare("INSERT INTO modules (title, description, file_name, students_group, topic_id, class_code, teacher_code) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $moduleTitle, $moduleShortDesc, $fileName, $moduleSelectStudentsFor, $moduleTopicOption, $moduleClassCode, $moduleTeacherCode);

    // Execute query and set session status based on result
    if ($stmt->execute()) {
        $_SESSION['status'] = "Success";
        $_SESSION['status_text'] = "Module/Material saved successfully!";
        $_SESSION['status_code'] = "success";
        $_SESSION['status_btn'] = "Done";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    } else {
        $_SESSION['status'] = "Error Saving Module";
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