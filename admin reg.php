<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Register - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <?php 
    include_once 'alert.php';
    ?>
    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="d-flex justify-content-center py-4">
                                        <a href="index" class="logo d-flex align-items-center w-auto">
                                            <img src="assets/img/alternative-learning-system-als-logo-7670AA4CFE-seeklogo.com.png"
                                                alt="">
                                            <span>Management System</span>
                                        </a>
                                    </div><!-- End Logo -->

                                    <div class="pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>

                                    <form class="row g-3 needs-validation" novalidate action="login-code.php"
                                        method="POST">
                                        <div class="col-12">
                                            <label for="adminID" class="form-label">Admin ID</label>
                                            <input type="text" name="adminID" class="form-control" id="adminID"
                                                required>
                                            <div class="invalid-feedback">Please enter your Admin ID!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="firstname" class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname"
                                                required>
                                            <div class="invalid-feedback">Please enter your firstname!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="lastname" class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname"
                                                required>
                                            <div class="invalid-feedback">Please enter your lastname!</div>
                                        </div>

                                        <div class="col-12">
                                            <label for="middlename" class="form-label">Middlename</label>
                                            <input type="text" name="middlename" class="form-control" id="middlename">
                                            <div class="invalid-feedback">Please enter your middlename!</div>
                                        </div>

                                        <!-- <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div> -->

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit" name="adminReg">Create
                                                Account</button>
                                        </div>

                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a href="index">Log in</a>
                                            </p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Template Main JS File -->
    <script src="assets/js/admin.js"></script>

</body>

</html>