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
    <title>Categories</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/project_2/assets/css/style_category.css">
    <link rel="stylesheet" href="/project_2/assets/css/products-search.css">


</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <!-- محتوى الصفحة -->
    <main id="content_page" class="h-auto">
        <section id="cover">
            <div class="image ">
                <img src="https://img.freepik.com/premium-photo/electric-car-charging-station-generative-ai_834602-17645.jpg" alt="">
                <div class="content col-11 col-md-8">
                    <h2> Our Featured Products </h2>
                    <strong> 👋 Welcome <?= $username ?> to Auto Repair Center!</strong>
                    <p> We're glad to have you here and wish you a great experience.</p>
                    <div style="text-align:center; margin-top: 12px;">
                        <a href="/project_2/app/contact/contact.php" class="btn">Contact Us</a>
                    </div>
                </div>
                <section class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide "></div>
                        <div class="swiper-slide ">Slide 2</div>
                        <div class="swiper-slide ">Slide 3</div>
                        <div class="swiper-slide ">Slide 4</div>
                        <div class="swiper-slide ">Slide 5</div>
                        <div class="swiper-slide ">Slide 6</div>
                        <div class="swiper-slide ">Slide 7</div>
                        <div class="swiper-slide ">Slide 8</div>
                        <div class="swiper-slide ">Slide 9</div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="autoplay-progress">
                        <svg viewBox="0 0 48 48">
                            <circle cx="24" cy="24" r="20"></circle>
                        </svg>
                        <span></span>
                    </div>
                </section>
            </div>
        </section>

        <section>
            <div class="container py-5">
                <div class="row text-center py-2">
                    <div class="col-lg-6 m-auto">
                        <div class="search-box  bg-light">
                            <input type="text" placeholder="Search..." class="search-input p-2" onkeyup="search()">
                            <i class="fa-solid fa-magnifying-glass text-light"></i>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12  m-auto bg-primary mb-1" id="view">
                        <ul class="selected-view views">
                            <li>Categories: <select name="" id="">
                                    <option value="" selected>All View Categories</option>
                                </select></li>
                            <li>Brand: <select name="" id="">
                                    <option selected value="">All View Brand</option>
                                </select></li>
                        </ul>
                        <ul class="count-view views">
                            <li>Products: 1</li>
                            <li>Categories: 22</li>
                            <li>Brand: 10</li>

                        </ul>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 mb-4" id="product-list">
                        <div class="card h-100" id="product">
                            <a href="shop-single.html">
                                <img src="image/Engine.png" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body" id="product-details">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                    <li class="text-muted text-right" id="price">E£740.00</li>
                                </ul>
                                <h2 class="h2 text-decoration-none ">Engine</h2>
                                <a href="#" class="card-text">
                                    The steering wheel allows the driver to control the vehicle's direction, ensuring precise and responsive handling.
                                </a>
                                <div class="info">
                                    <p class="text-muted" id="price">Reviews (24)</p>
                                    <a href="#">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" id="product-list">
                        <div class="card h-100" id="product">
                            <a href="shop-single.html">
                                <img src="image/Gear.png" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body" id="product-details">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                    <li class="text-muted text-right" id="price">E£740.00</li>
                                </ul>
                                <h2 class="h2 text-decoration-none ">Gear</h2>
                                <a href="#" class="card-text">
                                    The steering wheel allows the driver to control the vehicle's direction, ensuring precise and responsive handling.
                                </a>
                                <div class="info">
                                    <p class="text-muted" id="price">Reviews (24)</p>
                                    <a href="#">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 mb-4" id="product-list">
                        <div class="card h-100" id="product">
                            <a href="shop-single.html">
                                <img src="image/Suspension.png" class="card-img-top" alt="...">
                            </a>
                            <div class="card-body" id="product-details">
                                <ul class="list-unstyled d-flex justify-content-between">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                    <li class="text-muted text-right" id="price">E£740.00</li>
                                </ul>
                                <h2 class="h2 text-decoration-none ">Steering Wheel</h2>
                                <a href="#" class="card-text">
                                    The steering wheel allows the driver to control the vehicle's direction, ensuring precise and responsive handling.
                                </a>
                                <div class="info">
                                    <p class="text-muted" id="price">Reviews (24)</p>
                                    <a href="#">Add To Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <script src='/project_2/assets/js/category.js'></script>
    <script src='/project_2/assets/js/search_product.js'></script>

</body>

</html>