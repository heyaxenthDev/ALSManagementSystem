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

// Function to generate a unique 4-digit random number combined with the last inserted ID
function generateUniqueTpID($conn) {
    // Get the last inserted ID from the topics table
    $sql = "SELECT Tp_ID FROM topics ORDER BY Tp_ID DESC LIMIT 1";
    $result = $conn->query($sql);
    $lastID = $result->fetch_assoc()['Tp_ID'];

    // Generate a unique 4-digit random number
    $randomNumber = rand(1000, 9999);

    // Combine the random number with the last ID
    $uniqueTpID = $randomNumber . '-' . ($lastID + 1);

    return $uniqueTpID;
}

if (isset($_POST['CreateLesson'])) {
    $title = $conn->real_escape_string($_POST['Title']);
    $shortDesc = $conn->real_escape_string($_POST['shortDesc']);
    $teacherCode = $conn->real_escape_string($_POST['teacherCode']);
    $classCode = $conn->real_escape_string($_POST['classCode']);

    // Generate a unique Tp_ID
    $tpID = generateUniqueTpID($conn);

    // Insert the lesson into the database
    $sql = "INSERT INTO topics (Tp_ID, Title, ShortDesc, TeacherCode, ClassCode) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $tpID, $title, $shortDesc, $teacherCode, $classCode);

    if ($stmt->execute()) {
        $_SESSION['status'] = "Success";
        $_SESSION['status_text'] = "Lesson created successfully!";
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

    $stmt->close();
    $conn->close();
}


// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assTitle = $_POST['assTitle'];
    $shortDesc = $_POST['shortDesc'];
    $selectStudentsFor = $_POST['selectStudentsFor'];
    $pointsOption = $_POST['pointsOption'];
    $points = $pointsOption === 'graded' ? $_POST['pointsInput'] : null;
    $dueOption = $_POST['dueOption'];
    $dueDate = $dueOption === 'dueDate' ? $_POST['dueInput'] : null;
    $topicOption = $_POST['topicOption'];
    $classCode = $_POST['classCode'];
    $teacherCode = $_POST['teacherCode'];

    // File upload handling
    $fileName = null;
    if (isset($_FILES['uploadModule']) && $_FILES['uploadModule']['error'] == 0) {
        $fileName = time() . "_" . basename($_FILES["uploadModule"]["name"]);
        $targetFilePath = "uploads/" . $fileName;

        // Move the file to the desired location
        if (!move_uploaded_file($_FILES["uploadModule"]["tmp_name"], $targetFilePath)) {
            die("File upload failed.");
        }
    }

    // SQL Insert statement
    $stmt = $conn->prepare("INSERT INTO assignments (title, description, file_name, students_group, points_option, points, due_option, due_date, topic, class_code, teacher_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $assTitle, $shortDesc, $fileName, $selectStudentsFor, $pointsOption, $points, $dueOption, $dueDate, $topicOption, $classCode, $teacherCode);

    // Execute query
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Assignment saved successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>