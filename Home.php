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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_home.css">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="/project_2/assets/lib/animate/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">

    <!-- Linking SwiperJS Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">


</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>


    <main class="">

        <!-- Start our car repair workshop -->
        <div class="cont">
            <div class="intro-screen" id="introScreen">
                <img src="/project_2/assets/image/image_home/maintenance (1).png" alt="Car-image" class="car-image" id="carImage" onclick="startCar()">
                <p class="intro-text" id="introText">Click on the car to start the website.</p>
            </div>
        </div>
        <audio id="hoverSound" src="/project_2/assets/image/image_home/Sound_1.mp3"></audio>
        <audio id="engineSound" src="/project_2/assets/image/image_home/Sound_2.mp3"></audio>
        <!-- End our car repair workshop  -->




        <!-- Start Landing -->
        <div id="landing" class="hero-wrap wow bounceInUp" data-wow-delay="0.1s" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                    <div class="col-lg-8 ftco-animate info">
                        <div class="text w-100 text-center mb-md-5 pb-md-5 wow bounceInUp">
                            <h1 class="mb-4 wow bounceInUp" data-wow-delay="0.5s">Welcome to <span>Auto Repair center</span> </h1>
                            <p class="wow bounceInUp" data-wow-delay="1s">A car repair workshop offering professional services for maintenance and repair of all vehicle types,
                                ensuring quality and affordable prices for all customers.
                            </p>
                            <a href="/project_2/assets/image/image_home/Landing-Video.mp4" class="video d-flex align-items-center mt-4 justify-content-center wow bounceInUp" data-wow-delay="1.5s">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="video-play"></span>
                                </div>
                                <div class="heading-title ml-5">
                                    <span>Easy steps for renting a car</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Landing -->

        <!-- Start how-it-work -->
        <div class="how-it-work container-fluid text-center">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/location.gif" alt="">
                            <a href="/project_2/app/location/location.php" class="link">Our Location</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/calendar.gif" alt="">
                            <a href="#" class="link">Pick-up Date</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="work-content">
                            <img src="/project_2/assets/image/image_home/car.gif" alt="">
                            <a href="#" class="link">Book Your Car</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End how-it-work -->


        <!-- start product -->
        <section class="products">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center mb-4 wow" data-wow-delay="0.5s">
                    <div class="title wow animate__fadeInLeft">
                        <h6 class="product-title">Featured Products</h6>
                        <h2 class="product-head">Popular <span>Products</span></h2>
                    </div>
                    <button class="btn-more wow animate__fadeInRight"><a href="/project_2/app/categories/category.php">Explore All</a></button>
                </div>

                <!-- Swiper -->
                <div class="swiper mySwiper animated zoomIn wow" data-wow-delay="0.8s">
                    <div class="swiper-wrapper">

                        <!-- Slide 1 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/car wheel.png" alt="Car Wheel">
                                <div class="product-name">Car Wheel</div>
                                <div class="card-content ">
                                    <div class="product-price">$300.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/child car seat.png" alt="Child Car Seat">
                                <div class="product-name">Child Car Seat</div>
                                <div class="card-content">
                                    <div class="product-price">$500.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/car seat.png" alt="Car Seat">
                                <div class="product-name">Car Seat</div>
                                <div class="card-content">
                                    <div class="product-price">$480.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/Tire Pressure Gauge.png" alt="Tire Pressure Gauge">
                                <div class="product-name">Tire Pressure Gauge</div>
                                <div class="card-content">
                                    <div class="product-price">$280.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 5 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/Springs.png" alt="Tire Pressure Gauge">
                                <div class="product-name">Springs</div>
                                <div class="card-content">
                                    <div class="product-price">$320.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Slide 6 -->
                        <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn position-absolute top-0 end-0 m-2">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <img src="/project_2/assets/image/image_home/products/steering wheel.png" alt="Tire Pressure Gauge">
                                <div class="product-name">Steering Wheel</div>
                                <div class="card-content">
                                    <div class="product-price">$800.00</div>
                                    <button class="btn">
                                        <i class="fa-solid fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Arrows -->
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

        </section>
        <!-- End product -->


        <!-- Start About -->
        <div class="about container-fluid my-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-6">
                        <div class="image-container">
                            <img src="/project_2/assets/image/image_home/about.jpg" alt="big-image" class="big-image wow fadeInUp" data-wow-delay="0.1s">
                            <img src="/project_2/assets/image/image_home/service-2.jpg" alt="small-image" class="small-image wow fadeInUp" data-wow-delay="0.2s">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-6">
                        <div class="h5 wow fadeInUp" data-wow-delay="0.3s">Who We Are At Auto Repair Center</div>
                        <h2 class="ser-h1 wow fadeInUp" data-wow-delay="0.3s"><span>About Our</span> Auto Repair Center</h2>
                        <p class="paragraph wow fadeInUp" data-wow-delay="0.5s">
                            A mechanic can be a car owner's best friend or worst nightmare. When car problems arise, people
                            depend heavily on their mechanic to diagnose and repair the issue in as little time as possible.
                            They expect mechanics to work and ethically. To be a great mechanic, you should have the
                            following qualities, Creat mechanics are able to relate to Customers. They are able to
                            communicate with them
                        </p>
                        <div class="list-icon wow fadeInUp" data-wow-delay="0.7s">
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="unorder-list">
                                        <li><i class="fa-solid fa-check ico-true"></i> Strong Customer Service</li>
                                        <li><i class="fa-solid fa-check ico-true"></i> Problem-Solving Skills</li>
                                        <li><i class="fa-solid fa-check ico-true"></i> Strong Technical Aptitude</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="unorder-list">
                                        <li><i class="fa-solid fa-check ico-true"></i> Good Diagnostic Skills</li>
                                        <li><i class="fa-solid fa-check ico-true"></i> Solid Work Ethic</li>
                                        <li><i class="fa-solid fa-check ico-true"></i> Leadership</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End About -->


        <!-- Start State -->
        <div class="container-fluid fact bg-dark my-5 py-5" id="state">
            <div class="container">
                <h6 class="state-title text-center wow animate__fadeInLeft">See Our Stats And Skils</h6>
                <h3 class="state-head text-center wow animate__fadeInRight"><span>Professional</span> autoparts</h3>
                <div class="state-content row g-4">
                    <div class="box col-md-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                        <i class="fa fa-check fa-2x"></i>
                        <h2 data-toggle="counter-up">5234</h2>
                        <p>Years of Experience</p>
                    </div>
                    <div class="box col-md-6 col-lg-4 text-center wow fadeIn" id="special" data-wow-delay="0.3s">
                        <i class="fa fa-users-cog fa-2x"></i>
                        <h2 data-toggle="counter-up">4590</h2>
                        <p>Expert Technicians</p>
                    </div>
                    <div class="box col-md-6 col-lg-4 text-center wow fadeIn" data-wow-delay="0.7s">
                        <i class="fa fa-car fa-2x "></i>
                        <h2 data-toggle="counter-up">7176</h2>
                        <p>Compleate Projects</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End State -->


        <!-- Start Service -->
        <div class="container-fluid service py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h6 class="ser-head">Our Popular services</h6>
                    <h1 class="mb-5 ser-h1"><span>Popular</span> Car Services</h1>
                </div>
                <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-lg-4">
                        <div class="nav w-100 nav-pills me-4">
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active" data-bs-toggle="pill" data-bs-target="#tab-pane-1" type="button">
                                <i class="fa fa-car-side fa-2x me-3"></i>
                                <h4 class="m-0">Diagnostic Test</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-2" type="button">
                                <i class="fa fa-car fa-2x me-3"></i>
                                <h4 class="m-0">Engine Servicing</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4" data-bs-toggle="pill" data-bs-target="#tab-pane-3" type="button">
                                <i class="fa fa-cog fa-2x me-3"></i>
                                <h4 class="m-0">Tires Replacement</h4>
                            </button>
                            <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-0" data-bs-toggle="pill" data-bs-target="#tab-pane-4" type="button">
                                <i class="fa fa-oil-can fa-2x me-3"></i>
                                <h4 class="m-0">Oil Changing</h4>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content w-100">
                            <div class="tab-pane fade show active" id="tab-pane-1">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" src="/project_2/assets/image/image_home/service-1.jpg"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title fa-2x">15 Years Of Experience In Auto Servicing</h3>
                                        <p class="mb-4 ser-paragragh">A diagnostic test identifies vehicle issues using advanced tools, ensuring accurate troubleshooting and efficient repairs for optimal performance.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="" class="btn btn-primary py-3 px-5 mt-3 ser-button">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-2">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" src="/project_2/assets/image/image_home/service-2.jpg"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title fa-2x">15 Years Of Experience In Auto Servicing</h3>
                                        <p class="mb-4 ser-paragragh">Engine servicing includes oil changes, filter replacements, and inspections to ensure optimal performance, fuel efficiency, and prolonged engine life.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="" class="btn btn-primary  py-3 px-5 mt-3 ser-button">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-3">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" src="/project_2/assets/image/image_home/service-3.jpg"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title fa-2x">15 Years Of Experience In Auto Servicing</h3>
                                        <p class="mb-4 ser-paragragh">Tire replacement ensures safety, better traction, and fuel efficiency by installing high-quality tires suited for your vehicle’s performance needs.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="" class="btn btn-primary py-3 px-5 mt-3 ser-button">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-pane-4">
                                <div class="row g-4">
                                    <div class="col-md-6" style="min-height: 350px;">
                                        <div class="position-relative h-100">
                                            <img class="position-absolute img-fluid w-100 h-100" src="/project_2/assets/image/image_home/service-4.jpg"
                                                style="object-fit: cover;" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h3 class="mb-3 ser-title fa-2x">15 Years Of Experience In Auto Servicing</h3>
                                        <p class="mb-4 ser-paragragh">Oil changing maintains engine health by reducing friction, preventing overheating, and ensuring smooth performance, extending your vehicle’s lifespan efficiently.</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Quality Servicing</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Expert Workers</p>
                                        <p><i class="fa fa-check text-success me-3"></i>Modern Equipment</p>
                                        <a href="#" class="btn btn-primary py-3 px-5 mt-3 ser-button">Read More<i class="fa fa-arrow-right ms-3"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Service End -->


        <!-- Start Discount -->
        <div class="discount container-fluid py-5">
            <div class="container text-center wow">
                <h6 class="dis-title animate__fadeInLeft wow" data-wow-delay="0.2s">Start Shopping with top discounts</h6>
                <h1 class="animated zoomIn wow" data-wow-delay="0.5s">Get <span>20%</span> Discount <br>on your first Purchase</h1>
                <a href="/project_2/app/discounts/discount.php" class="wow animated zoomIn" data-wow-delay="0.8s">
                    Explore auto parts
                </a>
            </div>
        </div>
        <!-- End Discount -->


        <!-- Call To Action Start -->
        <div class="container-fluid call-us">
            <div class="container wow zoomIn" data-wow-delay="0.5s">
                <div class="row g-4">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="text-uppercase call-head">Call To Action</h6>
                        <h1 class="mb-4 call-title">Have Any Pre Booking Question</h1>
                        <p class="mb-0 call-para">You can contact us for the best car maintenance services. We are available to answer your inquiries and schedule appointments easily. Call us today!</p>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="call-phone d-flex flex-column justify-content-center text-center h-100 p-4">
                            <h3 class="text-white mb-4"><i class="fa-solid fa-phone"></i>+0114 442 7878</h3>
                            <a href="https://wa.me/201144427878" class="btn py-3 px-5">Contact Us<i class="fa fa-arrow-right ms-3"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call To Action End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg back-to-top"><i class="fa-solid fa-arrow-up"></i></a>




    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <!-- Libraries link Js -->
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
    <!-- Main Js -->
    <script src="/project_2/assets/js/home_car-box.js"></script>
    <script src="/project_2/assets/js/home_main.js"></script>
    
    <div id="overlay"></div>
</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>



<!-- 

html


    <div class="services container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="h-6 my-0 text-uppercase">Featured products <h6>
                <h1 class="ser-h1 mb-5 text-danger">Popular products</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/Car cleaning.jpeg" >
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/Oil and filter change.jpeg">
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/exhaust system repair.jpeg">
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/Roadside Assistance.jpeg">
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/Roadside Assistance.jpeg">
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="" src="/project_2/assets/image/image_home/Roadside Assistance.jpeg">
                    <div class="caption">
                        <h5 class="mb-0 text-start">Client Name</h5>
                        <p class="d-flex mb-0 d-block p-link">
                            <a href="#" class="btn btn-primary py-2 mr-1 a-first">Book Now</a>
                            <a href="#" class="btn btn-secondary py-2 mr-1 a-second">Details</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End 




=================
css


/*** Testimonial ***/

/* Start Services */
.services {
    background: linear-gradient(rgba(0, 0, 0, .9), rgba(0, 0, 0, .9)), url(../images/Car\ Body\ Shell.jpg);
    background-repeat: no-repeat;
    background-size: cover;
}
.testimonial-carousel {
    margin: auto;
    
}
.services  img{
    width: 100%;
    /* height: 220px; */
    aspect-ratio: 16 / 10; 
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.services .caption {
    padding: 20px 30px 30px;
    border: 1px solid #00000040;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: var(--light);
}
.services .caption .p-link {
    width: 100%;
    margin-top: 15px;
}
.services .caption .p-link .a-first {
    width: 50%;
    margin-right: 10px;
    background-color: var(--primary) !important;
    border: 1px solid var(--primary) !important;
    color: #fff !important;
}
.services .caption .p-link .a-second {
    width: 50%;
    background: var(--secondary) !important;
    border: 1px solid var(--secondary) !important;
    color: #fff !important;
}
/* End Services */
.testimonial-carousel .owl-item .testimonial-text,
.testimonial-carousel .owl-item.center .testimonial-text * {
    transition: .5s;
}

.testimonial-carousel .owl-item.center .testimonial-text {
    /* background: var(--primary) !important; */
}

.testimonial-carousel .owl-item.center .testimonial-text * {
    color: #FFFFFF !important;
}

.testimonial-carousel .owl-dots {
    margin-top: 24px;
    display: flex;
    align-items: flex-end;
    justify-content: center;
}

.testimonial-carousel .owl-dot {
    position: relative;
    display: inline-block;
    margin: 0 5px;
    width: 15px;
    height: 15px;
    border-radius: 50%;
    border: 1px solid #CCCCCC;
    transition: .5s;
}

.testimonial-carousel .owl-dot.active {
    background: var(--primary);
    border-color: var(--primary);
}




-->