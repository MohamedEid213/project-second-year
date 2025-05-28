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
$service_id = base64_decode($_GET['id']);


$count_cart = "SELECT COUNT(*) as cart_count FROM `basket` WHERE Client_id = $user_id";
$result = mysqli_query($conn, $count_cart);
$row = mysqli_fetch_assoc($result);
$cart_items_count = $row['cart_count'];


$Sql = "SELECT * FROM `services` WHERE `service_id` = '$service_id'";
$service_data = mysqli_query($conn, $Sql);

$Sql_Services = "SELECT * FROM `services`";
$result_Services = mysqli_query($conn, $Sql_Services);



$Select_brand = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_brand);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Service Details</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_dateils_service.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_booking.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>


    <main class="container">
        <section class="page-body">
            <div class="main-container">
                <!-- // Hero Section -->
                <section class="hero-section animate__animated animate__fadeIn">
                    <div class="hero-content">
                        <h1 class="hero-title">Professional Engine Diagnostics</h1>
                        <p class="hero-subtitle">Precision diagnostics for optimal engine performance</p>
                    </div>
                </section>

                <!-- // Video Section -->
                <section class="video-section animate__animated animate__fadeInUp">
                    <div class="section-header">
                        <h2 class="section-title">Diagnostic Process</h2>
                        <div class="section-divider"></div>
                    </div>
                    <?php foreach ($service_data as $service): ?>
                        <div class="video-content">
                            <div class="video-wrapper">
                                <video src="/project_2/app/dateils_services/Videos/<?= $service['video'] ?>" controls loop type="video/mp4" class="video-player" poster="/project_2/assets/images/video-poster.jpg"></video>
                                <div class="video-overlay">
                                    <button class="play-button">
                                        <i class="fas fa-play"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="video-description">
                                <div class="description-content">
                                    <h3 class="description-title"><?= $service['s_name'] ?></h3>
                                    <p class="description-text"><?= $service['s_description'] ?></p>
                                    <ul class="feature-list">
                                        <li class="feature-item">
                                            <i class="fas fa-check-circle feature-icon"></i>
                                            <span>Complete system scanning and error code analysis</span>
                                        </li>
                                        <li class="feature-item">
                                            <i class="fas fa-check-circle feature-icon"></i>
                                            <span>Professional diagnostic equipment with live data</span>
                                        </li>
                                        <li class="feature-item">
                                            <i class="fas fa-check-circle feature-icon"></i>
                                            <span>Detailed report with recommended solutions</span>
                                        </li>
                                        <li class="feature-item">
                                            <i class="fas fa-check-circle feature-icon"></i>
                                            <span>Expert interpretation of diagnostic results</span>
                                        </li>
                                    </ul>
                                    <div class="cta-buttons">
                                        <button onclick="openBookingModal()" class="btn btn-primary btn-lg">
                                            <i class="fas fa-calendar-alt"></i> Book Now
                                        </button>
                                        <a href="#other-services" class="btn btn-outline btn-lg">
                                            <i class="fas fa-list-alt"></i> Other Services
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </section>

                <!-- // Features Section -->
                <section class="features-section">
                    <div class="features-container">
                        <div class="feature-card animate__animated animate__fadeInLeft">
                            <div class="feature-icon-box">
                                <i class="fas fa-tachometer-alt"></i>
                            </div>
                            <h3 class="feature-card-title">Performance Analysis</h3>
                            <p class="feature-card-text">Detailed evaluation of engine performance metrics and efficiency.</p>
                        </div>
                        <div class="feature-card animate__animated animate__fadeInUp">
                            <div class="feature-icon-box">
                                <i class="fas fa-bolt"></i>
                            </div>
                            <h3 class="feature-card-title">Quick Diagnostics</h3>
                            <p class="feature-card-text">Fast and accurate identification of engine issues.</p>
                        </div>
                        <div class="feature-card animate__animated animate__fadeInRight">
                            <div class="feature-icon-box">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <h3 class="feature-card-title">Detailed Report</h3>
                            <p class="feature-card-text">Comprehensive report with findings and recommendations.</p>
                        </div>
                    </div>
                </section>

                <!-- // Other Services Section -->
                <section id="other-services" class="services-section animate__animated animate__fadeIn">
                    <div class="section-header">
                        <h2 class="section-title">Our Other Services</h2>
                        <div class="section-divider"></div>
                        <p class="section-subtitle">Explore our comprehensive range of automotive services</p>
                    </div>
                    <div class="services-container">

                        <?php foreach ($result_Services as $row_Services) : ?>
                            <div class="service-card">
                                <div class="service-icon">
                                    <img src="/project_2/assets/image/image_serivce/<?= $row_Services['image'] ?>" alt="not found">
                                </div>
                                <h3 class="service-title"><?= $row_Services['s_name'] ?></h3>
                                <p class="service-description"><?= $row_Services['s_description'] ?></p>
                                <a href="/project_2/app/dateils_services/dateils_service.php?id=<?= base64_encode($row_Services['service_id']); ?>" class="service-link">Learn More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </section>

                <!-- // Testimonials Section -->
                <section class="testimonials-section">
                    <div class="section-header">
                        <h2 class="section-title">Customer Reviews</h2>
                        <div class="section-divider"></div>
                    </div>
                    <div class="testimonials-container">
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="testimonial-text">"The diagnostic service was thorough and professional. They identified the issue quickly and explained everything clearly."</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="author-info">
                                        <h4>Mohammed Ali</h4>
                                        <p>Regular Customer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-card">
                            <div class="testimonial-content">
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                                <p class="testimonial-text">"Impressed with their advanced equipment and knowledgeable staff. My car runs better than ever after their service."</p>
                                <div class="testimonial-author">
                                    <div class="author-avatar">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="author-info">
                                        <h4>Sarah Ahmed</h4>
                                        <p>First-time Customer</p>
                                    </div>
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

    <!-- Floating Cart Icon -->
    <div class="cart-icon-container">
        <a href="/project_2/app/Baskets/basket.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cart-count"><?= $cart_items_count ?></span>
        </a>
    </div>

    <div id="overlay"></div>

    <script src="/project_2/assets/js/dark_mode.js"></script>

    <!-- إضافة Modal الحجز في نهاية الصفحة قبل إغلاق body -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Book your service now</h2>
                <span class="close-modal" onclick="closeBookingModal()">&times;</span>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <div class="form-group">
                        <label><i class="fa fa-user"></i> Full Name</label>
                        <input type="text" id="fullName" class="form-control" placeholder="Enter name..." required>
                        <div class="invalid-feedback">Please enter your full name using letters only.</div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-envelope"></i> Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email..." required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-phone"></i> Phone Number</label>
                        <input type="tel" id="phone" class="form-control" placeholder="Enter phone number..." required>
                        <div class="invalid-feedback">Please enter a phone number of at least 11 digits.</div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-calendar"></i> Date</label>
                        <input type="date" id="date" class="form-control" required>
                        <div class="invalid-feedback">Please select a date.</div>
                    </div>
                    <div class="form-group">
                        <label><i class="fa fa-truck"></i> Car Type</label>
                        <select id="deliveryOption" class="form-select">
                            <?php foreach ($All_Brands as $brand) : ?>
                                <option class="fw-bold" value="<?= $brand['brand_id'] ?>"> <?= $brand['b_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group" id="addressBox" style="display: none;">
                        <label><i class="fa fa-map-marker-alt"></i> Delivery address</label>
                        <input type="text" id="deliveryAddress" class="form-control" placeholder="Enter delivery address">
                        <div class="invalid-feedback">Please enter your delivery address.</div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Confirm your reservation</button>
                </form>
            </div>
        </div>
    </div>


    <!-- إضافة JavaScript للتحكم في المودال -->
    <script>
        function openBookingModal() {
            document.getElementById('bookingModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // منع التمرير في الصفحة الخلفية
        }

        function closeBookingModal() {
            document.getElementById('bookingModal').style.display = 'none';
            document.body.style.overflow = 'auto'; // إعادة تفعيل التمرير
        }

        // إغلاق المودال عند النقر خارج المحتوى
        window.onclick = function(event) {
            const modal = document.getElementById('bookingModal');
            if (event.target == modal) {
                closeBookingModal();
            }
        }

        // التحكم في ظهور حقل العنوان
        document.getElementById('deliveryOption').addEventListener('change', function() {
            const addressBox = document.getElementById('addressBox');
            addressBox.style.display = this.value === 'delivery' ? 'block' : 'none';
        });

        // التحقق من صحة النموذج
        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // هنا يمكنك إضافة التحقق من صحة البيانات وإرسالها
            const formData = {
                fullName: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                date: document.getElementById('date').value,
                deliveryOption: document.getElementById('deliveryOption').value,
                deliveryAddress: document.getElementById('deliveryAddress').value
            };

            // إظهار رسالة نجاح
            alert('تم إرسال طلب الحجز بنجاح!');
            closeBookingModal();
        });
    </script>
</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>
<script>
    // Video play button functionality
    const videoPlayer = document.querySelector('.video-player');
    const playButton = document.querySelector('.play-button');
    const videoOverlay = document.querySelector('.video-overlay');

    playButton.addEventListener('click', () => {
        videoPlayer.play();
        videoOverlay.style.display = 'none';
    });

    videoPlayer.addEventListener('play', () => {
        videoOverlay.style.display = 'none';
    });

    videoPlayer.addEventListener('pause', () => {
        videoOverlay.style.display = 'flex';
    });
</script>

<!-- 







  -->