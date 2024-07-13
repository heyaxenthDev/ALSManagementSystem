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
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active">Announcements</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <!-- Default Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Default Card</h5>
                Ut in ea error laudantium quas omnis officia. Sit sed praesentium voluptas. Corrupti inventore
                consequatur nisi necessitatibus modi consequuntur soluta id. Enim autem est esse natus assumenda. Non
                sunt dignissimos officiis expedita. Consequatur sint repellendus voluptas.
                Quidem sit est nulla ullam. Suscipit debitis ullam iusto dolorem animi dolorem numquam. Enim fuga ipsum
                dolor nulla quia ut.
                Rerum dolor voluptatem et deleniti libero totam numquam nobis distinctio. Sit sint aut. Consequatur
                rerum in.
            </div>
        </div><!-- End Default Card -->

        <!-- Default Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Default Card</h5>
                Ut in ea error laudantium quas omnis officia. Sit sed praesentium voluptas. Corrupti inventore
                consequatur nisi necessitatibus modi consequuntur soluta id. Enim autem est esse natus assumenda. Non
                sunt dignissimos officiis expedita. Consequatur sint repellendus voluptas.
                Quidem sit est nulla ullam. Suscipit debitis ullam iusto dolorem animi dolorem numquam. Enim fuga ipsum
                dolor nulla quia ut.
                Rerum dolor voluptatem et deleniti libero totam numquam nobis distinctio. Sit sint aut. Consequatur
                rerum in.
            </div>
        </div><!-- End Default Card -->

        <!-- Default Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Default Card</h5>
                Ut in ea error laudantium quas omnis officia. Sit sed praesentium voluptas. Corrupti inventore
                consequatur nisi necessitatibus modi consequuntur soluta id. Enim autem est esse natus assumenda. Non
                sunt dignissimos officiis expedita. Consequatur sint repellendus voluptas.
                Quidem sit est nulla ullam. Suscipit debitis ullam iusto dolorem animi dolorem numquam. Enim fuga ipsum
                dolor nulla quia ut.
                Rerum dolor voluptatem et deleniti libero totam numquam nobis distinctio. Sit sint aut. Consequatur
                rerum in.
            </div>
        </div><!-- End Default Card -->

    </section>

</main><!-- End #main -->

<?php 
include 'includes/footer.php';
?>