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
        <h1 id="greeting"><?= "Good day, ". $fname ?>!</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="home">Home</a></li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <script>
    function getGreeting() {
        const now = new Date();
        const hours = now.getHours();
        let greeting;

        if (hours < 12) {
            greeting = "Good morning";
        } else if (hours < 18) {
            greeting = "Good afternoon";
        } else {
            greeting = "Good evening";
        }

        return greeting;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const greetingElement = document.getElementById('greeting');
        const currentGreeting = greetingElement.textContent;
        const newGreeting = getGreeting() + currentGreeting.substring(currentGreeting.indexOf(','));
        greetingElement.textContent = newGreeting;
    });
    </script>

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">

                    <!-- Students Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card sales-card">



                            <div class="card-body">
                                <h5 class="card-title">Students</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>14</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Students Card -->

                    <!-- Teachers Card -->
                    <div class="col-xxl-3 col-md-6">
                        <div class="card info-card revenue-card">



                            <div class="card-body">
                                <h5 class="card-title">Teachers</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-pen"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>1</h6>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Teachers Card -->

                    <!-- Exams Card -->
                    <div class="col-xxl-3 col-md-6">

                        <div class="card info-card customers-card">



                            <div class="card-body">
                                <h5 class="card-title">Exams</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>4</h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Exams Card -->

                    <!-- Subjects Card -->
                    <div class="col-xxl-3 col-md-6">

                        <div class="card info-card subject-card">



                            <div class="card-body">
                                <h5 class="card-title">Subjects</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-book"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>3</h6>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Subjects Card -->

                </div>
            </div><!-- End Left side columns -->

        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>