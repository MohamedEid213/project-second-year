<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Location</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/location_home.css">

</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <div class="section">
            <div class="container3 mt-5">
                <div class="text">
                    <h3>Our Location</h3>
                    <p>
                        Visit us at our convenient location in Area/Address, where we provide
                        top-quality car maintenance and repair services. Whether you need
                        an oil change, a quick check-up, or a repair, our skilled team is
                        ready help. Stop by and let us take care of your car with expert
                        care and advanced tools.
                    </p>
                </div>
                <div class="map">
                    <iframe class="info" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3486.27904400238!2d31.107112575286926!3d29.097442162817288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145a27c9ad31e973%3A0xc9a95cfad8824ea7!2z2KfZhNmF2LnZh9ivINin2YTYqtmD2YbZiNmE2YjYrNmKINin2YTYudin2YTZiiDYqNio2YbZiiDYs9mI2YrZgQ!5e0!3m2!1sen!2seg!4v1731486558934!5m2!1sen!2seg"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>