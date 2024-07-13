<?php
// Get the current script name
$current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'home') ? '' : 'collapsed' ?>" href="home">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>
        </li><!-- End Home Nav -->

        <li class="nav-heading">Enrolled to</li>

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'subject') ? '' : 'collapsed' ?>" href="subject">
                <i class="bi bi-book"></i>
                <span>Subjects</span>
            </a>
        </li><!-- End Subject Page Nav -->

        <li class="nav-heading">Others</li>

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'message') ? '' : 'collapsed' ?>" href="message">
                <i class="bi bi-chat"></i>
                <span>Message</span>
            </a>
        </li><!-- End Messages Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'announcement') ? '' : 'collapsed' ?>" href="announcement">
                <i class="bi bi-megaphone"></i>
                <span>Announcement</span>
            </a>
        </li><!-- End Announcements Page Nav -->


        <li class="nav-heading">User</li>

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'users-profile') ? '' : 'collapsed' ?>" href="users-profile">
                <i class="bi bi-person-badge"></i>
                <span>User Profile</span>
            </a>
        </li><!-- End User Profile Page Nav -->

    </ul>

</aside><!-- End Sidebar-->