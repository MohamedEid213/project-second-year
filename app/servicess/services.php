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



$Sql_Services = "SELECT * FROM `services`";
$result_Services = mysqli_query($conn, $Sql_Services);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Services</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_service.css" />
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">
        <section id="home" class="hero">
            <div class="hero-content">
                <h1>Expert Auto Repair Services</h1>
                <p>Professional care for your vehicle with state-of-the-art equipment</p>
                <div class="hero-buttons">
                    <a href="#" class="cta-button secondary" >Schedule Service</a>
                    <a href="/project_2/app/contact/contact.php" class="cta-button primary">Contact Us</a>
                </div>
                <div class="hero-features">
                    <div class="feature">
                        <span class="feature-number">20+</span>
                        <span class="feature-text">Years Experience</span>
                    </div>
                    <div class="feature">
                        <span class="feature-number">10k+</span>
                        <span class="feature-text">Happy Customers</span>
                    </div>
                    <div class="feature">
                        <span class="feature-number">100%</span>
                        <span class="feature-text">Satisfaction</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="services">
            <h2>Our Services</h2>
            <div class="service-grid">


                <?php foreach ($result_Services as $row_Services) : ?>
                    <div class="service-card">
                        <div class="service-icon"><img src="/project_2/assets/image/image_serivce/<?= $row_Services['image'] ?>" alt="not found"></div>
                        <h3><?= $row_Services['s_name'] ?></h3>
                        <p><?= $row_Services['s_description'] ?></p>
                        <ul class="service-list">
                            <li>Tire Rotation</li>
                            <li>Wheel Balancing</li>
                            <li>Tire Replacement</li>
                            <li>Alignment Service</li>
                        </ul>
                        <a href="/project_2/app/dateils_services/dateils_service.php?id=<?= base64_encode($row_Services['service_id']); ?>" class="service-link">Learn More</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="why-us" class="why-us">
            <h2>Why Choose Us</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">🏆</div>
                    <h3>Expert Technicians</h3>
                    <p>ASE-certified mechanics with years of experience</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Fast Service</h3>
                    <p>Quick turnaround without compromising quality</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💰</div>
                    <h3>Fair Pricing</h3>
                    <p>Competitive rates and transparent pricing</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✨</div>
                    <h3>Quality Parts</h3>
                    <p>Only genuine OEM and high-quality parts used</p>
                </div>
            </div>
        </section>

        <section id="about" class="about">
            <h2>About Us</h2>
            <div class="about-content">
                <div class="about-text">
                    <p>With over 20 years of experience, AutoCare Pro has been providing top-quality auto repair services to our community. Our certified technicians use the latest technology to ensure your vehicle receives the best care possible.</p>
                    <p>We pride ourselves on:</p>
                    <ul class="about-list">
                        <li>✓ Certified ASE Master Technicians</li>
                        <li>✓ State-of-the-art diagnostic equipment</li>
                        <li>✓ Warranty on all repairs</li>
                        <li>✓ Comfortable waiting area with amenities</li>
                        <li>✓ Shuttle service for local customers</li>
                    </ul>
                </div>
                <div class="certification-badges">
                    <div class="badge">ASE Certified</div>
                    <div class="badge">AAA Approved</div>
                    <div class="badge">BBB A+ Rating</div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="testimonials">
            <h2>Customer Testimonials</h2>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>"Best auto repair shop in town! Fair prices and excellent service."</p>
                    <div class="customer-name">- John D.</div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>"They fixed my car quickly and professionally. Highly recommend!"</p>
                    <div class="customer-name">- Sarah M.</div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <p>"Honest mechanics who explain everything clearly. Great experience!"</p>
                    <div class="customer-name">- Mike R.</div>
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