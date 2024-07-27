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

                        <select class="form-select mb-3" aria-label="Select Category" name="category" required>
                            <option selected>Select Category</option>
                            <option value="A&E Elementary">A&E Elementary</option>
                            <option value="A&E Junior High">A&E Junior High</option>
                            <option value="Basic Literacy">Basic Literacy</option>
                        </select>

                        <select class="form-select mb-3" aria-label="Assign Teacher" name="teacherCode"
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
                                    <th>Descriptive Title</th>
                                    <th>Subject Name</th>
                                    <th>Program Category</th>
                                    <th>Assigned Teacher</th>
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
                                <tr data-id="<?php echo $row['id']; ?>">

                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $row['DescTitle'];?></td>
                                    <td data-name="<?php echo $row['Name'];?>"><?php echo $row['Name'];?></td>
                                    <td>
                                        <?php 
                                    switch ($row['category']) {
                                        case "A&E Elementary":
                                            echo "<span class='badge bg-primary'>A&E Elementary</span>";
                                            break;
                                        case "A&E Junior High":
                                            echo "<span class='badge bg-success'>A&E Junior High</span>";
                                            break;
                                        case "Basic Literacy":
                                            echo "<span class='badge bg-info'>Basic Literacy</span>";
                                            break;
                                        default:
                                            echo "<span class='badge bg-secondary'>No category indicated</span>";
                                            break;
                                    }?>
                                    </td>
                                    <td><?php echo $row['AssignedTeacher']?></td>
                                    <td>
                                        <button class="btn btn-sm btn-primary g-2 view-btn"
                                            data-category="<?php echo $row['category'];?>"
                                            data-name="<?php echo $row['Name'];?>"
                                            data-desctitle="<?php echo $row['DescTitle'];?>"
                                            data-description="<?php echo $row['Description'];?>"
                                            data-teacher="<?php echo $row['AssignedTeacher'];?>">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-secondary"
                                            data-desctitle="<?php echo $row['DescTitle'];?>"
                                            data-description="<?php echo $row['Description'];?>"
                                            data-teacher="<?php echo $row['AssignedTeacher'];?>">
                                            <i class="bi bi-pencil-square"></i></button>
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
                                <p id="modalCategory"></p>
                                <p><strong>Name:</strong> <span id="modalName"></span></p>
                                <p><strong>Description Title:</strong> <span id="modalDescTitle"></span></p>
                                <p><strong>Description:</strong> <span id="modalDescription"></span></p>
                                <p><strong>Assigned Teacher:</strong> <span id="modalTeacher"></span></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Edit Subject Modal -->
                <div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="editSubjectModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editSubjectModalLabel">Edit Subject</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editSubjectForm" method="post" action="edit_subject.php">
                                    <input type="hidden" name="subject_id" id="subjectId">
                                    <div class="mb-3">
                                        <label for="subjectName" class="form-label">Subject Name</label>
                                        <input type="text" class="form-control" id="subjectName" name="subject_name"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descriptiveTitle" class="form-label">Descriptive Title</label>
                                        <input type="text" class="form-control" id="descriptiveTitle"
                                            name="descriptive_title" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="teacherCode" class="form-label">Assign Teacher</label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="teacher_code" id="teacherCode">
                                            <option selected>Assign Teacher</option>
                                            <?php 
                                            // Get teacher list
                                            $query = "SELECT * FROM teachers";
                                            $res = mysqli_query($conn, $query);
                                            while ($teacher = mysqli_fetch_assoc($res)) {
                                                $teacher_name = $teacher['First_name'] .  " " . substr($teacher['Middle_name'], 0, 1) . ". " . $teacher['Last_name'];
                                            ?>
                                            <option value="<?php echo $teacher['ID_Number']?>">
                                                <?php echo $teacher_name?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var viewButtons = document.querySelectorAll('.view-btn');
                    viewButtons.forEach(function(button) {
                        button.addEventListener('click', function() {
                            var category = this.getAttribute('data-category');
                            var badgeClass = '';

                            switch (category) {
                                case 'A&E Elementary':
                                    badgeClass = 'badge bg-primary';
                                    break;
                                case 'A&E Junior High':
                                    badgeClass = 'badge bg-success';
                                    break;
                                case 'Basic Literacy':
                                    badgeClass = 'badge bg-info';
                                    break;
                                default:
                                    badgeClass = 'badge bg-secondary';
                                    break;
                            }
                            var name = this.getAttribute('data-name');
                            var descTitle = this.getAttribute('data-desctitle');
                            var description = this.getAttribute('data-description');
                            var teacher = this.getAttribute('data-teacher');

                            document.getElementById('modalCategory').innerHTML =
                                `<strong>Category:</strong> <span class="${badgeClass}">${category}</span>`;

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

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const editButtons = document.querySelectorAll('.btn-secondary');
                    editButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const row = button.closest('tr');
                            const subjectId = row.dataset.id;
                            const subjectName = row.querySelector('[data-name]').textContent;
                            const descTitle = row.querySelector('[data-desctitle]').textContent;
                            const description = row.querySelector('[data-description]')
                                .textContent;
                            const assignedTeacher = row.querySelector('[data-teacher]')
                                .textContent;

                            document.getElementById('subjectId').value = subjectId;
                            document.getElementById('subjectName').value = subjectName;
                            document.getElementById('descriptiveTitle').value = descTitle;
                            document.getElementById('description').value = description;
                            document.getElementById('teacherCode').value = assignedTeacher;

                            const editSubjectModal = new bootstrap.Modal(document
                                .getElementById('editSubjectModal'));
                            editSubjectModal.show();
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