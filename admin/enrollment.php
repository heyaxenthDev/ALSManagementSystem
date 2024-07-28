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
        <h1>Enrollment</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Enrollment</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row dashboard">
            <?php 
                // Get subjects listed
                $query = "SELECT * FROM `subjects`";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $subjectCode = $row['Subject_code'];
                    
                    // Get the count of enrolled students for this subject
                    $enrollmentQuery = "SELECT COUNT(*) AS enrolled_count FROM `enrollments` WHERE `subjectCode` = '$subjectCode'";
                    $enrollmentResult = mysqli_query($conn, $enrollmentQuery);
                    $enrollmentRow = mysqli_fetch_assoc($enrollmentResult);
                    $enrolledCount = $enrollmentRow['enrolled_count'];
            ?>

            <!-- Subject Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['DescTitle']; ?>
                            <small class="text-secondary overflow-x-hidden">| <?php echo $row['Name']; ?></small>
                        </h5>

                        <div class="d-flex align-items-center mb-3">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-person"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?php echo $enrolledCount; ?>/30</h6>
                                <span class="text-secondary small pt-1">Enrolled Students</span>
                            </div>
                        </div>
                        <div class="d-grid gap-1 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2 enroll-modal" type="button" data-bs-toggle="modal"
                                data-bs-target="#EnrollModal" data-subject-name="<?php echo $row['Name']; ?>"
                                data-subject-code="<?php echo $row['Subject_code']; ?>"
                                data-teacher-code="<?php echo $row['TeacherCode']?>"
                                data-category="<?php echo $row['category']?>"><i class="bi bi-person-add"></i></button>

                            <button class="btn btn-secondary view-modal" type="button" data-bs-toggle="modal"
                                data-bs-target="#ViewModal" data-subject-code="<?php echo $row['Subject_code']; ?>"><i
                                    class="bi bi-eye"></i></button>
                        </div>
                    </div>
                </div>
            </div><!-- End Subject Card -->

            <?php  
    }
?>

            <!-- Enroll Student Modal -->
            <div class="modal fade" id="EnrollModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Enroll Student</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body m-3">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <label for="SubjectName">Subject Name: <span class="fw-bold"
                                            id="modalSubjectName">Subject name here</span></label>
                                    <label for="SubjectCode">Subject Code: <span class="fw-bold"
                                            id="modalSubjectCode">Subject code here</span></label>
                                    <hr>
                                    <label class="fw-bold mb-2">Enter student Details here: </label>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="idNumber" name="id_number"
                                            placeholder="Student ID">
                                        <label for="idNumber">Student ID</label>
                                    </div>
                                    <div class="StudentName" id="StudentName"></div>

                                    <button class="btn btn-primary form-control" id="appendBtn"><i
                                            class="bi bi-person-plus"></i> Add
                                        Student</button>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <form id="enrollForm" action="enroll_student.php" method="POST">
                                        <div id="AddedStudentContainer"></div>
                                        <input type="hidden" id="subjectCode" name="subjectCode">
                                        <input type="hidden" id="teacherCode" name="teacherCode">
                                        <input type="hidden" id="category" name="category">
                                        <button class="btn btn-success form-control" id="enrollBtn" type="submit"
                                            style="display: none;">Enroll List</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                $('.enroll-modal').on('click', function() {
                    var subjectName = $(this).data('subject-name');
                    var subjectCode = $(this).data('subject-code');
                    var teacherCode = $(this).data('teacher-code');
                    var category = $(this).data('category');

                    $('#modalSubjectName').text(subjectName);
                    $('#modalSubjectCode').text(subjectCode);
                    $('#subjectCode').val(subjectCode);
                    $('#teacherCode').val(teacherCode);
                    $('#category').val(category);
                });

                $('#idNumber').on('input', function() {
                    var idNumber = $(this).val();
                    if (idNumber.length > 0) {
                        $.ajax({
                            url: 'fetch_student_details.php',
                            type: 'POST',
                            data: {
                                id_number: idNumber
                            },
                            success: function(response) {
                                $('#StudentName').html(response);
                            }
                        });
                    } else {
                        $('#StudentName').html('');
                    }
                });

                $('#appendBtn').on('click', function() {
                    var idNumber = $('#idNumber').val();
                    var maxInputs = 30;
                    var currentInputs = $('#AddedStudentContainer .input-group').length;

                    if (idNumber.length > 0) {
                        if (currentInputs < maxInputs) {
                            var newInput = `<div class="input-group mb-3">
                                        <input type="text" class="form-control" name="student_ids[]" value="${idNumber}" readonly>
                                        <button class="btn btn-outline-danger removeBtn" type="button"><i class="bi bi-person-dash"></i></button>
                                    </div>`;
                            $('#AddedStudentContainer').append(newInput);
                            $('#idNumber').val('');
                            $('#StudentName').html('');
                            $('#enrollBtn').show();
                        } else {
                            alert('You can only add up to 30 students.');
                        }
                    }
                });

                $(document).on('click', '.removeBtn', function() {
                    $(this).closest('.input-group').remove();
                    if ($('#AddedStudentContainer .input-group').length === 0) {
                        $('#enrollBtn').hide();
                    }
                });
            });
            </script>


            <!-- View Students Modal -->
            <div class="modal fade" id="ViewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="viewModalLabel">View Enrolled Students</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="studentTableContainer">
                                <!-- Table will be populated here via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
            $(document).ready(function() {
                $('.enroll-modal').on('click', function() {
                    var subjectName = $(this).data('subject-name');
                    var subjectCode = $(this).data('subject-code');
                    var teacherCode = $(this).data('teacher-code');
                    var category = $(this).data('category');

                    $('#modalSubjectName').text(subjectName);
                    $('#modalSubjectCode').text(subjectCode);
                    $('#subjectCode').val(subjectCode);
                    $('#teacherCode').val(teacherCode);
                    $('#category').val(category);
                });

                $('.view-modal').on('click', function() {
                    var subjectCode = $(this).data('subject-code');

                    $.ajax({
                        url: 'fetch_enrolled_students.php',
                        type: 'POST',
                        data: {
                            subject_code: subjectCode
                        },
                        success: function(response) {
                            $('#studentTableContainer').html(response);
                            $('#ViewModal').modal('show');
                        }
                    });
                });

                $('#idNumber').on('input', function() {
                    var idNumber = $(this).val();
                    if (idNumber.length > 0) {
                        $.ajax({
                            url: 'fetch_student_details.php',
                            type: 'POST',
                            data: {
                                id_number: idNumber
                            },
                            success: function(response) {
                                $('#StudentName').html(response);
                            }
                        });
                    } else {
                        $('#StudentName').html('');
                    }
                });

                $('#appendBtn').on('click', function() {
                    var idNumber = $('#idNumber').val();
                    var maxInputs = 30;
                    var currentInputs = $('#AddedStudentContainer .input-group').length;

                    if (idNumber.length > 0) {
                        if (currentInputs < maxInputs) {
                            var newInput = `<div class="input-group mb-3">
                            <input type="text" class="form-control" name="student_ids[]" value="${idNumber}" readonly>
                            <button class="btn btn-outline-danger removeBtn" type="button"><i class="bi bi-person-dash"></i></button>
                        </div>`;
                            $('#AddedStudentContainer').append(newInput);
                            $('#idNumber').val('');
                            $('#StudentName').html('');
                            $('#enrollBtn').show();
                        } else {
                            alert('You can only add up to 30 students.');
                        }
                    }
                });

                $(document).on('click', '.removeBtn', function() {
                    $(this).closest('.input-group').remove();
                    if ($('#AddedStudentContainer .input-group').length === 0) {
                        $('#enrollBtn').hide();
                    }
                });
            });
            </script>



        </div>
    </section>
</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>