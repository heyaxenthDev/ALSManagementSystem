<?php
// Database connection
include 'includes/conn.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['id_number'])) {
    $idNumber = $_POST['id_number'];

    // Query the database
    $sql = "SELECT * FROM `students` WHERE `ID_Number` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $idNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['Firstname'] ." ". substr($row['Middlename'], 0, 1) .". ". $row['Lastname'];
        echo"<div class='form-floating mb-3'>
                <input type='text' class='form-control' id='StudentName' name='student_name'
                    placeholder='Student Name' value='" . $name . "' readonly>
                <label for='StudentName'>Student Name</label>
            </div>";
    } else {
        echo "<p>No owner record found</p>";
    }

    $stmt->close();
    $conn->close();
}