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

                            <div class="row mb-4 mt-2">
                                <div class="col-lg-12 col-md-12">
                                    <center>
                                        <img id="newsPicturePreview" src="assets/img/undraw_Newspaper_re_syf5.png"
                                            alt="Announcements Picture Preview"
                                            style="max-width: 100%; max-height: 300px;">
                                    </center>
                                    <small class="mt-2">Add Announcements Picture</small>
                                    <input type="file" name="newsPicture" class="form-control" id="newsPicture"
                                        onchange="previewNewsPicture();" accept="image/*" required>
                                </div>
                                <script src="js/scripts.js"></script>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-2">
                                    <label for="newsTitle" class="form-label">Announcements Title</label>
                                    <input type="text" name="newsTitle" class="form-control" id="newsTitle" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 mb-2">
                                    <label for="newsContent" class="form-label">Announcements Content</label>
                                    <textarea name="newsContent" class="form-control" id="newsContent" rows="2"
                                        required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 mb-2">
                                    <label for="publicationDate" class="form-label">Publication Date</label>
                                    <input type="date" name="publicationDate" class="form-control" id="publicationDate"
                                        required>
                                </div>

                                <div class="col-lg-6 col-md-6 mb-2">
                                    <label for="newsStatus" class="form-label">Announcements Status</label>
                                    <select name="newsStatus" class="form-select" id="newsStatus" required>
                                        <option value="">Select Status</option>
                                        <option value="1" class="text-success">Published</option>
                                        <option value="2" class="text-primary">Draft</option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                                <button class="btn rounded-5 text-white" type="submit"
                                    style="background-color: #013220;" name="addNewNews"><i
                                        class="bi bi-plus-circle"></i> Add New Announcements</button>
                            </div>
                        </form>

                        <!-- End Announcements Form Elements -->

                    </div>
                </div>

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
                                    <th scope="col">Publication Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

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