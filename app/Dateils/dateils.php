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
    <title>Product Details</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_details.css">

</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">
        <section id="body1234">
            <div class="container">
                <div class="product-card">
                    <div class="product-main">
                        <div class="product-images">
                            <img class="main-image" src="download (6).jpeg" alt="Premium Headphones">
                            <button class="favorite-button">❤️</button>
                        </div>

                        <div class="product-details">
                            <div class="product-header">
                                <div>
                                    <h1 id="product-title" class="product-title">Premuime Change Oil</h1>
                                    <p class="product-brand">**Total Services Hub**</p>
                                </div>
                                <button class="share-button">🔗</button>
                            </div>

                            <div class="rating">
                                <div class="stars">★★★★☆</div>
                                <span class="review-count">4.0 (128 reviews)</span>
                            </div>

                            <div class="description">
                                <h2>Description</h2>
                                <p>
                                    Our oil change service keeps your engine running smoothly,
                                    reduces wear, and improves fuel efficiency.
                                    We use high-quality oil and filters for better performance and engine protection. Quick, reliable,
                                    and essential for your car’s health!
                                </p>
                            </div>

                            <div class="features">
                                <h2>Key Features</h2>
                                <ul>
                                    <li><span class="feature-dot"></span>High-Quality Oil & Filter</li>
                                    <li><span class="feature-dot"></span>Improved Fuel Efficiency</li>
                                    <li><span class="feature-dot"></span>Comprehensive Inspection</li>
                                </ul>
                            </div>

                            <div class="price-section">
                                <div class="price-header">
                                    <span class="price">$299.99</span>
                                    <span class="stock">In Stock</span>
                                </div>
                                <button class="add-to-cart">🛒 Add to Cart</button>
                            </div>

                            <div class="seller-section">
                                <div class="seller-info">
                                    <img class="seller-avatar" src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=256&q=80" alt="Seller">
                                    <div class="seller-details">
                                        <p class="seller-name">Sold by AudioTech Pro</p>
                                        <p class="seller-rating">Verified Seller • 4.9 Rating</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="thumbnail-gallery">
                        <img class="thumbnail" src="download (5).jpeg" alt="Product view 1">
                        <img class="thumbnail" src="download (5).jpeg" alt="Product view 2">
                        <img class="thumbnail" src="download (5).jpeg" alt="Product view 3">
                        <img class="thumbnail" src="download (5).jpeg" alt="Product view 4">
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
</body>

</html>