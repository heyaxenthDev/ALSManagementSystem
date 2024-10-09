        <!-- Assignment Modal -->
        <div class="modal fade" id="Assignment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="AssignmentModal" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">

                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn-close me-3" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h1 class="modal-title fs-5 text-primary fw-semibold" id="AssignmentModal">
                                <i class="bi bi-clipboard"></i> Assignment
                            </h1>
                        </div>
                        <form action="code.php" method="POST" enctype="multipart/form-data">
                            <div>
                                <button class="btn btn-success add-assign" type="submit" name="add-assign">
                                    Post <i class="ri ri-arrow-drop-right-fill"></i>
                                </button>
                            </div>
                    </div>

                    <div class="modal-body m-2">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body pt-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="assTitle" name="assTitle"
                                                placeholder="Title">
                                            <label for="assTitle">Title</label>
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Add a short Description"
                                                id="floatingShortDesc" name="shortDesc"
                                                style="height: 120px"></textarea>
                                            <label for="floatingShortDesc">Instructions (Optional)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <h4 class="card-title mx-3">Attachments</h4>
                                    <div class="card-body text-center">
                                        <label for="uploadModule" class="btn btn-primary mt-3">
                                            <i class="bi bi-upload"></i> Upload Module/Document
                                        </label>
                                        <input type="file" id="uploadModule" name="uploadModule" style="display: none;">
                                        <div id="fileName" class="mt-3"></div>
                                    </div>
                                </div>

                                <script>
                                $(document).ready(function() {
                                    $('#uploadModule').on('change', function() {
                                        var fileName = $(this).val().split('\\').pop();
                                        $('#fileName').html('<strong>Selected file:</strong> ' +
                                            fileName);
                                    });
                                });
                                </script>

                            </div>

                            <div class="col-md-5">
                                <div class="card p-2">
                                    <div class="card-body">
                                        <h4 class="card-title">For</h4>
                                        <div class="row">
                                            <select name="selectStudentsFor" id="selectStudentsFor" class="form-select">
                                                <option value="All Students">All Students</option>
                                                <option value="Another Option Here">Another Option Here</option>
                                            </select>
                                        </div>

                                        <h4 class="card-title">Points</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <select class="form-select" id="pointsOption" name="pointsOption">
                                                    <option value="ungraded">Ungraded</option>
                                                    <option value="graded">Graded</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-none" id="pointsInput">
                                                <input type="number" class="form-control" placeholder="Enter points"
                                                    name="pointsInput">
                                            </div>
                                        </div>

                                        <h4 class="card-title">Due</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <select class="form-select" id="dueOption" name="dueOption">
                                                    <option value="none">No Due Date</option>
                                                    <option value="dueDate">Due Date</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 d-none" id="dueInput">
                                                <input type="date" class="form-control" name="dueInput">
                                            </div>
                                        </div>

                                        <h4 class="card-title">Topic</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-12">

                                                <select class="form-select" id="topicOption" name="topicOption"
                                                    required>
                                                    <option selected>No Topic</option>
                                                    <?php 
                                                    // Get Topics from database

                                                    $classCode = $_GET['ref'];
                                                    $teacher = $_SESSION['user_id'];

                                                    $stmt = $conn->prepare("SELECT * FROM topics WHERE ClassCode = ? AND TeacherCode = ?");
                                                    $stmt->bind_param("ss", $classCode, $teacher);
                                                    $stmt->execute();
                                                    $get_topics = $stmt->get_result();

                                                    if ($get_topics && $get_topics->num_rows > 0) {
                                                        while ($row = $get_topics->fetch_assoc()) {
                                                ?>
                                                    <option value="<?= $row['Tp_ID']?>"><?= $row['Title']?></option>
                                                    <?php 
                                                        }
                                                    }
                                                ?>
                                                </select>

                                            </div>
                                            <input type="hidden" name="classCode" id="classCode"
                                                value="<?= $_GET['ref']?>">
                                            <input type="hidden" name="teacherCode" id="teacherCode"
                                                value="<?= $_SESSION['user_id']?>">

                                            <div class="col-md-6 d-none" id="topicInput">
                                                <input type="text" class="form-control" placeholder="Enter topic">
                                            </div>
                                        </div>
                                    </div>

                                    <script>
                                    $(document).ready(function() {
                                        $('#pointsOption').on('change', function() {
                                            if ($(this).val() === 'graded') {
                                                $('#pointsInput').removeClass('d-none');
                                            } else {
                                                $('#pointsInput').addClass('d-none');
                                            }
                                        });

                                        $('#dueOption').on('change', function() {
                                            if ($(this).val() === 'dueDate') {
                                                $('#dueInput').removeClass('d-none');
                                            } else {
                                                $('#dueInput').addClass('d-none');
                                            }
                                        });
                                    });
                                    </script>

                                </div>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Quiz Modal -->
        <div class="modal fade" id="NewQuizModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="QuizModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn-close me-3" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h1 class="modal-title fs-5 text-primary fw-semibold" id="QuizModalLabel"><i
                                    class="bi bi-list-task"></i>
                                Quiz</h1>
                        </div>
                        <div>
                            <button class="btn btn-success">
                                Post <i class="ri ri-arrow-drop-right-fill"></i>
                            </button>
                        </div>
                    </div>

                    <form action="code.php" method="POST">
                        <div class="modal-body m-2">
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body pt-3">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="assTitle" name="assTitle"
                                                    placeholder="Title">
                                                <label for="assTitle">Title</label>
                                            </div>
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Add a short Description"
                                                    id="floatingShortDesc" name="shortDesc"
                                                    style="height: 120px"></textarea>
                                                <label for="floatingShortDesc">Instructions (Optional)</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <h4 class="card-title mx-3">Questions</h4>
                                        <div class="card-body d-flex justify-content-center">
                                            <a class="btn btn-primary" target="_blank"
                                                href="questionaire?ref=<?= $_GET['ref']?>&name=<?= $_GET['name']?>">Create
                                                Questionare <i class="bi bi-arrow-bar-right"></i></a>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-5">
                                    <div class="card p-2">
                                        <div class="card-body">
                                            <h4 class="card-title">For</h4>
                                            <div class="row">
                                                <select name="selectStudentsFor" id="selectStudentsFor"
                                                    class="form-select">
                                                    <option value="All Students">All Students</option>
                                                    <option value="Another Option Here">Another Option Here</option>
                                                </select>
                                            </div>

                                            <h4 class="card-title">Points</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <select class="form-select" id="pointsOption">
                                                        <option value="ungraded">Ungraded</option>
                                                        <option value="graded">Graded</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-none" id="pointsInput">
                                                    <input type="number" class="form-control"
                                                        placeholder="Enter points">
                                                </div>
                                            </div>

                                            <h4 class="card-title">Due</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <select class="form-select" id="dueOption">
                                                        <option value="none">No Due Date</option>
                                                        <option value="dueDate">Due Date</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-none" id="dueInput">
                                                    <input type="date" class="form-control">
                                                </div>
                                            </div>

                                            <h4 class="card-title">Topic</h4>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <select class="form-select" id="topicOption">
                                                        <option selected>No Topic</option>
                                                        <?php 
                                                    // Get Topics from database

                                                    $classCode = $_GET['ref'];
                                                    $teacher = $_SESSION['user_id'];

                                                    $stmt = $conn->prepare("SELECT * FROM topics WHERE ClassCode = ? AND TeacherCode = ?");
                                                    $stmt->bind_param("ss", $classCode, $teacher);
                                                    $stmt->execute();
                                                    $get_topics = $stmt->get_result();

                                                    if ($get_topics && $get_topics->num_rows > 0) {
                                                        while ($row = $get_topics->fetch_assoc()) {
                                                ?>
                                                        <option value="<?= $row['Title']?>"><?= $row['Title']?></option>
                                                        <?php 
                                                        }
                                                    }
                                                ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 d-none" id="topicInput">
                                                    <input type="text" class="form-control" placeholder="Enter topic">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Module/Material Modal -->
        <div class="modal fade" id="ModuleMaterialModal" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="ModuleMaterialModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <button type="button" class="btn-close me-3" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h1 class="modal-title fs-5 text-primary fw-semibold" id="ModuleMaterialModalLabel">
                                <i class="bi bi-file-earmark-text"></i> Module/Material
                            </h1>
                        </div>
                        <form action="submit_module_material.php" method="POST" enctype="multipart/form-data">

                            <div>
                                <button class="btn btn-success post-module-btn" name="add-module" type="submit">
                                    Post <i class="ri ri-arrow-drop-right-fill"></i>
                                </button>
                            </div>
                    </div>

                    <div class="modal-body m-2">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="card">
                                    <div class="card-body pt-3">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="moduleTitle" name="moduleTitle"
                                                placeholder="Title">
                                            <label for="moduleTitle">Title</label>
                                        </div>
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Add a short Description"
                                                id="moduleShortDesc" name="moduleShortDesc"
                                                style="height: 120px"></textarea>
                                            <label for="moduleShortDesc">Instructions (Optional)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <h4 class="card-title mx-3">Attachments</h4>
                                    <div class="card-body text-center">
                                        <label for="uploadModuleMaterial" class="btn btn-primary mt-3">
                                            <i class="bi bi-upload"></i> Upload Module/Document
                                        </label>
                                        <input type="file" id="uploadModuleMaterial" name="uploadModuleMaterial"
                                            style="display: none;">
                                        <div id="moduleFileName" class="mt-3"></div>
                                    </div>
                                </div>

                                <script>
                                $(document).ready(function() {
                                    $('#uploadModuleMaterial').on('change', function() {
                                        var fileName = $(this).val().split('\\').pop();
                                        $('#moduleFileName').html('<strong>Selected file:</strong> ' +
                                            fileName);
                                    });
                                });
                                </script>

                            </div>

                            <div class="col-md-5">
                                <div class="card p-2">
                                    <div class="card-body">
                                        <h4 class="card-title">For</h4>
                                        <div class="row">
                                            <select name="moduleSelectStudentsFor" id="moduleSelectStudentsFor"
                                                class="form-select">
                                                <option value="All Students">All Students</option>
                                                <option value="Another Option Here">Another Option Here</option>
                                            </select>
                                        </div>

                                        <h4 class="card-title">Topic</h4>
                                        <div class="row mb-3">
                                            <div class="col-md-12">

                                                <select class="form-select" id="moduleTopicOption"
                                                    name="moduleTopicOption">
                                                    <option selected>No Topic</option>
                                                    <?php 
                                            // Get Topics from database

                                            $classCode = $_GET['ref'];
                                            $teacher = $_SESSION['user_id'];

                                            $stmt = $conn->prepare("SELECT * FROM topics WHERE ClassCode = ? AND TeacherCode = ?");
                                            $stmt->bind_param("ss", $classCode, $teacher);
                                            $stmt->execute();
                                            $get_topics = $stmt->get_result();

                                            if ($get_topics && $get_topics->num_rows > 0) {
                                                while ($row = $get_topics->fetch_assoc()) {
                                        ?>
                                                    <option value="<?= $row['Tp_ID']?>"><?= $row['Title']?></option>
                                                    <?php 
                                                }
                                            }
                                        ?>
                                                </select>

                                            </div>
                                            <input type="hidden" name="moduleClassCode" id="moduleClassCode"
                                                value="<?= $_GET['ref']?>">
                                            <input type="hidden" name="moduleTeacherCode" id="moduleTeacherCode"
                                                value="<?= $_SESSION['user_id']?>">

                                            <div class="col-md-6 d-none" id="moduleTopicInput">
                                                <input type="text" class="form-control" placeholder="Enter topic">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- New Lesson Modal -->
        <div class="modal fade" id="NewLessonTopic" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="NewTopicModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="NewTopicModal">Add New Topic |
                            Lesson</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="code.php" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="classCode" value="<?php echo $_GET['ref']?>">
                            <input type="hidden" name="teacherCode" value="<?php echo $_SESSION['user_id']?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingTitle" name="Title"
                                    placeholder="Lesson 1">
                                <label for="floatingTitle">Topic | Lesson Title</label>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Add a short Description"
                                    id="floatingShortDesc" name="shortDesc" style="height: 100px"></textarea>
                                <label for="floatingShortDesc">Short Description about the lesson...</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" name="CreateLesson">Create Lesson</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- <script src="assets/js/form-submit.js"></script> -->
        <!-- <script src="assets/js/module-upload.js"></script> -->