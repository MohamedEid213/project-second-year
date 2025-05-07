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

$user_id = $_SESSION['user_id'];


$count_cart = "SELECT COUNT(*) as cart_count FROM `basket` WHERE Client_id = $user_id";
$result = mysqli_query($conn, $count_cart);
$row = mysqli_fetch_assoc($result);
$cart_items_count = $row['cart_count'];
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

    <main>
        <section class="about-page">
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-content">
                    <h1 class="hero-title">Meet our creative team</h1>
                    <p class="hero-subtitle">We are a group of professionals passionate about building exceptional digital solutions.</p>
                    <div class="scroll-indicator">
                        <span></span>
                    </div>
                </div>
            </section>

            
            <!-- Team Member Spotlight -->
            <section class="spotlight-section">
                <div class="container">
                    <div class="spotlight-content">
                        <div class="member-info">
                            <h1 class="member-name1">hi,it's <span id="text_name">shadows team</span></h1>
                            <h2 class="member-name2">I'M a <span id="dynamicText">Web Developer</span></h2>
                            <div class="member-bio">
                                <p>Web developer with 5 years of experience building modern, scalable applications. Specializing in front-end technologies and user experience engineering.</p>
                                <div class="skills">
                                    <span class="skill">Frontend</span>
                                    <span class="skill">UI/UX</span>
                                    <span class="skill">React</span>
                                    <span class="skill">JavaScript</span>
                                </div>
                            </div>
                            <div class="social-links">
                                <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                                <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                        <div class="member-image">
                            <div class="image-frame">
                                <img id="mainImage" src="/project_2/assets/image/images_team/ALL_TEAM.jpg" alt="Mohammed Eid">
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Team Gallery -->
            <section class=" team-section">
                <div class="container">
                    <h2 class="section-title">Our amazing team</h2>
                    <p class="section-subtitle">Meet the talented people who make it all possible.</p>

                    <div class="swiper team-slider">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/photo_private.jpg" alt="Mohammed Eid" data-title="Mohamed Eid" data-role="مطور ويب رئيسي">
                                <div class="member-overlay">
                                    <h3>Mohammed Eid</h3>
                                    <p>Senior Web Developer</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/tarek.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Tarek Moawad</h3>
                                    <p>Interface designer</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/باش_مصر.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Mohammed Ashraf</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/Mohammed_Shehata.png" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Mohamed Shehate</h3>
                                    <p>Frontend Developer</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/omar.png" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Omar</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/mohamed_walid.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Mohammed walid</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/mohamed_nady.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Mohammed nady</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/mostafa_sholkamy.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Mostafa Sholkamy</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/نادر.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>nader</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>


                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/Abdulrahman.jpg" alt="" data-title="" data-role="">
                                <div class="member-overlay">
                                    <h3>Abdul Rahman Essam</h3>
                                    <p>Senior Fron-end</p>
                                </div>
                            </div>

                            <!-- باقي أعضاء الفريق بنفس الهيكل -->
                        </div>

                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </section>

            <!-- Stats Section -->
            <section class="stats-section">
                <div class="container">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-number" data-count="150">0</div>
                            <div class="stat-label">Completed project</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" data-count="25">0</div>
                            <div class="stat-label">satisfied customer</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" data-count="8">0</div>
                            <div class="stat-label">Team members</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number" data-count="5">0</div>
                            <div class="stat-label">Years of experience</div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>


    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script src="/project_2/assets/js/main_about.js"></script>

    <!-- Floating Cart Icon -->
    <div class="cart-icon-container">
        <a href="/project_2/app/Baskets/basket.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cart-count"><?= $cart_items_count ?></span>
        </a>
    </div>

    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>