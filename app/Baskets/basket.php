<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

$num = 1;
$id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$Select_Products = "SELECT * FROM `baskets_products` WHERE `Client_id` = '$id' ORDER BY `basket_id` DESC ";
$All_product = mysqli_query($conn, $Select_Products);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shopping Cart</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_basket.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <?php if (mysqli_num_rows($All_product) > 0): ?>
            <!-- عرض المنتجات إذا كانت موجودة -->
            <div class="product-featured">

                <div class="products-container">
                    <?php foreach ($All_product as $product): ?>

                        <div class="showcase-container">
                            <a href="/project_2/app/Baskets/delete_basket.php?id=<?= base64_encode($product['basket_id']) ?>" class="delete-item" title="Remove item">
                                <i class="fa-solid fa-trash-can"></i>
                            </a>

                            <div class="showcase">
                                <a href="#" class="showcase-banner">
                                    <img src="/project_2/data/uploads/image_products/<?= $product['Images'] ?>"
                                        alt="Not Found"
                                        class="showcase-img" />
                                </a>

                                <div class="showcase-content">
                                    <div class="product-header">

                                        <h3 class="showcase-title">
                                            <?= $product['product_name'] ?>
                                        </h3>
                                    </div>

                                    <p class="showcase-desc">
                                        <?= $product['description'] ?>
                                    </p>

                                    <div class="showcase-rating">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <ion-icon name="<?= $i <= 4 ? 'star' : 'star-outline' ?>"></ion-icon>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="price-quantity-container">
                                        <div class="price-box">
                                            <p class="price">£E<?= $product['price'] ?></p>

                                            <del>£E<?= $product['price'] + 200 ?></del>

                                        </div>

                                        <div class="quantity-control">
                                            <button class="quantity-btn decrease" data-index="<?= $index ?>">-</button>
                                            <span class="quantity">1</span>
                                            <button class="quantity-btn increase" data-index="<?= $index ?>">+</button>
                                        </div>
                                    </div>

                                    <div class="action-buttons">

                                        <button class="buy-now-btn">Buy Now</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>


            </div>
        <?php else: ?>
            <!-- عرض رسالة السلة الفارغة -->
            <section class="empty-cart">
                <div class="empty-container">
                    <img src="/project_2/assets/image/image_basket.png" alt="Empty cart" class="empty-image">
                    <div class="empty-content">
                        <h2>Your Shopping Cart is Empty</h2>
                        <p>Looks like you haven't added any items to your cart yet.</p>
                        <a href="/project_2/app/discounts/discount.php" class="deals-link">Shop Today's Deals</a>
                        <a href="/project_2/app/categories/category.php" class="shop-btn">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="/project_2/assets/js/basket.js"></script>
    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>