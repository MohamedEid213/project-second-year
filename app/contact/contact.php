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
    <title>Contact</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_contact.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main id="main">
        <div class="contact">
            <div class="contant">
                <h2>Contact Us</h2>
                <p>Feel free to reach out for any inquries or feedback. We are here to help!</p>
                <form>
                    <input type="text" name="Name" id="N" placeholder="Your Name">
                    <input type="email" name="email" id="E" placeholder="Your Email">
                    <textarea name="message" id="message" rows="7" placeholder="Enter Your Message"></textarea>
                    <button type="submit" class="btn-submit">Send Message</button>
                </form>
                <!--icons-->
                <div class="social-media">
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-google"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>

            </div>
            <!--map-->
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3486.2792027341325!2d31.112262424389698!3d29.097437475414203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145a27c9ad31e973%3A0xc9a95cfad8824ea7!2z2KfZhNmF2LnZh9ivINin2YTYqtmD2YbZiNmE2YjYrNmKINin2YTYudin2YTZiiDYqNio2YbZiiDYs9mI2YrZgQ!5e0!3m2!1sar!2seg!4v1744325996071!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <script src="/project_2/assets/js/js_contact.js"></script>

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