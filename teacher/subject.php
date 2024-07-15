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
            <h1>Subjects</h1>
        </div>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Subjects</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

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
                                        <button class="btn btn-sm btn-primary g-2"><i class="bi bi-eye"></i></button>
                                        <button class="btn btn-sm btn-success"><i class="bi bi-pen"></i></button>
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

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>