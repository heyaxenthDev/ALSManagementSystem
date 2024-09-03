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
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                    <?php

                        // SQL query to get the total number of students
                        $sqlTotalStudents = "SELECT COUNT(*) AS total FROM `students`";
                        $resultTotal = $conn->query($sqlTotalStudents);
                        $totalStudents = 0;

                        if ($resultTotal->num_rows > 0) {
                            $rowTotal = $resultTotal->fetch_assoc();
                            $totalStudents = $rowTotal['total'];
                        }

                        // SQL query to get the number of students added in the last day
                        $sqlRecentAdditions = "SELECT COUNT(*) AS recent_count FROM `students` WHERE `date_created` >= CURDATE()";
                        $resultRecent = $conn->query($sqlRecentAdditions);
                        $recentAdditions = 0;

                        if ($resultRecent->num_rows > 0) {
                            $rowRecent = $resultRecent->fetch_assoc();
                            $recentAdditions = $rowRecent['recent_count'];
                        }

                        ?>

                    <!-- Students Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card student-card">

                            <div class="card-body">
                                <h5 class="card-title">Students</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-person"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $totalStudents; ?></h6>
                                        <span
                                            class="text-success small pt-1 fw-bold"><?php echo $recentAdditions; ?></span>
                                        <span class="text-muted small pt-2 ps-1">newly added</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Students Card -->


                    <?php
                        // SQL query to get the total number of teachers
                        $sqlTotalTeachers = "SELECT COUNT(*) AS total FROM `teachers`";
                        $resultTotal = $conn->query($sqlTotalTeachers);
                        $totalTeachers = 0;

                        if ($resultTotal->num_rows > 0) {
                            $rowTotal = $resultTotal->fetch_assoc();
                            $totalTeachers = $rowTotal['total'];
                        }

                        // SQL query to get the number of teachers added in the last day
                        $sqlRecentAdditions = "SELECT COUNT(*) AS recent_count FROM `teachers` WHERE `date_created` >= CURDATE()";
                        $resultRecent = $conn->query($sqlRecentAdditions);
                        $recentAdditions = 0;

                        if ($resultRecent->num_rows > 0) {
                            $rowRecent = $resultRecent->fetch_assoc();
                            $recentAdditions = $rowRecent['recent_count'];
                        }

                        ?>

                    <!-- Teachers Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card teacher-card">

                            <div class="card-body">
                                <h5 class="card-title">Teachers</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-pen"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6><?php echo $totalTeachers; ?></h6>
                                        <span
                                            class="text-success small pt-1 fw-bold"><?php echo $recentAdditions; ?></span>
                                        <span class="text-muted small pt-2 ps-1">newly added</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Teachers Card -->


                    <!-- Exams Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card exams-card">

                            <div class="card-body">
                                <h5 class="card-title">Exams</h5>

                                <div class="d-flex align-items-center">
                                    <div
                                        class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-file-earmark-text"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>0</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Exams Card -->

                    <!-- Recent Sales -->
                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="card-body">
                                <h5 class="card-title">Current Subjects</h5>

                                <!-- Subject Table -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Descriptive Title</th>
                                            <th>Subject Name</th>
                                            <th>Program Category</th>
                                            <th>Assigned Teacher</th>
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
                                        </tr>
                                        <?php 
                                }
                                ?>
                                    </tbody>
                                </table>
                                <!-- End Subject Table -->

                            </div>

                        </div>
                    </div><!-- End Recent Sales -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-4">

                <!-- Categories -->
                <div class="card">
                    <div class="card-body pb-0">
                        <h5 class="card-title">Students by Category</h5>

                        <div id="trafficChart" style="min-height: 400px;" class="echart"></div>

                        <?php

                        // Query to get count of distinct students per category
                        $sql = "
                            SELECT category, COUNT(DISTINCT studentID) AS count
                            FROM enrollments
                            GROUP BY category
                        ";
                        $result = $conn->query($sql);

                        $categories = [];
                        $data = [];

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $categories[] = $row['category'];
                                $data[] = ['value' => $row['count'], 'name' => $row['category']];
                            }
                        }
                        ?>

                        <script>
                        document.addEventListener("DOMContentLoaded", () => {
                            // Define chart data from PHP
                            const chartData = <?php echo json_encode($data); ?>;

                            echarts.init(document.querySelector("#trafficChart")).setOption({
                                tooltip: {
                                    trigger: 'item'
                                },
                                legend: {
                                    top: '5%',
                                    left: 'center'
                                },
                                series: [{
                                    name: 'Students by Category',
                                    type: 'pie',
                                    radius: ['40%', '70%'],
                                    avoidLabelOverlap: false,
                                    label: {
                                        show: false,
                                        position: 'center'
                                    },
                                    emphasis: {
                                        label: {
                                            show: true,
                                            fontSize: '18',
                                            fontWeight: 'bold'
                                        }
                                    },
                                    labelLine: {
                                        show: false
                                    },
                                    data: chartData
                                }]
                            });
                        });
                        </script>


                    </div>
                </div><!-- End Categories -->

            </div><!-- End Right side columns -->

        </div>
    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>