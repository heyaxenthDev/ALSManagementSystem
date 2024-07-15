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
            <h1>Subject List</h1>
            <button class="btn action-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                    class="bi bi-plus-circle"></i> Add Subject</button>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Subject</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Subject</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">

                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="subjectName" name="subject_name"
                                placeholder="Subject Name">
                            <label for="subjectName">Subject Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="descriptiveTitle" name="descriptive_title"
                                placeholder="Descriptive Title">
                            <label for="descriptiveTitle">Descriptive Title</label>
                        </div>

                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="description" name="description" placeholder="Description"
                                style="height: 100px"></textarea>
                            <label for="description">Description</label>
                        </div>



                        <select class="form-select" aria-label="Default select example" name="teacherCode"
                            id="teacherCode">
                            <option selected>Assign Teacher</option>
                            <?php 
                            // Get teacher List
                            $query = "SELECT * FROM teachers";
                            $res = mysqli_query($conn, $query);

                            while ($teacher = mysqli_fetch_assoc($res)) {
                                $teacher_name = $teacher['First_name'] .  " " . substr($teacher['Middle_name'], 0, 1) . ". " . $teacher['Last_name'];
                            ?>
                            <option value="<?php echo $teacher['ID_Number']?>"><?php echo $teacher_name?></option>
                            <?php
                            }
                        ?>
                        </select>



                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="AddSubject"><i class="bi bi-floppy"></i>
                            Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <!-- End Modal -->

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
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                // Fetch data from the subject table
                                $query = "SELECT * FROM `subjects`";
                                $results = mysqli_query($conn, $query);
                                
                                $counter = 1;
                                while($row = mysqli_fetch_assoc($results)){
                                ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $row['Name'];?></td>
                                    <td><?php echo $row['DescTitle'];?></td>
                                    <td><?php echo $row['Description']?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary g-2 view-btn"
                                            data-name="<?php echo $row['Name'];?>"
                                            data-desctitle="<?php echo $row['DescTitle'];?>"
                                            data-description="<?php echo $row['Description'];?>"
                                            data-teacher="<?php echo $row['AssignedTeacher'];?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary"><i
                                                class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Subject Table -->

                    </div>
                </div>

                <!-- View Modal -->
                <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewModalLabel">Subject Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Name:</strong> <span id="modalName"></span></p>
                                <p><strong>Description Title:</strong> <span id="modalDescTitle"></span></p>
                                <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                                <p><strong>Assigned Teacher:</strong> <span id="modalTeacher"></span></p>

                                <p><strong>Class List:</strong></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var viewButtons = document.querySelectorAll('.view-btn');
                    viewButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var name = this.getAttribute('data-name');
                            var descTitle = this.getAttribute('data-desctitle');
                            var description = this.getAttribute('data-description');
                            var teacher = this.getAttribute('data-teacher');

                            document.getElementById('modalName').textContent = name;
                            document.getElementById('modalDescTitle').textContent = descTitle;
                            document.getElementById('modalDescription').textContent =
                                description;
                            document.getElementById('modalTeacher').textContent = (teacher ===
                                "" || teacher === null) ? "No Assigned Teacher" : teacher;

                            var viewModal = new bootstrap.Modal(document.getElementById(
                                'viewModal'));
                            viewModal.show();
                        });
                    });
                });
                </script>



            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>