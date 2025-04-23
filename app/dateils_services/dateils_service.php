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
    <title>Dateils</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_dateils_service.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <!-- محتوى الصفحة -->
        <section class="page-body">

            <div class="main-container">
                <section class="video-section">
                    <div class="video-content">
                        <div class="video-wrapper">
                            <video src="/project_2/app/dateils_services/Videos/engine_diagnatics.mp4" controls loops type="video/mp4"></video>
                        </div>
                        <div class="video-description">
                            <h2 class="section-title">Engine Diagnostic Process</h2>
                            <p class="description-text">This comprehensive video guide walks you through the complete engine diagnostic process, covering:</p>
                            <ul class="feature-list">
                                <li class="feature-item">Initial system scanning and error code reading</li>
                                <li class="feature-item">Understanding diagnostic trouble codes (DTCs)</li>
                                <li class="feature-item">Using professional diagnostic equipment</li>
                                <li class="feature-item">Interpreting sensor data and live readings</li>
                                <li class="feature-item">Common problem areas and their symptoms</li>
                            </ul>
                            <p class="highlight-text">Perfect for both beginners and experienced mechanics looking to enhance their diagnostic skills.</p>
                            <a href="/project_2/app/booking/booking.php" class=" btn btn-primary">Book a service</a>
                        </div>
                    </div>
                </section>

                <section class="gallery-section">
                    <h2 class="section-title">Professional Diagnostic Equipment</h2>
                    <div class="gallery-container">
                        <div class="gallery-item">
                            <div class="image-row">
                                <img src="https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800&auto=format" alt="OBD Scanner" class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&auto=format" alt="Engine Testing" class="gallery-image">
                            </div>
                            <div class="description-row">
                                <div class="description-box">
                                    <h3 class="description-title">Advanced OBD Scanning</h3>
                                    <p class="description-text">State-of-the-art OBD-II scanning equipment for precise diagnostic readings and real-time data monitoring.</p>
                                </div>
                                <div class="description-box">
                                    <h3 class="description-title">Performance Testing</h3>
                                    <p class="description-text">Comprehensive engine performance analysis using advanced testing equipment and diagnostic tools.</p>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item">
                            <div class="image-row">
                                <img src="https://images.unsplash.com/photo-1489824904134-891ab64532f1?w=800&auto=format" alt="Diagnostic Equipment" class="gallery-image">
                                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?w=800&auto=format" alt="Engine Bay" class="gallery-image">
                            </div>
                            <div class="description-row">
                                <div class="description-box">
                                    <h3 class="description-title">Professional Tools</h3>
                                    <p class="description-text">Full range of specialized diagnostic tools for accurate fault detection and analysis.</p>
                                </div>
                                <div class="description-box">
                                    <h3 class="description-title">Engine Inspection</h3>
                                    <p class="description-text">Detailed visual and electronic inspection of engine components and systems.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>