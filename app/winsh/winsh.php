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
    <title>Home</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/styles_winsh.css" class="">
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY411pvfXUGOPOpSlxjGWPGh8j8lytiu8&callback=initMap"></script>
</head>

<body class=>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">

        <section class="hero-section">
            <img src="/project_2/assets/image/images_winsh/Screenshot 2025-04-07 104403.png" alt="خلفية البطل" class="hero-image">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>An emergency case? We are here to help</h1>
                <p>Call us immediately if you face any emergency.</p>
                <a href="#" class="btn-primary" onclick="openPopup()">Call us now</a>
            </div>
        </section>


        <section id="contact" class="contact-section">
            <div class="form-container">
                <h2>A request for transfer</h2>
                <form id="contactForm" action="#" method="POST">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <div class="location-input">
                            <input type="text" id="location" name="location" placeholder="Click to select the site" readonly required>
                            <img src="/project_2/assets/image/images_winsh//marker.png" alt="أيقونة الموقع" onclick="openMapPopup()" style="cursor:pointer;" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">Case details</label>
                        <textarea id="message" name="message" rows="4" placeholder="Enter the details of the emergency situation" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">Send now</button>
                </form>

                <div id="confirmationMessage" style="display:none; text-align:center; padding:50px;">
                    <h1>تم ارسال الطلب</h1>
                    <p>سيتواصل معك فريق الدعم حالا</p>
                </div>
            </div>
        </section>


        <div class="contact-popup" id="contactPopup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                <h2>Contact us</h2>
                <ul>
                    <li>📞 <strong>phone number:</strong> +201118957502</li>
                    <li>💬 <strong>WhatsApp:</strong> <a href="https://wa.me/201118957502" target="_blank">Click here</a></li>
                    <li>📲 <strong>Telegram:</strong> <a href="https://t.me/+201118957502" target="_blank">Click here</a></li>
                </ul>
            </div>
        </div>


        <div class="map-popup" id="mapPopup">
            <div class="popup-content">
                <span class="close-btn" onclick="closeMapPopup()">&times;</span>
                <h2>Determine your site</h2>
                <div id="map" style="height:300px;"></div>
                <button class="btn-submit" onclick="confirmLocation()">Confirmation of the site</button>
            </div>
        </div>

    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>


    <script>
        function openPopup() {
            document.getElementById("contactPopup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("contactPopup").style.display = "none";
        }


        var map;
        var marker;


        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 30.0444,
                    lng: 31.2357
                },
                zoom: 8
            });

            map.addListener('click', function(e) {
                placeMarker(e.latLng);
            });
        }


        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map
                });
            }

            document.getElementById("location").value = location.lat().toFixed(6) + ", " + location.lng().toFixed(6);
        }

        function openMapPopup() {
            document.getElementById("mapPopup").style.display = "flex";

            google.maps.event.trigger(map, "resize");
        }

        function closeMapPopup() {
            document.getElementById("mapPopup").style.display = "none";
        }

        function confirmLocation() {
            closeMapPopup();
        }


        document.getElementById("contactForm").addEventListener("submit", function(e) {
            e.preventDefault();

            this.style.display = "none";
            document.getElementById("confirmationMessage").style.display = "block";
        });
    </script>
    <div id="overlay"></div>


</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>