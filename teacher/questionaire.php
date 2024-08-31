<?php
include 'authentication.php';
checkLogin(); // Call the function to check if the user is logged in
include "includes/conn.php";

include "alert.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ALSMS Administrator</title>
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
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div class="card">
        <div class="d-flex justify-content-between">
            <h4 class="card-title mx-3">Questions</h4>
            <div class="dropdown m-3">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Add Questions
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="add-multiple-choice">Multiple Choice</a></li>
                    <li><a class="dropdown-item" href="#" id="add-true-or-false">True or False</a></li>
                    <li><a class="dropdown-item" href="#" id="add-q-and-a">Q&A</a></li>
                </ul>
            </div>
        </div>
    </div>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#add-multiple-choice').on('click', function() {
            Swal.fire({
                title: 'Add Multiple Choice Question',
                html: `
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-question" placeholder="Question">
                <label for="swal-question">Question</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-choiceA" placeholder="Choice A">
                <label for="swal-choiceA">Choice A</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-choiceB" placeholder="Choice B">
                <label for="swal-choiceB">Choice B</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-choiceC" placeholder="Choice C">
                <label for="swal-choiceC">Choice C</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-choiceD" placeholder="Choice D">
                <label for="swal-choiceD">Choice D</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-control" id="swal-correctAnswer">
                    <option value="" disabled selected>Select Correct Answer</option>
                </select>
                <label for="swal-correctAnswer">Correct Answer</label>
            </div>`,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Add Question',
                preConfirm: () => {
                    const question = $('#swal-question').val();
                    const choiceA = $('#swal-choiceA').val();
                    const choiceB = $('#swal-choiceB').val();
                    const choiceC = $('#swal-choiceC').val();
                    const choiceD = $('#swal-choiceD').val();
                    const correctAnswer = $('#swal-correctAnswer').val();

                    if (question && choiceA && choiceB && choiceC && choiceD &&
                        correctAnswer) {
                        return {
                            question,
                            choiceA,
                            choiceB,
                            choiceC,
                            choiceD,
                            correctAnswer
                        };
                    } else {
                        Swal.showValidationMessage('Please fill out all fields.');
                    }
                },
                didOpen: () => {
                    // Populate the correct answer select based on the choices
                    const choices = ['A', 'B', 'C', 'D'];
                    choices.forEach(choice => {
                        const value = $(`#swal-choice${choice}`).val();
                        if (value) {
                            $('#swal-correctAnswer').append(
                                `<option value="${value}">${choice}: ${value}</option>`
                            );
                        }
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        question,
                        choiceA,
                        choiceB,
                        choiceC,
                        choiceD,
                        correctAnswer
                    } = result.value;

                    const questionHtml = `
                <div class="question-item mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>${question}</h5>
                            <p>A: ${choiceA}</p>
                            <p>B: ${choiceB}</p>
                            <p>C: ${choiceC}</p>
                            <p>D: ${choiceD}</p>
                            <p><strong>Correct Answer: ${correctAnswer}</strong></p>
                        </div>
                    </div>
                </div>`;

                    $('#questions-container').append(questionHtml);
                }
            });
        });

        $('#add-true-or-false').on('click', function() {
            Swal.fire({
                title: 'Add True or False Question',
                html: `
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-tf-question" placeholder="Question">
                <label for="swal-tf-question">Question</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-control" id="swal-tf-answer">
                    <option value="True">True</option>
                    <option value="False">False</option>
                </select>
                <label for="swal-tf-answer">Correct Answer</label>
            </div>`,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Add Question',
                preConfirm: () => {
                    const tfQuestion = $('#swal-tf-question').val();
                    const tfAnswer = $('#swal-tf-answer').val();

                    if (tfQuestion && tfAnswer) {
                        return {
                            tfQuestion,
                            tfAnswer
                        };
                    } else {
                        Swal.showValidationMessage('Please fill out all fields.');
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        tfQuestion,
                        tfAnswer
                    } = result.value;

                    const tfQuestionHtml = `
                <div class="question-item mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>${tfQuestion}</h5>
                            <p><strong>Correct Answer: ${tfAnswer}</strong></p>
                        </div>
                    </div>
                </div>`;

                    $('#questions-container').append(tfQuestionHtml);
                }
            });
        });

        $('#add-q-and-a').on('click', function() {
            Swal.fire({
                title: 'Add Q&A',
                html: `
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-qa-question" placeholder="Question">
                <label for="swal-qa-question">Question</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="swal-qa-answer" placeholder="Answer">
                <label for="swal-qa-answer">Answer</label>
            </div>`,
                focusConfirm: false,
                showCancelButton: true,
                confirmButtonText: 'Add Question',
                preConfirm: () => {
                    const qaQuestion = $('#swal-qa-question').val();
                    const qaAnswer = $('#swal-qa-answer').val();

                    if (qaQuestion && qaAnswer) {
                        return {
                            qaQuestion,
                            qaAnswer
                        };
                    } else {
                        Swal.showValidationMessage('Please fill out all fields.');
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const {
                        qaQuestion,
                        qaAnswer
                    } = result.value;

                    const qaQuestionHtml = `
                <div class="question-item mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>${qaQuestion}</h5>
                            <p><strong>Answer: ${qaAnswer}</strong></p>
                        </div>
                    </div>
                </div>`;

                    $('#questions-container').append(qaQuestionHtml);
                }
            });
        });
    });
    </script>


    <main class="m-3 position-relative">
        <section class="section">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <h5 class="card-header">Quize Code: </h5>
                        <div class="card-body">
                            <div id="questions-container" class="mt-4"></div> <!-- Questions will be appended here -->
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>