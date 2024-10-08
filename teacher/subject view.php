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
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#ModuleModal"><i
                                class="bi bi-file-earmark-text"></i> Module</a></li>
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
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-<?php echo $row['Tp_ID']?>" aria-expanded="false"
                                        aria-controls="flush-<?php echo $row['Tp_ID']?>">
                                        Activity 1
                                    </button>
                                </h2>
                                <div id="flush-<?php echo $row['Tp_ID']?>" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">Placeholder content for this accordion, which is
                                        intended to demonstrate the <code>.accordion-flush</code> class. This is the
                                        second item's accordion body. Let's imagine this being filled with some actual
                                        content.</div>
                                </div>
                            </div>
                        </div><!-- End Activities -->

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
?>