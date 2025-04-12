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
    <title>About</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">


</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <!-- محتوى الصفحة -->
        <div class="about">
            <div class="container2">
                <div class="content">
                    <!--  -->
                    <div class="animated-text text-black">I'm <span id="dynamicText">Mahmoud Mo</span>
                        <p class="fs-5 pt-2 pe-1">I am a dedicated developer skilled in coding, problem-solving, and software
                            development. I enjoy
                            building efficient and scalable solutions.</p>

                    </div>

                    <!--  -->
                    <div class="cont_image">
                        <div class="image">
                            <img id="mainImage" class="im" src="/project_2/assets/image/images_team/guide-3.jpg">
                        </div>
                    </div>
                </div>
                <div class="swiper icon-slider d-flex pt-4">
                    <div class="swiper-wrapper d-flex pt-4">
                        <div class="swiper-slide slide">
                            <img id="mahmoud" onclick="changePerson(this);" src="/project_2/assets/image/images_team/guide-3.jpg"
                                data-title="Mahmoud Mohamed">
                        </div>

                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/testimonial-4.jpg"
                                data-title="Amira Ali">
                        </div>
                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/testimonial-2.jpg"
                                data-title="Asmaa Hussein">
                        </div>
                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/guide-1.jpg" data-title="Mohamed Eid">
                        </div>
                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/testimonial-1.jpg"
                                data-title="Hossam Yahya">
                        </div>
                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/guide-2.jpg" data-title="Ahmed Sayed">
                        </div>
                        <div class="swiper-slide slide">
                            <img onclick="changePerson(this);" src="/project_2/assets/image/images_team/guide-4.jpg" data-title="Kareem Ahmed">
                        </div>
                    </div>
                    <div class="swiper-pagination">

                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="/project_2/assets/js/main_about.js"></script>


</body>

</html>