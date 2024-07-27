<?php
include "includes/conn.php";

if (isset($_POST['subject_code'])) {
    $subjectCode = $_POST['subject_code'];

    // Query to get enrolled students
    $query = "
        SELECT e.enrollmentID, e.studentID, e.subjectCode, e.teacherCode, e.category, e.date_created,
               s.ID_Number, s.Firstname, s.Middlename, s.Lastname
        FROM enrollments e
        JOIN students s ON e.studentID = s.ID_Number
        WHERE e.subjectCode = '$subjectCode'
    ";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-striped">
                <thead>
                    <tr>
                        <th>Enrollment ID</th>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Date Created</th>
                    </tr>
                </thead>
                <tbody>';
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
                    <td>' . $row['enrollmentID'] . '</td>
                    <td>' . $row['studentID'] . '</td>
                    <td>' . $row['Firstname'] . ' ' . $row['Middlename'] . ' ' . $row['Lastname'] . '</td>
                    <td>' . $row['category'] . '</td>
                    <td>' . $row['date_created'] . '</td>
                </tr>';
        }
        
        echo '  </tbody>
            </table>';
    } else {
        echo '<p>No students enrolled in this subject.</p>';
    }
}
?>