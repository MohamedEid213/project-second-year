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
    <link rel="stylesheet" href="/project_2/assets/css/style_payment.css">

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
                                        <button class="buy-now-btn" onclick="openPaymentModal(<?= $product['price'] ?>, '<?= $product['product_name'] ?>')">Buy Now</button>
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

    <!-- إضافة Modal الدفع في نهاية الصفحة قبل إغلاق body -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class='modal-header'>
                <span class="close-modal" onclick="closePaymentModal()">&times;</span>
            </div>

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
                    <h3 class="title">Payment</h3>
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
        function openPaymentModal(price, productName) {
            document.getElementById('paymentModal').style.display = 'block';
            document.body.style.overflow = 'hidden';

            // تحديث تفاصيل الطلب
            document.getElementById('productName').textContent = productName;
            document.getElementById('totalAmount').textContent = '£E' + price;
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

            // إعادة توجيه المستخدم إلى صفحة التأكيد أو الصفحة الرئيسية
            // window.location.href = '/project_2/app/confirmation.php';
        });
    </script>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>