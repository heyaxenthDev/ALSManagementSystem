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
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Announcements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Post New Announcements</h5>

                        <!-- Announcements Form Elements -->
                        <form class="row g-3" method="POST" action="code.php" enctype="multipart/form-data">

                            <div class="row mb-3 mt-3">
                                <select class="form-select" aria-label="Select Class" name="classAnc" id="classAnc">
                                    <option selected>Select Class for Announcement</option>
                                    <?php 
                                    // Assuming $conn is your database connection and $code is properly escaped and sanitized
                                    $teacherCode = $_SESSION['user_id'];

                                    // Use prepared statement for the first query to prevent SQL injection
                                    $query = "SELECT * FROM subjects WHERE TeacherCode = ?";
                                    $stmt1 = $conn->prepare($query);
                                    $stmt1->bind_param("s", $teacherCode);
                                    $stmt1->execute();
                                    $res = $stmt1->get_result();

                                    if ($res->num_rows > 0) {
                                        while ($class = $res->fetch_assoc()) {
                                    ?>
                                    <option
                                        value="<?php echo htmlspecialchars($class['Subject_code'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo htmlspecialchars($class['Name'], ENT_QUOTES, 'UTF-8'); ?>
                                    </option>
                                    <?php
                                        }
                                    } else {
                                        echo "No classes found for the given teacher code.";
                                    }

                                    $stmt1->close(); // Close the first statement
                                    ?>


                                </select>
                            </div>

                            <div class="row mb-3">
                                <select name="typeAnc" id="typeAnc" class="form-select">
                                    <option selected>Select Announcement Type</option>
                                    <option value="Virtual Class">Virtual Class</option>
                                    <option value="No Class">No Class</option>
                                    <option value="Regular Announcement">Regular Announcement</option>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-2">
                                    <label for="AncTitle" class="form-label">Announcement Title</label>
                                    <input type="text" name="AncTitle" class="form-control" id="AncTitle" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-2">
                                    <label for="AncContent" class="form-label">Announcement Content</label>
                                    <textarea name="AncContent" class="form-control" id="AncContent" rows="2"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-2">
                                    <label for="AncDate" class="form-label">Date</label>
                                    <input type="datetime-local" name="AncDate" class="form-control" id="AncDate"
                                        required>
                                </div>
                            </div>

                            <div class="row d-none" id="showInputLink">
                                <div class="col-md-12 col-lg-12 mb-2">
                                    <label for="virtualLink" class="form-label">Virtual Link</label>
                                    <input type="text" id="virtualLink" name="virtualLink" class="form-control">
                                    <small>Get Link here: <span><a href="https://meet.google.com/"
                                                target="_blank">Google Meet</a> | <a href="https://zoom.us/"
                                                target="_blank">Zoom</a></span></small>
                                </div>
                            </div>


                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button class="btn rounded-5 btn-primary" type="submit" name="CreateAnnouncement"><i
                                        class="bi bi-plus-circle"></i> Create Announcement</button>
                            </div>
                        </form>

                        <!-- End Announcements Form Elements -->

                    </div>
                </div>

                <script>
                $(document).ready(function() {
                    $('#typeAnc').on('keyup change', function() {
                        var selectType = $(this).val();
                        if (selectType ==
                            "Virtual Class") { // Optionally, add conditions to check for specific types
                            $('#showInputLink').removeClass('d-none');
                            $('#virtualLink').attr('required');

                        }
                    });
                });
                </script>

            </div>

            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Announcements currently posted</h5>
                        <p>add modal view for the details of the news and update.</p>

                        <!-- Table for news posted rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Announcements Title</th>
                                    <th scope="col">Class Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Get Posted Announcement
                                $tc = $_SESSION['user_id'];

                                $anc = "SELECT * FROM announcement WHERE TeacherCode = '$tc'";
                                $show = mysqli_query($conn, $anc);
                                $count = 1;
                                while ($list = mysqli_fetch_assoc($show)) {
                                    
                                ?>
                                <tr>
                                    <td><?= $count++ ?></td>
                                    <td><?= $list['Title']?></td>
                                    <td><?= $list['SubjectCode']?></td>
                                    <td><?= $list['Type']?></td>
                                    <td><?= $list['forDate']?></td>
                                    <td></td>
                                    <td>
                                        <button class="btn btn-danger btn-sm g-2"><i
                                                class="bi bi-dash-circle"></i></button>
                                        <button class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table><!-- End Table for news posted rows -->

                    </div>
                </div>

                <div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="newsModalLabel">View & Edit Announcements</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Announcements details will be loaded here dynamically via AJAX -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>