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
                            <h2 class="member-name">I'M <span id="dynamicText">Mahmoud Mohammed</span></h2>
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
                                <img id="mainImage" src="/project_2/assets/image/images_team/guide-3.jpg" alt="Mahmoud Mohammed">
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
                                <img src="/project_2/assets/image/image_users/photo_private.jpg" alt="Mahmoud Mohammed" data-title=" محمود محمد" data-role="مطور ويب رئيسي">
                                <div class="member-overlay">
                                    <h3>Mahmoud Mohammed</h3>
                                    <p>Senior Web Developer</p>
                                </div>
                            </div>


                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/testimonial-4.jpg" alt="أميرة علي" data-title="أميرة علي" data-role="مصممة واجهات">
                                <div class="member-overlay">
                                    <h3>Princess Ali</h3>
                                    <p>Interface designer</p>
                                </div>
                            </div>

                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/testimonial-4.jpg" alt="أميرة علي" data-title="أميرة علي" data-role="مصممة واجهات">
                                <div class="member-overlay">
                                    <h3>أميرة علي</h3>
                                    <p>مصممة واجهات</p>
                                </div>
                            </div>
                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/testimonial-4.jpg" alt="أميرة علي" data-title="أميرة علي" data-role="مصممة واجهات">
                                <div class="member-overlay">
                                    <h3>أميرة علي</h3>
                                    <p>مصممة واجهات</p>
                                </div>
                            </div>
                            <div class="swiper-slide team-member">
                                <img src="/project_2/assets/image/images_team/testimonial-4.jpg" alt="أميرة علي" data-title="أميرة علي" data-role="مصممة واجهات">
                                <div class="member-overlay">
                                    <h3>أميرة علي</h3>
                                    <p>مصممة واجهات</p>
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

    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>