<?php 
session_start();
include "includes/conn.php";

if (isset($_POST['AddStudent'])) {
    
    //Get form data
    $id_number = $conn->real_escape_string($_POST['id_number']);
    $firstname = $conn->real_escape_string($_POST['first_name']);
    $middlename = $conn->real_escape_string($_POST['middle_name']);
    $lastname = $conn->real_escape_string($_POST['last_name']);

    // Insert the student data
    $stmt = $conn->prepare("INSERT INTO `students`(`ID_Number`, `Firstname`, `Middlename`, `Lastname`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $id_number,$firstname,$middlename,$lastname);

    if ($stmt->execute()){
    
        $lastID = $stmt->insert_id;
        // Generate Hash Password
        $hash_password = password_hash($id_number, PASSWORD_DEFAULT);

        // Update database with the hash password
        $update_passwordStmt = $conn->prepare("UPDATE `students` SET `Password` = ? WHERE `id` = ?");
        $update_passwordStmt->bind_param("si", $hash_password, $lastID);
        
        if ($update_passwordStmt->execute()) {
            // Return success or error message
            $_SESSION['status'] = "Success";
            $_SESSION['status_text'] = "New student data has been added successfully.";
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
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['status_text'] = "Error: " . $stmt->error;
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    // Close the statement
    $update_passwordStmt->close();
    $stmt->close();

}

if (isset($_POST['AddSubject'])) {
    // Get form data
    $subjectName = $conn->real_escape_string($_POST['subject_name']);
    $descTitle = $conn->real_escape_string($_POST['descriptive_title']);
    $desc = $conn->real_escape_string($_POST['description']);
    $teacherCode = $conn->real_escape_string($_POST['teacherCode']);
    $category = $conn->real_escape_string($_POST['category']);

    // Generate subject code
    // $currentDate = date('Ymd');
    $randomNumber = rand(1000, 9999);

    // Get the last inserted ID from the subjects table
    $result = $conn->query("SELECT MAX(id) AS last_id FROM `subjects`");
    $row = $result->fetch_assoc();
    $lastId = $row['last_id'] + 1; // Increment last ID for the new record

    $subjectCode = "{$randomNumber}-{$lastId}";

    // Insert subject data
    $stmt = $conn->prepare("INSERT INTO `subjects`(`Name`, `DescTitle`, `Description`, `TeacherCode`, `Subject_code`,`category`) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $subjectName, $descTitle, $desc, $teacherCode, $subjectCode, $category);

    if ($stmt->execute()) {
        // Get Teacher code value and insert to subject table
        $get_teacher = $conn->prepare("SELECT * FROM `teachers` WHERE `ID_Number` = ?");
        $get_teacher->bind_param("s", $teacherCode);
        $get_teacher->execute();
        $result = $get_teacher->get_result();

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();
            $teacher_name = $teacher['First_name'] . " " . substr($teacher['Middle_name'], 0, 1) . ". " . $teacher['Last_name'];

            // Update subject table
            $update = $conn->prepare("UPDATE `subjects` SET `AssignedTeacher` = ? WHERE `TeacherCode` = ?");
            $update->bind_param("ss", $teacher_name, $teacherCode);

            if ($update->execute()) {
                // Return success message
                $_SESSION['status'] = "Success";
                $_SESSION['status_text'] = "New subject data has been added successfully.";
                $_SESSION['status_code'] = "success";
                $_SESSION['status_btn'] = "Done";
            } else {
                $_SESSION['status'] = "Error";
                $_SESSION['status_text'] = "Error updating assigned teacher: " . $update->error;
                $_SESSION['status_code'] = "error";
                $_SESSION['status_btn'] = "OK";
            }
        } else {
            $_SESSION['status'] = "Error";
            $_SESSION['status_text'] = "Teacher not found.";
            $_SESSION['status_code'] = "error";
            $_SESSION['status_btn'] = "OK";
        }
        $get_teacher->close();
    } else {
        $_SESSION['status'] = "Error";
        $_SESSION['status_text'] = "Error adding subject: " . $stmt->error;
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "OK";
    }

    // Close the statement
    $stmt->close();
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit;
}

if (isset($_POST['AddTeacher'])) {
    // Get form data
    $id_number = $conn->real_escape_string($_POST['id_number']);
    $firstname = $conn->real_escape_string($_POST['first_name']);
    $lastname = $conn->real_escape_string($_POST['last_name']);
    $middlename = $conn->real_escape_string($_POST['middle_name']);

    

    // Insert teacher data
    $stmt = $conn->prepare("INSERT INTO `teachers`(`ID_Number`, `First_name`, `Last_name`, `Middle_name`) VALUES (?,?,?,?)");
    $stmt->bind_param("ssss", $id_number, $firstname, $lastname, $middlename);

    if($stmt->execute()){
        
        $lastID = $stmt->insert_id;

        // Generate Hash Password
        $hash_password = password_hash($id_number, PASSWORD_DEFAULT);

        $update_stmt = $conn->prepare("UPDATE `teachers` SET `password`= ? WHERE `id` = ?");
        $update_stmt->bind_param("si", $hash_password, $lastID);

        if ($update_stmt->execute()) {
            // Return success or error message
            $_SESSION['status'] = "Success";
            $_SESSION['status_text'] = "New teacher data has been added successfully.";
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
    }else{
        $_SESSION['status'] = "Error";
        $_SESSION['status_text'] = "Error: " . $stmt->error;
        $_SESSION['status_code'] = "error";
        $_SESSION['status_btn'] = "ok";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }
      // Close the statement
      $update_stmt->close();
      $stmt->close();
}

?>