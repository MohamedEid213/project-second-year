<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

$permissions = $_SESSION['user_permissions'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];


$count_cart = "SELECT COUNT(*) as cart_count FROM `basket` WHERE Client_id = $user_id";
$result = mysqli_query($conn, $count_cart);
$row = mysqli_fetch_assoc($result);
$cart_items_count = $row['cart_count'];


$Select_Product = 'SELECT * FROM `products` ORDER BY product_id DESC';
$result = mysqli_query($conn, $Select_Product);
$All_Products = mysqli_fetch_all($result, MYSQLI_ASSOC);
// معالجة إضافة المنتج إلى السلة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {


    $product_id = (int)$_POST['product_id'];

    // التحقق من وجود المنتج في قاعدة البيانات
    $check_product = "SELECT * FROM products WHERE product_id = $product_id";
    $product_result = mysqli_query($conn, $check_product);

    if (mysqli_num_rows($product_result) > 0) {
        // التحقق من وجود المنتج في سلة المستخدم
        $check_cart = "SELECT * FROM basket WHERE Client_id = $user_id AND Product_id = $product_id";
        $cart_result = mysqli_query($conn, $check_cart);

        if (mysqli_num_rows($cart_result) > 0) {
            $_SESSION['info'] = "Product is already in your cart!";
        } else {
            // إضافة المنتج إلى السلة
            $insert_cart = "INSERT INTO basket (Client_id, Product_id) VALUES ($user_id, $product_id)";
            if (mysqli_query($conn, $insert_cart)) {
                $_SESSION['success'] = "Product added to cart successfully!";
            } else {
                $_SESSION['error'] = "Error adding product to cart!";
            }
        }
    } else {
        $_SESSION['error'] = "Product not found!";
    }

    header("Location: /project_2/app/Baskets/basket.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Auto Repair Center - Premium Car Services</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional auto repair services and quality car parts. Expert technicians, modern equipment, and affordable prices.">
    
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    
    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="/project_2/assets/css/style_home.css">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="/project_2/assets/lib/animate/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main>
        <?php
        // عرض رسائل النجاح أو الخطأ
        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }
        if (isset($_SESSION['info'])) {
            echo '<div class="alert alert-info">' . $_SESSION['info'] . '</div>';
            unset($_SESSION['info']);
        }
        ?>

        <!-- ===== Intro Animation Screen ===== -->
        <div class="cont">
            <div class="intro-screen" id="introScreen">
                <img src="/project_2/assets/image/image_home/maintenance (1).png" alt="Car Service" class="car-image" id="carImage" onclick="startCar()">
                <p class="intro-text" id="introText">Click to start your journey</p>
            </div>
        </div>
        <audio id="hoverSound" src="/project_2/assets/image/image_home/Sound_1.mp3"></audio>
        <audio id="engineSound" src="/project_2/assets/image/image_home/Sound_2.mp3"></audio>

        <!-- ===== Hero Section ===== -->
        <section id="landing" class="hero-wrap" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text justify-content-center align-items-center">
                    <div class="col-lg-10 col-xl-8 info">
                        <div class="text w-100 text-center">
                            <h1 class="wow fadeInUp" data-wow-delay="0.3s">
                                Welcome to
                                <span>Auto Repair Center</span>
                            </h1>
                            <p class="wow fadeInUp" data-wow-delay="0.5s">
                                Your trusted destination for professional car maintenance and repair services. 
                                We combine expert technicians with modern equipment to deliver quality at affordable prices.
                            </p>
                            <a href="/project_2/assets/image/image_home/Landing-Video.mp4" 
                               class="video d-inline-flex align-items-center mt-4 wow fadeInUp" data-wow-delay="0.7s">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="video-play"></span>
                                </div>
                                <div class="heading-title">
                                    <span>Watch How We Work</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== How It Works Section ===== -->
        <section class="how-it-work container-fluid text-center">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/location.gif" alt="Location Icon">
                            <a href="/project_2/app/location/location.php" class="link">Our Location</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/calendar.gif" alt="Calendar Icon">
                            <a href="#" class="link">Pick-up Date</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/car.gif" alt="Car Icon">
                            <a href="#" class="link">Book Your Car</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Products Section ===== -->
        <section class="products">
            <div class="container">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5 gap-3">
                    <div class="title wow fadeInLeft" data-wow-delay="0.2s">
                        <h6 class="product-title">Featured Products</h6>
                        <h2 class="product-head">Popular <span>Products</span></h2>
                    </div>
                    <button class="btn-more wow fadeInRight" data-wow-delay="0.3s">
                        <a href="/project_2/app/categories/category.php">Explore All</a>
                    </button>
                </div>

                <!-- Swiper Product Carousel -->
                <div class="swiper mySwiper wow fadeInUp" data-wow-delay="0.4s">
                    <div class="swiper-wrapper">
                        <?php if (!empty($All_Products)): ?>
                            <?php foreach ($All_Products as $product): ?>
                                <div class="swiper-slide">
                                    <div class="product-card1">
                                        <button class="heart-btn position-absolute top-0 end-0 m-3">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                        <img src="/project_2/data/uploads/image_products/<?= $product['Images'] ?>" 
                                             alt="<?= htmlspecialchars($product['product_name']) ?>">
                                        <div class="product-name"><?= htmlspecialchars($product['product_name']) ?></div>
                                        <div class="card-content">
                                            <div class="product-price">EGP <?= number_format($product['price'], 2) ?></div>
                                            <form method="POST" class="add-to-cart-form">
                                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                                <button type="submit" name="add_to_cart" class="btn">
                                                    <i class="fa-solid fa-cart-plus"></i> Add
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif ?>
                    </div>

                    <!-- Navigation Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>
        </section>

        <!-- ===== About Section ===== -->
        <section class="about container-fluid">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <div class="image-container wow fadeInLeft" data-wow-delay="0.2s">
                            <img src="/project_2/assets/image/image_home/about.jpg" alt="About Auto Repair Center" class="big-image">
                            <img src="/project_2/assets/image/image_home/service-2.jpg" alt="Our Service" class="small-image">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="h5 wow fadeInUp" data-wow-delay="0.3s">Who We Are</div>
                        <h2 class="ser-h1 wow fadeInUp" data-wow-delay="0.4s">
                            <span>About Our</span> Auto Repair Center
                        </h2>
                        <p class="paragraph wow fadeInUp" data-wow-delay="0.5s">
                            A mechanic can be a car owner's best friend. When car problems arise, people 
                            depend heavily on their mechanic to diagnose and repair the issue quickly and efficiently. 
                            We combine expertise with integrity to provide service you can trust.
                        </p>
                        <div class="list-icon wow fadeInUp" data-wow-delay="0.6s">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="unorder-list">
                                        <li><i class="fa-solid fa-check"></i> Strong Customer Service</li>
                                        <li><i class="fa-solid fa-check"></i> Problem-Solving Skills</li>
                                        <li><i class="fa-solid fa-check"></i> Strong Technical Aptitude</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="unorder-list">
                                        <li><i class="fa-solid fa-check"></i> Good Diagnostic Skills</li>
                                        <li><i class="fa-solid fa-check"></i> Solid Work Ethic</li>
                                        <li><i class="fa-solid fa-check"></i> Leadership Excellence</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Stats Section ===== -->
        <section class="container-fluid bg-dark py-5" id="state">
            <div class="container">
                <div class="text-center">
                    <h6 class="state-title wow fadeInUp" data-wow-delay="0.1s">Our Achievements</h6>
                    <h3 class="state-head wow fadeInUp" data-wow-delay="0.2s">
                        <span>Professional</span> Auto Parts
                    </h3>
                </div>
                <div class="state-content row g-4">
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="box">
                            <i class="fa fa-check fa-2x"></i>
                            <h2 data-toggle="counter-up">15+</h2>
                            <p>Years of Experience</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="box" id="special">
                            <i class="fa fa-users-cog fa-2x"></i>
                            <h2 data-toggle="counter-up">50+</h2>
                            <p>Expert Technicians</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.4s">
                        <div class="box">
                            <i class="fa fa-car fa-2x"></i>
                            <h2 data-toggle="counter-up">7000+</h2>
                            <p>Completed Projects</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Services Section ===== -->
        <section class="container-fluid service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="ser-head">Our Services</h6>
                    <h1 class="mb-5 ser-h1"><span>Popular</span> Car Services</h1>
                </div>
                <div class="row g-4">
                    <div class="col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="nav w-100 nav-pills me-4">
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" 
                                    data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                                <i class="fa fa-car-side fa-2x me-3"></i>
                                <h4 class="m-0">Diagnostic Test</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" 
                                    data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                                <i class="fa fa-car fa-2x me-3"></i>
                                <h4 class="m-0">Engine Servicing</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" 
                                    data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                                <i class="fa fa-cog fa-2x me-3"></i>
                                <h4 class="m-0">Tires Replacement</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" 
                                    data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                                <i class="fa fa-oil-can fa-2x me-3"></i>
                                <h4 class="m-0">Oil Changing</h4>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="tab-content w-100">
                            <!-- Tab 1: Diagnostic Test -->
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" 
                                                 src="/project_2/assets/image/image_home/service-1.jpg"
                                                 style="object-fit: cover; border-radius: 16px;" alt="Diagnostic Test">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title">15 Years Of Experience</h3>
                                        <p class="mb-4 ser-paragragh">
                                            A diagnostic test identifies vehicle issues using advanced tools, 
                                            ensuring accurate troubleshooting and efficient repairs for optimal performance.
                                        </p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="/project_2/app/servicess/services.php" class="btn btn-primary py-3 px-5 mt-3 ser-button">
                                            Read More <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab 2: Engine Servicing -->
                            <div class="tab-pane fade" id="tab-pane-2">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" 
                                                 src="/project_2/assets/image/image_home/service-2.jpg"
                                                 style="object-fit: cover; border-radius: 16px;" alt="Engine Servicing">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title">15 Years Of Experience</h3>
                                        <p class="mb-4 ser-paragragh">
                                            Engine servicing includes oil changes, filter replacements, and inspections 
                                            to ensure optimal performance and prolonged engine life.
                                        </p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="/project_2/app/servicess/services.php" class="btn btn-primary py-3 px-5 mt-3 ser-button">
                                            Read More <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab 3: Tires Replacement -->
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" 
                                                 src="/project_2/assets/image/image_home/service-3.jpg"
                                                 style="object-fit: cover; border-radius: 16px;" alt="Tires Replacement">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title">15 Years Of Experience</h3>
                                        <p class="mb-4 ser-paragragh">
                                            Tire replacement ensures safety, better traction, and fuel efficiency 
                                            by installing high-quality tires suited for your vehicle.
                                        </p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="/project_2/app/servicess/services.php" class="btn btn-primary py-3 px-5 mt-3 ser-button">
                                            Read More <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!-- Tab 4: Oil Changing -->
                            <div class="tab-pane fade" id="tab-pane-4">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" 
                                                 src="/project_2/assets/image/image_home/service-4.jpg"
                                                 style="object-fit: cover; border-radius: 16px;" alt="Oil Changing">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title">15 Years Of Experience</h3>
                                        <p class="mb-4 ser-paragragh">
                                            Oil changing maintains engine health by reducing friction, preventing overheating, 
                                            and ensuring smooth performance for your vehicle.
                                        </p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="/project_2/app/servicess/services.php" class="btn btn-primary py-3 px-5 mt-3 ser-button">
                                            Read More <i class="fa fa-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Discount Banner Section ===== -->
        <section class="discount container-fluid py-5">
            <div class="container text-center">
                <h6 class="dis-title wow fadeInUp" data-wow-delay="0.1s">Start Shopping Today</h6>
                <h1 class="wow fadeInUp" data-wow-delay="0.2s">
                    Get <span>20%</span> Discount<br>on Your First Purchase
                </h1>
                <a href="/project_2/app/discounts/discount.php" class="wow fadeInUp" data-wow-delay="0.3s">
                    Explore Auto Parts <i class="fa fa-arrow-right ms-2"></i>
                </a>
            </div>
        </section>

        <!-- ===== Call To Action Section ===== -->
        <section class="container-fluid call-us">
            <div class="container wow fadeInUp" data-wow-delay="0.2s">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="text-uppercase call-head">Call To Action</h6>
                        <h1 class="mb-4 call-title">Have Any Questions?</h1>
                        <p class="mb-0 call-para">
                            You can contact us for the best car maintenance services. 
                            We are available to answer your inquiries and schedule appointments easily. 
                            Call us today!
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="call-phone d-flex flex-column justify-content-center text-center h-100 p-4">
                            <h3 class="text-white mb-4">
                                <i class="fa-solid fa-phone me-2"></i>+0114 442 7878
                            </h3>
                            <a href="https://wa.me/201144427878" class="btn py-3 px-5">
                                Contact Us <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Back to Top Button -->
        <a href="#" class="btn btn-lg back-to-top">
            <i class="fa-solid fa-arrow-up"></i>
        </a>

    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <!-- Libraries JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/project_2/assets/bootstrap-5.0.2-dist/bootstrap-5.0.2-dist/js/bootstrap.min.js"></script>
    <script src="/project_2/assets/lib/wow/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
    <script src="/project_2/assets/lib/easing/easing.min.js"></script>
    <script src="/project_2/assets/lib/waypoints/waypoints.min.js"></script>
    <script src="/project_2/assets/lib/counterup/counterup.min.js"></script>
    <script src="/project_2/assets/lib/tempusdominus/js/moment-timezone.min.js"></script>

    <!-- SwiperJS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 4,
                },
            },
        });
    </script>

    <!-- Main JS -->
    <script src="/project_2/assets/js/home_car-box.js"></script>
    <script src="/project_2/assets/js/home_main.js"></script>

    <!-- Floating Cart Icon -->
    <div class="cart-icon-container">
        <a href="/project_2/app/Baskets/basket.php" class="cart-icon">
            <i class="fas fa-shopping-cart"></i>
            <span class="cart-count" id="cart-count"><?= $cart_items_count ?></span>
        </a>
    </div>

    <div id="overlay"></div>

    <script src="/project_2/assets/js/sidebar.js"></script>
    
    <!-- Back to Top Script -->
    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 300) {
                $('.back-to-top').fadeIn();
            } else {
                $('.back-to-top').fadeOut();
            }
        });
        
        $('.back-to-top').click(function(e) {
            e.preventDefault();
            $('html, body').animate({scrollTop: 0}, 600);
        });
    </script>
</body>

</html>
