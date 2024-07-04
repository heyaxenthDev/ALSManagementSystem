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
    
    // Insert subject data
    $stmt = $conn->prepare("INSERT INTO `subjects`(`Name`, `DescTitle`, `Description`) VALUES (?,?,?)");
    $stmt->bind_param("sss", $subjectName, $descTitle, $desc);

    if ($stmt->execute()) {
          // Return success or error message
          $_SESSION['status'] = "Success";
          $_SESSION['status_text'] = "New subject data has been added successfully.";
          $_SESSION['status_code'] = "success";
          $_SESSION['status_btn'] = "Done";
          header("Location: {$_SERVER['HTTP_REFERER']}");
      }else{
          $_SESSION['status'] = "Error";
          $_SESSION['status_text'] = "Error: " . $stmt->error;
          $_SESSION['status_code'] = "error";
          $_SESSION['status_btn'] = "ok";
          header("Location: {$_SERVER['HTTP_REFERER']}");
          exit;
      }
  
      // Close the statement
      $stmt->close();
}

?>