<?php

session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project/vendor/config.php');

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    $username = $_SESSION['username'];
    $email = $_SESSION['email'];


    $title = 'contact us';
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project/shared/header.php');
    echo '<body>';
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project/shared/navbar.php');

    include_once($_SERVER['DOCUMENT_ROOT'] . '/project/shared/sidebar.php');
?>

    <!-- Contact Section -->
    <section id="contact1">
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
    </section>

    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project/shared/script.php'); ?>

    </body>

    </html>

<?php



} ?>