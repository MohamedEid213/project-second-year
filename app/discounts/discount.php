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
        <section class="hero">
            <div class="hero-content">
                <h2 class="rainbow-text slide-in">Mega Sale Event</h2>
                <p class="glow-text fade-in">Exclusive Deals Up to 70% OFF</p>
                <div class="hero-cta bounce-in">
                    <button class="cta-button pulse">Shop Now</button>
                    <span class="cta-text shimmer">Limited Time Only!</span>
                </div>
            </div>
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
                <div class="shape shape-5"></div>
            </div>
        </section>

        <section class="features">
            <div class="feature-card color-shift">
                <div class="feature-icon">🎁</div>
                <h3>Special Gifts</h3>
                <p>Free gift on orders over $100</p>
            </div>
            <div class="feature-card color-shift">
                <div class="feature-icon">🚚</div>
                <h3>Express Delivery</h3>
                <p>Free shipping worldwide</p>
            </div>
            <div class="feature-card color-shift">
                <div class="feature-icon">💎</div>
                <h3>Premium Quality</h3>
                <p>100% satisfaction guaranteed</p>
            </div>
        </section>

        <section class="products">
            <h2 class="section-title rainbow-text">Hot Deals</h2>
            <div class="product-grid">
                <div class="product-card gradient-border">
                    <div class="discount-badge pulse">-40%</div>
                    <div class="product-label shimmer">Best Seller</div>
                    <img src="/project_2/assets/image/images_discount/wal1.jpg" alt="Product 1" class="product-image">
                    <div class="product-info">
                        <h3>AC Compressor</h3>
                        <div class="rating">
                            ⭐⭐⭐⭐⭐ <span>(128)</span>
                        </div>
                        <div class="price">
                            <span class="original-price">£E199.99</span>
                            <span class="discounted-price glow-text">£E119.99</span>
                        </div>
                        <button class="buy-btn color-shift">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card gradient-border">
                    <div class="discount-badge pulse">-50%</div>
                    <div class="product-label shimmer">Hot Deal</div>
                    <img src="/project_2/assets/image/images_discount/wal2.jpg" alt="Product 2" class="product-image">
                    <div class="product-info">
                        <h3>Brake Discs</h3>
                        <div class="rating">
                            ⭐⭐⭐⭐½ <span>(94)</span>
                        </div>
                        <div class="price">
                            <span class="original-price">£E299.99</span>
                            <span class="discounted-price glow-text">£E149.99</span>
                        </div>
                        <button class="buy-btn color-shift">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card gradient-border">
                    <div class="discount-badge pulse">-30%</div>
                    <div class="product-label shimmer">New Arrival</div>
                    <img src="/project_2/assets/image/images_discount/wal3.jpg" alt="Product 3" class="product-image">
                    <div class="product-info">
                        <h3>Car Batteries</h3>
                        <div class="rating">
                            ⭐⭐⭐⭐ <span>(76)</span>
                        </div>
                        <div class="price">
                            <span class="original-price">£E159.99</span>
                            <span class="discounted-price glow-text">£E111.99</span>
                        </div>
                        <button class="buy-btn color-shift">Add to Cart</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="timer gradient-bg">
            <div class="timer-content">
                <h2 class="rainbow-text">Flash Sale Ends In</h2>
                <p class="offer-text glow-text">Hurry up! Don't miss these incredible offers!</p>
                <div class="countdown">
                    <div class="time-block shimmer">
                        <span class="number">48</span>
                        <span class="label">Hours</span>
                    </div>
                    <div class="time-block shimmer">
                        <span class="number">35</span>
                        <span class="label">Minutes</span>
                    </div>
                    <div class="time-block shimmer">
                        <span class="number">20</span>
                        <span class="label">Seconds</span>
                    </div>
                </div>
            </div>
        </section>

        <section class="deals-grid">
            <div class="deal-item color-shift">
                <span class="deal-tag">MEGA DEAL</span>
                <h3>Radiators</h3>
                <p>Up to 60% OFF</p>
            </div>
            <div class="deal-item color-shift">
                <span class="deal-tag">FLASH SALE</span>
                <h3>Brake Pads</h3>
                <p>Buy 1 Get 1 Free</p>
            </div>
            <div class="deal-item color-shift">
                <span class="deal-tag">LIMITED</span>
                <h3>Car Tires</h3>
                <p>From £E49.99</p>
            </div>
            <div class="deal-item color-shift">
                <span class="deal-tag">SPECIAL</span>
                <h3>Timing Belts</h3>
                <p>30% OFF</p>
            </div>
        </section>

        <section class="newsletter gradient-bg">
            <div class="newsletter-content">
                <h2 class="rainbow-text">Get Exclusive Deals</h2>
                <p class="glow-text">Subscribe now and get $20 off on your first purchase!</p>
                <form class="subscribe-form">
                    <input type="email" placeholder="Enter your email address" required class="gradient-border">
                    <button type="submit" class="color-shift">Get Deals</button>
                </form>
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