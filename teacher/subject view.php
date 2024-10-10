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
            <h1><?= $_GET['name']?></h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="subject">Subjects</a></li>
                <li class="breadcrumb-item active"><?= $_GET['name']?></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="pt-2 mb-3">
            <div class="dropdown">
                <button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-plus"></i> Create
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Assignment"><i
                                class="bi bi-clipboard"></i>Assignment</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#NewQuizModal"><i
                                class="bi bi-list-task"></i>
                            Quiz</a></li>
                    <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-check-square"></i> Exam</a></li> -->
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#ModuleMaterialModal"><i class="bi bi-file-earmark-text"></i> Module</a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#NewLessonTopic">
                            <i class="bi bi-list-columns"></i> Topic</a></li>
                </ul>
            </div>
        </div>
        <?php 
        include 'modals.php';
        ?>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <?php 
                // Get Lesson

                $classCode = $_GET['ref'];
                $teacher = $_SESSION['user_id'];

                $stmt = $conn->prepare("SELECT * FROM topics WHERE ClassCode = ? AND TeacherCode = ?");
                $stmt->bind_param("ss", $classCode, $teacher);
                $stmt->execute();
                $get_lesson = $stmt->get_result();

                if ($get_lesson && $get_lesson->num_rows > 0) {
                    while ($row = $get_lesson->fetch_assoc()) {
                     ?>
                <!-- Lesson Card -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['Title']?></h5>
                    </div>
                    <div class="card-footer">

                        <!-- Activities -->
                        <?php 
                            $topicId = $row['Tp_ID'];  // Ensure $row is populated earlier in your script
                            // $classCode = $_GET['ref'];
                            $stmtActivities = $conn->prepare("
                            SELECT 
                                a.id, a.title, a.description, a.file_name, a.students_group, 
                                a.points_option, a.points, a.due_option, a.due_date, 
                                a.topic, a.class_code, a.teacher_code, a.created_at,
                                m.id AS module_id, m.title AS module_title, m.description AS module_desc,
                                m.topic_id AS module_topic_id, m.class_code AS module_class_code, m.file_name AS module_file,
                                m.teacher_code AS module_teacher_code, m.created_at AS module_created_at
                            FROM 
                                `assignments` a
                            LEFT JOIN 
                                `modules` m
                            ON 
                                a.topic = m.topic_id AND a.class_code = m.class_code
                            WHERE 
                                a.topic = ? AND a.class_code = ?
                            UNION
                            SELECT 
                                a.id, a.title, a.description, a.file_name, a.students_group, 
                                a.points_option, a.points, a.due_option, a.due_date, 
                                a.topic, a.class_code, a.teacher_code, a.created_at,
                                m.id AS module_id, m.title AS module_title, m.description AS module_desc,
                                m.topic_id AS module_topic_id, m.class_code AS module_class_code, m.file_name AS module_file,
                                m.teacher_code AS module_teacher_code, m.created_at AS module_created_at
                            FROM 
                                `modules` m
                            LEFT JOIN 
                                `assignments` a
                            ON 
                                a.topic = m.topic_id AND a.class_code = m.class_code
                            WHERE 
                                m.topic_id = ? AND m.class_code = ?
                        ");
                        $stmtActivities->bind_param("ssss", $topicId, $classCode, $topicId, $classCode);
                        $stmtActivities->execute();
                        $get_activities = $stmtActivities->get_result();
                            if ($get_activities && $get_activities->num_rows > 0) {
                                while ($act = $get_activities->fetch_assoc()) {
                                    // Assuming you have a column like 'file_name' or 'attachment' that holds the file path or URL
                                    $file_name = $act['file_name'] ?? null; 
                        ?>
                        <!-- Activities and modules -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-<?php echo $act['id'] . '-' . date('Y-m-d', strtotime($act['created_at'])); ?>"
                                        aria-expanded="false"
                                        aria-controls="flush-<?php echo $act['id'] . '-' . date('Y-m-d', strtotime($act['created_at'])); ?>">
                                        <?= $act['title'] ?? $act['module_title']?>
                                        <!-- Ensure title exists in the result set -->
                                    </button>
                                </h2>
                                <div id="flush-<?php echo $act['id'] . '-' . date('Y-m-d', strtotime($act['created_at'])); ?>"
                                    class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <!-- Replace this placeholder with actual content -->
                                        <?= ($act['description'] ?? 'No description available.') ?? ($act['module_desc'] ?? 'No description available.') ?>
                                        <?php if ($file_name): ?>
                                        <!-- Display the clickable button or file preview -->
                                        <div class="mt-3">
                                            <a href="<?= $file_name ?>" class="btn btn-primary" target="_blank">View
                                                Attachment</a>
                                            <!-- Optional file preview, e.g., for images or PDFs -->
                                            <?php if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file_name)): ?>
                                            <div class="mt-2">
                                                <img src="<?= $file_name ?>" alt="Attachment Preview" class="img-fluid"
                                                    style="max-width: 100%;">
                                            </div>
                                            <?php elseif (preg_match('/\.(pdf)$/i', $file_name)): ?>
                                            <div class="mt-2">
                                                <embed src="<?= $file_name ?>" type="application/pdf" width="100%"
                                                    height="400px" />
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Activities -->
                        <?php 
                                }
                            } else {
                                echo "No activities found for this module.";  // You can customize this message
                            }
                        ?>

                    </div>
                </div><!-- End Lesson Card -->
                <?php 

                    }
                }
                ?>

            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';