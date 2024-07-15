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
        <h1>Class</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Class</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>