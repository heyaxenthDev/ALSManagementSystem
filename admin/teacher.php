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
            <h1>Teacher List</h1>
            <button class="btn action-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i
                    class="bi bi-plus-circle"></i> Add Teacher</button>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                <li class="breadcrumb-item active">Teacher</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New Teacher</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="code.php" method="POST">

                    <div class="modal-body">

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="idNumber" name="id_number"
                                placeholder="ID Number">
                            <label for="idNumber">ID Number</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="firstName" name="first_name"
                                placeholder="Firstname">
                            <label for="firstName">First Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="middleName" name="middle_name"
                                placeholder="Lastname">
                            <label for="middleName">Middle Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="lastName" name="last_name"
                                placeholder="Lastname">
                            <label for="lastName">Last Name</label>
                        </div>

                        <!-- <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username">
                        </div> -->

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="AddTeacher"><i class="bi bi-floppy"></i>
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

                        <!-- Techers Data Table -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Number</th>
                                    <th>
                                        <b>N</b>ame
                                    </th>
                                    <th>Username</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                // Fetch data from the teachers table

                                $query = "SELECT * FROM `teachers`";
                                $result = mysqli_query($conn, $query);
                                
                                $counter = 1;
                                while($row = mysqli_fetch_assoc($result)){
                                ?>
                                <tr>
                                    <td><?php echo $counter++ ?></td>
                                    <td><?php echo $row['ID_Number']?></td>
                                    <td><?php echo $row['First_name'] . " " . $row['Last_name']?></td>
                                    <td><?php echo $row['username']?></td>
                                    <td>
                                        <button class="btn btn-primary btn-sm g-2"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-secondary btn-sm"><i
                                                class="bi bi-pencil-square"></i></button>
                                    </td>
                                </tr>
                                <?php 
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- End Techers Data Table -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>