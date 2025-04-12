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

$Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
$All_Category = mysqli_query($conn, $Select_Category);

$Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_Brands);

$Select_Product = 'SELECT * FROM `products` ORDER BY product_id DESC';
$result = mysqli_query($conn, $Select_Product);
$All_Products = mysqli_fetch_all($result, MYSQLI_ASSOC); // هذا سيجلب جميع المنتجات كمصفوفة



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Categories</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="/project_2/assets/css/style_category.css">


</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <!-- محتوى الصفحة -->
    <main id="content_page" class="h-auto">
        <section id="cover">
            <div class="images ">
                <img class='image' src="https://img.freepik.com/premium-photo/electric-car-charging-station-generative-ai_834602-17645.jpg" alt="">
                <div class="content col-11 col-md-8">
                    <h2> Our Featured Products </h2>
                    <strong> 👋 Welcome <?= $username ?> to Auto Repair Center!</strong>
                    <p> We're glad to have you here and wish you a great experience.</p>
                    <div style="text-align:center; margin-top: 12px;">
                        <a href="/project_2/app/contact/contact.php" class="btn">Contact Us</a>
                    </div>
                </div>
                <section class="swiper mySwiper">

                    <?php if (!empty($All_Products)): ?>
                        <div class="swiper-wrapper">
                            <?php foreach ($All_Products as $product): ?>
                                <div class="swiper-slide">
                                    <div class="product-card">
                                        <button class="heart-btn">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                        <a href="/project_2/app/dateils/Dateils.php?id=<?= base64_encode($product['product_id']) ?>">
                                            <img src="/project_2/data/uploads/image_products/<?= $product['Images'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                                        </a>
                                        <div class="product-info">
                                            <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                                            <p class="price">$<?= $product['price'] ?></p>
                                            <button class="add-to-cart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="no-products-message">
                            <i class="fas fa-box-open fa-3x"></i>
                            <h3>No Products Available</h3>
                            <p>We currently don't have any products in this category.</p>
                            <a href="/project_2/Home.php" class="btn btn-primary">Browse Other Categories</a>
                        </div>
                    <?php endif; ?>

                    <!-- <div class="swiper-slide">
                            <div class="product-card">
                                <button class="heart-btn">
                                    <i class="fa-regular fa-heart"></i>
                                </button>
                                <a href="#">
                                    <img src="/project_2/assets/image/image_home/products/child_car_seat.png" alt="Child Car Seat">
                                </a>
                                <div class="product-info">
                                    <h3>مقعد سيارة للأطفال</h3>
                                    <p class="price">$85.00</p>
                                    <button class="add-to-cart">أضف إلى السلة</button>
                                </div>
                            </div>
                        </div>
            </div> -->
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

        <section class="products-section">
            <div class="container py-5">
                <div class="row">
                    <!-- Search Box -->
                    <div class="col-12 col-lg-8 mx-auto mb-4">
                        <div class="search-box">
                            <input type="text" placeholder="Search products..." class="search-input" onkeyup="search()">
                            <button class="search-btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="col-12 mb-4 filters-container">
                        <div class="row align-items-center">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="filter-group">
                                    <label>Categories:</label>
                                    <select name="category" class="form-select">
                                        <option selected>All Categories</option>
                                        <?php foreach ($All_Category as $category) : ?>
                                            <option class="fw-bold" value="<?= $category['category_id'] ?>"> <?= $category['C_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="filter-group">
                                    <label>Brand:</label>
                                    <select name="brand" class="form-select">
                                        <option selected>All Brands</option>
                                        <?php foreach ($All_Brands as $brand) : ?>
                                            <option class="fw-bold" value="<?= $brand['brand_id'] ?>"> <?= $brand['b_name'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Products Count -->
                    <div class="col-12 mb-4">
                        <div class="products-count">
                            <span><i class="fas fa-box-open"></i> Products: 24</span>
                            <span><i class="fas fa-tags"></i> Categories: 12</span>
                            <span><i class="fas fa-copyright"></i> Brands: 8</span>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="row products-grid">
                    <!-- Product 1 -->

                    <?php if (!empty($All_Products)): ?>
                        <?php foreach ($All_Products as $product): ?>
                            <div class="col-12 col-md-6 col-lg-4 mb-4 product-item">
                                <div class="product-card">
                                    <div class="product-badge">Sale</div>
                                    <button class="wishlist-btn">
                                        <i class="far fa-heart"></i>
                                    </button>
                                    <a href="/project_2/app/dateils/Dateils.php?id=<?= base64_encode($product['product_id']) ?>" class="product-image">
                                        <img src="/project_2/data/uploads/image_products/<?= $product['Images'] ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                                    </a>
                                    <div class="product-body">
                                        <div class="product-rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <span class="rating-count">(24)</span>
                                        </div>
                                        <h3 class="product-title"><?= htmlspecialchars($product['product_name']) ?></h3>
                                        <p class="product-desc"><?= $product['description'] ?></p>
                                        <div class="product-footer">
                                            <span class="product-price">$<?= $product['price'] ?></span>
                                            <button class="add-to-cart">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="no-products-message">
                            <i class="fas fa-box-open fa-3x"></i>
                            <h3>No Products Available</h3>
                            <p>We currently don't have any products in this category.</p>
                            <a href="/project_2/Home.php" class="btn btn-primary">Browse Other Categories</a>
                        </div>
                    <?php endif; ?>
                    <!-- Product 2 -->
                    <!-- <div class="col-12 col-md-6 col-lg-4 mb-4 product-item">
                        <div class="product-card">
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                            <a href="shop-single.html" class="product-image">
                                <img src="/project_2/assets/image/image_basket.png" alt="Child Car Seat">
                            </a>
                            <div class="product-body">
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                    <span class="rating-count">(18)</span>
                                </div>
                                <h3 class="product-title">Child Car Seat</h3>
                                <p class="product-desc">Safe and comfortable seat for children.</p>
                                <div class="product-footer">
                                    <span class="product-price">$85.00</span>
                                    <button class="add-to-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <Product 3 
                    <div class="col-12 col-md-6 col-lg-4 mb-4 product-item">
                        <div class="product-card">
                            <div class="product-badge">New</div>
                            <button class="wishlist-btn">
                                <i class="far fa-heart"></i>
                            </button>
                            <a href="shop-single.html" class="product-image">
                                <img src="/project_2/assets/image/image_home/products/car_battery.png" alt="Car Battery">
                            </a>
                            <div class="product-body">
                                <div class="product-rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="rating-count">(32)</span>
                                </div>
                                <h3 class="product-title">Car Battery</h3>
                                <p class="product-desc">High performance battery for all weather conditions.</p>
                                <div class="product-footer">
                                    <span class="product-price">$150.00</span>
                                    <button class="add-to-cart">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
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