<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ALS Management System</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/favicon.ico" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="index-page">
    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1 class="sitename">ALS Management System</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="index.html" class="active">Home<br /></a>
                    </li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="get-a-quote.html">Admin Log in</a>
        </div>
    </header>

    <?php 
    include_once 'alert.php';
    ?>

    <main class="main">
        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <img src="assets/img/brooke-cagle-g1Kr4Ozfoac-unsplash.jpg" alt="" class="hero-bg" data-aos="fade-in" />
            <div class="overlay"></div>

            <div class="container">
                <div class="row gy-2 d-flex justify-content-between">
                    <div class="col-lg-8 order-2 order-lg-1 d-flex flex-column justify-content-center">

                    </div>
                    <div class="col-lg-4 order-2 order-lg-1 d-flex flex-column justify-content-center">

                        <div class="card pb-3">
                            <div class="card-body">
                                <div class="pt-3">
                                    <h5 class="card-title text-center pb-0 fs-4">
                                        Login to Your Account
                                    </h5>
                                    <p class="text-center small">
                                        Enter your ID Number & password to login
                                    </p>
                                </div>

                                <form class="row g-3 needs-validation px-3" novalidate>

                                    <div class="d-flex gap-3 justify-content-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault1" checked>
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Student
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault"
                                                id="flexRadioDefault2">
                                            <label class="form-check-label" for="flexRadioDefault2">
                                                Teacher
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">ID Number</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">#</span>
                                            <input type="text" name="idNumber" class="form-control form-control-sm"
                                                id="yourUsername" required />
                                            <div class="invalid-feedback">
                                                Please enter your ID Number.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword"
                                            required>
                                        <span hidden="hidden" class="field-icon toggle-password bi bi-eye-fill"
                                            id="icon"
                                            style="position: absolute; right: 45px; transform: translate(0, -50%); top: 61.5%; cursor: pointer;"></span>
                                    </div>

                                    <script src="assets/js/password.js"></script>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true"
                                                id="rememberMe" />
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">
                                            Login
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">
                                            Don't have account?
                                            <a href="pages-register.html">Request Here</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                        <!-- <img
                src="assets/img/hero-img.svg"
                class="img-fluid mb-3 mb-lg-0"
                alt=""
              /> -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /Hero Section -->
    </main>

    <footer id="footer" class="footer">
        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-12 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">ALS Management System</span>
                    </a>
                    <p>
                        Cras fermentum odio eu feugiat lide par naso tierra. Justo eget
                        nada terra videa magna derita valies darta donna mare fermentum
                        iaculis eu non diam phasellus.
                    </p>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About us</a></li>
                        <li><a href="#">Terms of service</a></li>
                        <li><a href="#">Privacy policy</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
                    <h4>Contact Us</h4>
                    <p>A108 Adam Street</p>
                    <p>New York, NY 535022</p>
                    <p>United States</p>
                    <p class="mt-4">
                        <strong>Phone:</strong> <span>+1 5589 55488 55</span>
                    </p>
                    <p><strong>Email:</strong> <span>info@example.com</span></p>
                </div>
            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>
                © <span>Copyright</span>
                <strong class="px-1 sitename">ALS Management System</strong>
                <span>All Rights Reserved</span>
            </p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>