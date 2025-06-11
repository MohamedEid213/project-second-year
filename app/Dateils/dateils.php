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

$product_id = base64_decode($_GET['id']);


$select_product = "SELECT * FROM products WHERE Product_id = $product_id";
$product_result = mysqli_query($conn, $select_product);

$select_ALL_Product = "SELECT * FROM products";
$Data_Product = mysqli_query($conn, $select_ALL_Product);


// معالجة إضافة المنتج إلى السلة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {

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


    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $_GET['id']);
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Product Details</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_details.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_payment.css">


</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">

        <section id="body1234">

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
            <div class="container">
                <div class="product-card2">
                    <div class="product-main">
                        <?php foreach ($product_result as $product):   ?>
                            <div class="product-images">
                                <img class="main-image" src="/project_2/data/uploads/image_products/<?= $product['Images'] ?>" alt="Premium Headphones">
                                <button class="favorite-button">❤️</button>
                            </div>

                            <div class="product-details">
                                <div class="product-header">
                                    <div>
                                        <h1 id="product-title" class="product-title"><?= $product['product_name'] ?></h1>
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
                                        <?= $product['description'] ?>
                                    </p>
                                </div>

                            
                                <div class="price-section">
                                    <div class="price-header">
                                        <span class="price">$<?= $product['price'] ?></span>
                                        <span class="stock">In Stock</span>
                                    </div>
                                    <div class="button-group">
                                        <button class="add-to-cart" name="add_to_cart">🛒 Add to Cart</button>
                                        <button onclick="openPaymentModal()" class="pay-now">💳 Pay Now</button>
                                    </div>
                                </div>
                            <?php endforeach; ?>


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

                    <h2 class="text-center fw-bold">Similar products </h2>
                    <div class="thumbnail-gallery">
                        <?php foreach ($Data_Product as $products): ?>
                            <div class="thumbnail-container">
                                <a href="/project_2/app/dateils/Dateils.php?id=<?= base64_encode($products['product_id']) ?>" class="thumbnail-link">
                                    <img class="thumbnail" src="/project_2/data/uploads/image_products/<?= $products['Images'] ?>"
                                        alt="<?= htmlspecialchars($products['product_name']) ?>"
                                        loading="lazy">
                                    <div class="thumbnail-overlay">
                                        <span class="product-name"><?= htmlspecialchars($products['product_name']) ?></span>
                                        <?php if (isset($products['price'])): ?>
                                            <span class="product-price">$<?= number_format($products['price'], 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
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

    <!-- إضافة Modal الدفع في نهاية الصفحة قبل إغلاق body -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class='modal-header'>
                <span class="close-modal" onclick="closePaymentModal()">&times;</span>
            </div>
            <div class="modal-body">

                <form id="paymentForm">
                    <div class="row">
                        <div class="col">
                            <h3 class="title">Billing Address</h3>
                            <div class="inputBox">
                                <span>Full Name:</span>
                                <input type="text" placeholder="Enter your full name" required>
                            </div>
                            <div class="inputBox">
                                <span>Email:</span>
                                <input type="email" placeholder="example@example.com" required>
                            </div>
                            <div class="inputBox">
                                <span>Address:</span>
                                <input type="text" placeholder="Room - Street - Locality" required>
                            </div>
                            <div class="inputBox">
                                <span>City:</span>
                                <input type="text" placeholder="Enter your city" required>
                            </div>
                            <div class="flex">
                                <div class="inputBox">
                                    <span>State:</span>
                                    <input type="text" placeholder="Enter your state" required>
                                </div>
                                <div class="inputBox">
                                    <span>Zip Code:</span>
                                    <input type="text" placeholder="123 456" required>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="">

                                <h3 class="title">Payment</h3>
                            </div>

                            <div class="inputBox">
                                <span>Cards Accepted:</span>
                                <img src="/project_2/assets/image/card_img.png" alt="Accepted Cards">
                            </div>
                            <div class="inputBox">
                                <span>Name on Card:</span>
                                <input type="text" placeholder="Enter card holder name" required>
                            </div>
                            <div class="inputBox">
                                <span>Credit Card Number:</span>
                                <input type="text" placeholder="1111-2222-3333-4444" required>
                            </div>
                            <div class="inputBox">
                                <span>Exp Month:</span>
                                <input type="text" placeholder="January" required>
                            </div>
                            <div class="flex">
                                <div class="inputBox">
                                    <span>Exp Year:</span>
                                    <input type="number" placeholder="2024" required>
                                </div>
                                <div class="inputBox">
                                    <span>CVV:</span>
                                    <input type="text" placeholder="123" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="submit-btn">Proceed to Checkout</button>
                </form>
            </div>
        </div>
    </div>


    <!-- إضافة JavaScript للتحكم في المودال -->
    <script>
        function openPaymentModal() {
            document.getElementById('paymentModal').style.display = 'block';
            document.body.style.overflow = 'hidden';
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // إغلاق المودال عند النقر خارج المحتوى
        window.onclick = function(event) {
            const modal = document.getElementById('paymentModal');
            if (event.target == modal) {
                closePaymentModal();
            }
        }

        // التحقق من صحة النموذج
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // هنا يمكنك إضافة التحقق من صحة البيانات وإرسالها
            const formData = new FormData(this);

            // إظهار رسالة نجاح
            alert('تم معالجة الدفع بنجاح!');
            closePaymentModal();
        });
    </script>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>