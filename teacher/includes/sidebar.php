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

        <li class="nav-heading">Pages</li>

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'subject') ? '' : 'collapsed' ?>" href="subject">
                <i class="bi bi-book"></i>
                <span>Subject</span>
            </a>
        </li><!-- End Subject Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?= ($current_page == 'class') ? '' : 'collapsed' ?>" href="Class">
                <i class="bi bi-bookmarks-fill"></i>
                <span>Class</span>
            </a>
        </li><!-- End Class Page Nav -->

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