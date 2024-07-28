<?php
include 'authentication.php';
checkLogin(); // Call the function to check if the user is logged in
include_once 'includes/header.php';
include_once 'includes/sidebar.php';
include "includes/conn.php";

include "alert.php";
?>

<main id="main" class="main">

    <div class="pagetitle">
        <div class="justify-content-between d-flex">
            <h1>Subjects</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Subjects</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body pt-2">

                        <!-- Subject Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Subject Name</th>
                                    <th>Descriptive Title</th>
                                    <th>Teacher</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                 // Get Announcements Posted by the enrolled subjects
                                $student_id = $_SESSION['user_id'];

                                $stmt = $conn->prepare("SELECT s.Name, s.DescTitle, s.Description, s.category, s.AssignedTeacher, s.TeacherCode FROM subjects s JOIN enrollments e ON s.Subject_code = e.subjectCode WHERE e.StudentID = ?");
                                $stmt->bind_param('s', $student_id);
                                $stmt->execute();
                                $sub = $stmt->get_result();

                                if ($sub && $sub->num_rows > 0) {
                                $counter = 1;
                                while($row = $sub->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $row['Name'];?></td>
                                    <td><?php echo $row['DescTitle'];?></td>
                                    <td><?php echo $row['AssignedTeacher']?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm g-2"><i class="bi bi-eye"></i> View
                                            Class</button>
                                    </td>
                                </tr>
                                <?php 
                                 }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Subject Table -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>