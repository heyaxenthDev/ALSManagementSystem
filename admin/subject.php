<?php
// include 'authentication.php';
//checkLogin(); // Call the function to check if the user is logged in
session_start();
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
                                </tr>
                                <?php 
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