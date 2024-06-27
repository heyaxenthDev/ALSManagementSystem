<?php
// Get the current script name
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'dashboard') ? '' : 'collapsed' ?>" href="dashboard.php">
                <i class="bi bi-grid-1x2"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'subjects') ? '' : 'collapsed' ?>" href="subjects.php">
                <i class="bi bi-book"></i>
                <span>Subject</span>
            </a>
        </li><!-- End Subject Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'students') ? '' : 'collapsed' ?>" href="students.php">
                <i class="bi bi-person"></i>
                <span>Students</span>
            </a>
        </li><!-- End Students Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'teachers') ? '' : 'collapsed' ?>" href="teachers.php">
                <i class="bi bi-pen"></i>
                <span>Teachers</span>
            </a>
        </li><!-- End Teachers Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'announcements') ? '' : 'collapsed' ?>" href="announcements.php">
                <i class="bi bi-megaphone"></i>
                <span>Announcements</span>
            </a>
        </li><!-- End Announcements Page Nav -->

    </ul>

</aside><!-- End Sidebar-->