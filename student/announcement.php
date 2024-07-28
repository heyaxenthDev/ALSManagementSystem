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
        <h1>Announcements</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Announcements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <?php 
            // Get Announcements Posted by the enrolled subjects
            $student_id = $_SESSION['user_id'];


            $stmt = $conn->prepare("SELECT a.id,a.Title,a.Content,a.SubjectCode,a.forDate,a.Type,a.TeacherCode,a.VirtualLink,a.date_created
                        FROM announcement a JOIN  enrollments e ON a.SubjectCode = e.subjectCode WHERE e.studentID = ?");
            $stmt->bind_param('s', $student_id);
            $stmt->execute();
            $get_anc = $stmt->get_result();

            if ($get_anc && $get_anc->num_rows > 0) {
                while ($row = $get_anc->fetch_assoc()) {
                    $originalDate = $row['forDate'];
                    $date = new DateTime($originalDate);
                    $readableDate = $date->format('F j, Y g:i A');

                    switch ($row['Type']) {
                        case 'No Class':
                            $span = "text-danger fw-bold";
                            break;
                        case 'Virtual Class':
                            $span = "text-warning fw-bold";
                            break;
                        default:
                            $span = "text-secondary fw-bold";
                            break;
                    }

        ?>

        <!-- Announcement -->
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><?= $row['Title']?> | <span class="<?= $span?>"><?= $row['Type']?></span>
                    </h5>
                    <h5 class="card-title"><?= $readableDate;?></h5>
                </div>
                <?= $row['Content']?>


            </div>

            <?php
                if ($row['Type'] == "Virtual Class") {
                    ?>
            <div class="card-footer">
                <a class="btn btn-outline-success" href="<?= $row['VirtualLink']?>" target="_blank"><i
                        class="bi bi-camera-video"></i>
                    Join Meet
                    Now</a>
            </div>
            <?php
                }else{
                    
                }
                ?>

        </div><!-- End Announcement -->
        <?php
                }
            }
        ?>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>