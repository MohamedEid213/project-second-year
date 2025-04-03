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
    <title>Contact</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_contact.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main id="contact1" class="h-auto">
        <!-- محتوى الصفحة -->
        <h1>Contact Us</h1>
        <p>We're here to help! Fill the form below 👇</pc>
        <div class="form-container">
            <form>
                <input type="text" id="name" placeholder="Your Name">
                <input type="email" id="email" placeholder="Your Email">
                <textarea id="message" placeholder="Your Message"></textarea>
                <button type="submit" onclick="sendMessage()">Send Message</button>
            </form>
        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <script src="/project_2/assets/js/js_contact.js"></script>
</body>

</html>