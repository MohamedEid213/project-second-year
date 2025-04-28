<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header('location: ./index.php');
    exit();
}


$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

// استعلامات لجلب البيانات
$Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
$All_Category = mysqli_query($conn, $Select_Category);

$Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_Brands);


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

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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

                            <?php foreach ($All_Products as $product):   ?>

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
                                            <p class="price">£E<?= $product['price'] ?></p>
                                            <form method="POST" class="add-to-cart-form">

                                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                                <button type="submit" name="add_to_cart" class="add-to-cart">
                                                    Add to Cart
                                                </button>
                                            </form>
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
                                            <span class="product-price">£E<?= $product['price'] ?></span>
                                            <form method="POST" class="add-to-cart-form">

                                                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                                                <button type="submit" name="add_to_cart" class="add-to-cart">
                                                    Add to Cart
                                                </button>
                                            </form>

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