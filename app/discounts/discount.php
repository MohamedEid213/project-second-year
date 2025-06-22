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
    <title>Discounts</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_discount.css">

</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>Exclusive Auto Repair Discounts</h1>
                <p>Save big on professional auto repair services. Limited time offers for new and existing customers!</p>
                <div class="hero-stats">
                    <div class="stat">
                        <strong>25+ Years</strong>
                        <span>Experience</span>
                    </div>
                    <div class="stat">
                        <strong>5000+</strong>
                        <span>Happy Customers</span>
                    </div>
                    <div class="stat">
                        <strong>ASE</strong>
                        <span>Certified Technicians</span>
                    </div>
                </div>
                <a href="#discounts" class="hero-cta">View All Discounts</a>
            </div>
        </section>

        <!-- Discount Offers -->
        <section id="discounts" class="discounts">
            <div class="container">
                <h2>Current Discount Offers</h2>
                <p class="section-subtitle">Professional auto repair services at unbeatable prices</p>

                <div class="discount-grid">
                    <div class="discount-card featured">
                        <div class="discount-badge">BEST VALUE</div>
                        <div class="discount-amount">30% OFF</div>
                        <h3>Complete Brake Service</h3>
                        <p>Includes brake pad replacement, rotor resurfacing, and brake fluid flush</p>
                        <ul class="service-includes">
                            <li>✓ Free brake inspection</li>
                            <li>✓ Premium brake pads</li>
                            <li>✓ Rotor resurfacing</li>
                            <li>✓ Brake fluid replacement</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 280</span>
                            <span class="discount-price">EGP 196</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>

                    <div class="discount-card">
                        <div class="discount-amount">EGP 25 OFF</div>
                        <h3>Oil Change Special</h3>
                        <p>Full synthetic oil change with 15-point inspection</p>
                        <ul class="service-includes">
                            <li>✓ Full synthetic oil</li>
                            <li>✓ New oil filter</li>
                            <li>✓ 15-point inspection</li>
                            <li>✓ Fluid top-off</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 75</span>
                            <span class="discount-price">EGP 50</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>

                    <div class="discount-card">
                        <div class="discount-amount">40% OFF</div>
                        <h3>AC System Service</h3>
                        <p>Complete AC system check and refrigerant recharge</p>
                        <ul class="service-includes">
                            <li>✓ System diagnostic</li>
                            <li>✓ Leak detection</li>
                            <li>✓ Refrigerant recharge</li>
                            <li>✓ Performance test</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 150</span>
                            <span class="discount-price">EGP 90</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>

                    <div class="discount-card">
                        <div class="discount-amount">FREE</div>
                        <h3>Diagnostic Service</h3>
                        <p>Complete computer diagnostic with any repair over $200</p>
                        <ul class="service-includes">
                            <li>✓ OBD-II scan</li>
                            <li>✓ System analysis</li>
                            <li>✓ Written report</li>
                            <li>✓ Repair estimate</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 89</span>
                            <span class="discount-price">FREE*</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>

                    <div class="discount-card">
                        <div class="discount-amount">20% OFF</div>
                        <h3>Tire Rotation & Balance</h3>
                        <p>Extend tire life with professional rotation and balancing</p>
                        <ul class="service-includes">
                            <li>✓ Tire rotation</li>
                            <li>✓ Wheel balancing</li>
                            <li>✓ Pressure check</li>
                            <li>✓ Visual inspection</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 80</span>
                            <span class="discount-price">EGP 64</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>

                    <div class="discount-card">
                        <div class="discount-amount">15% OFF</div>
                        <h3>Transmission Service</h3>
                        <p>Keep your transmission running smoothly with regular service</p>
                        <ul class="service-includes">
                            <li>✓ Fluid change</li>
                            <li>✓ Filter replacement</li>
                            <li>✓ System inspection</li>
                            <li>✓ Performance check</li>
                        </ul>
                        <div class="price">
                            <span class="original-price">EGP 220</span>
                            <span class="discount-price">EGP 187</span>
                        </div>
                        <button class="book-btn">Book Now</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="services">
            <div class="container">
                <h2>Our Expert Services</h2>
                <div class="services-grid">
                    <div class="service-item">
                        <div class="service-icon">🔧</div>
                        <h3>Engine Repair</h3>
                        <p>Complete engine diagnostics and repair services</p>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">🛞</div>
                        <h3>Tire Services</h3>
                        <p>Tire installation, rotation, and balancing</p>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">⚡</div>
                        <h3>Electrical</h3>
                        <p>Battery, alternator, and electrical system repair</p>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">🛡️</div>
                        <h3>Brake Service</h3>
                        <p>Brake repair and replacement services</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section id="testimonials" class="testimonials">
            <div class="container">
                <h2>What Our Customers Say</h2>
                <div class="testimonials-grid">
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Excellent service and fair prices. The discount on my brake service saved me over $80!"</p>
                        <div class="customer">
                            <strong>Sarah Johnson</strong>
                            <span>Verified Customer</span>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Professional technicians who explain everything clearly. Great discounts for quality work."</p>
                        <div class="customer">
                            <strong>Mike Rodriguez</strong>
                            <span>Verified Customer</span>
                        </div>
                    </div>
                    <div class="testimonial">
                        <div class="stars">★★★★★</div>
                        <p>"Been coming here for 5 years. Always honest pricing and excellent customer service."</p>
                        <div class="customer">
                            <strong>Lisa Chen</strong>
                            <span>Verified Customer</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact">
            <div class="container">
                <h2>Visit Us Today</h2>
                <div class="contact-grid">
                    <div class="contact-info">
                        <h3>Elite Auto Repair Center</h3>
                        <div class="contact-item">
                            <strong>📍 Address:</strong>
                            <span>1234 Main Street, Automotive District, CA 90210</span>
                        </div>
                        <div class="contact-item">
                            <strong>📞 Phone:</strong>
                            <span>(555) 123-AUTO</span>
                        </div>
                        <div class="contact-item">
                            <strong>🕒 Hours:</strong>
                            <span>Mon-Fri: 7AM-6PM | Sat: 8AM-4PM | Sun: Closed</span>
                        </div>
                        <div class="contact-item">
                            <strong>✉️ Email:</strong>
                            <span>info@eliteautorepair.com</span>
                        </div>
                    </div>
                    <div class="contact-cta">
                        <h3>Ready to Save?</h3>
                        <p>Call now to schedule your discounted service appointment</p>
                        <button class="cta-phone">(555) 123-AUTO</button>
                        <p class="discount-note">*Discounts cannot be combined. Valid through end of month.</p>
                    </div>
                </div>
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

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>