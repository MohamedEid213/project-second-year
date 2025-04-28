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
            <div class="hero-image-container">
                <img src="/project_2/assets/image/images_winsh/Screenshot 2025-04-07 104403.png" alt="خلفية البطل" class="hero-image">
                <div class="hero-overlay"></div>
            </div>
            <div class="hero-content">
                <h1>An emergency case? We are here to help</h1>
                <p>Call us immediately if you face any emergency.</p>
                <div class="hero-buttons">
                    <a href="#" class="btn-primary" onclick="openPopup()">
                        <i class="fas fa-phone-alt"></i>
                        Call us now
                    </a>
                    <a href="#contact" class="btn-secondary">
                        <i class="fas fa-envelope"></i>
                        Send Request
                    </a>
                </div>
            </div>
        </section>


        <section id="contact" class="contact-section">
            <div class="section-header">
                <h2>A request for transfer</h2>
                <p>Fill out the form below and we'll get back to you immediately</p>
            </div>
            <div class="form-container">
                <form id="contactForm" action="#" method="POST">
                    <div class="form-group">
                        <label for="name">
                            <i class="fas fa-user"></i>
                            Name
                        </label>
                        <input type="text" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">
                            <i class="fas fa-phone"></i>
                            Phone Number
                        </label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter Your Phone Number" required>
                    </div>
                    <div class="form-group">
                        <label for="location">
                            <i class="fas fa-map-marker-alt"></i>
                            Location
                        </label>
                        <div class="location-input">
                            <input type="text" id="location" name="location" placeholder="Click to select the site" readonly required>
                            <button type="button" onclick="openMapPopup()" class="location-btn">
                                <i class="fas fa-map-marker-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="message">
                            <i class="fas fa-comment-alt"></i>
                            Case details
                        </label>
                        <textarea id="message" name="message" rows="4" placeholder="Enter the details of the emergency situation" required></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-paper-plane"></i>
                        Send now
                    </button>
                </form>

                <div id="confirmationMessage" class="confirmation-message">
                    <div class="confirmation-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>تم ارسال الطلب</h3>
                    <p>سيتواصل معك فريق الدعم حالا</p>
                </div>
            </div>
        </section>


        <div class="contact-popup" id="contactPopup">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                <h2>Contact us</h2>
                <div class="contact-info">
                    <div class="contact-method">
                        <i class="fas fa-phone-alt"></i>
                        <div class="contact-details">
                            <h3>Phone number</h3>
                            <a href="tel:+201118957502" class="contact-link">+201118957502</a>
                            <p>Available 24/7 for emergency calls</p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <i class="fab fa-whatsapp"></i>
                        <div class="contact-details">
                            <h3>WhatsApp</h3>
                            <a href="https://wa.me/201118957502" target="_blank" class="contact-link">Click to chat on WhatsApp</a>
                            <p>Fast response within minutes</p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <i class="fab fa-telegram"></i>
                        <div class="contact-details">
                            <h3>Telegram</h3>
                            <a href="https://t.me/+201118957502" target="_blank" class="contact-link">Click to message on Telegram</a>
                            <p>Available for text messages</p>
                        </div>
                    </div>
                </div>

                <div class="emergency-note">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>For immediate assistance, please call our emergency number directly.</p>
                </div>
            </div>
        </div>


        <div class="map-popup" id="mapPopup">
            <div class="popup-content">
                <span class="close-btn" onclick="closeMapPopup()">&times;</span>
                <h2>Determine your site</h2>
                <div id="map"></div>
                <button class="btn-submit" onclick="confirmLocation()">
                    <i class="fas fa-check"></i>
                    Confirmation of the site
                </button>
            </div>
        </div>

    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>


    <script>
        var map;
        var marker;
        var geocoder;

        function initMap() {
            // Initialize map with Cairo coordinates
            map = new google.maps.Map(document.getElementById("map"), {
                center: {
                    lat: 30.0444,
                    lng: 31.2357
                },
                zoom: 12,
                mapTypeControl: true,
                streetViewControl: true,
                fullscreenControl: true
            });

            // Initialize geocoder
            geocoder = new google.maps.Geocoder();

            // Add click listener to map
            map.addListener('click', function(e) {
                placeMarker(e.latLng);
                updateLocationText(e.latLng);
            });

            // Try to get user's current location
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    map.setCenter(pos);
                    placeMarker(pos);
                    updateLocationText(pos);
                }, function() {
                    // Handle error
                    console.log("Error: The Geolocation service failed.");
                });
            }
        }

        function placeMarker(location) {
            if (marker) {
                marker.setPosition(location);
            } else {
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP
                });

                // Add drag listener to marker
                marker.addListener('dragend', function() {
                    updateLocationText(marker.getPosition());
                });
            }
        }

        function updateLocationText(location) {
            // Get address from coordinates
            geocoder.geocode({
                location: location
            }, function(results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        document.getElementById("location").value = results[0].formatted_address;
                    } else {
                        document.getElementById("location").value = location.lat().toFixed(6) + ", " + location.lng().toFixed(6);
                    }
                } else {
                    document.getElementById("location").value = location.lat().toFixed(6) + ", " + location.lng().toFixed(6);
                }
            });
        }

        function openMapPopup() {
            document.getElementById("mapPopup").style.display = "flex";
            // Trigger map resize after popup is shown
            setTimeout(function() {
                google.maps.event.trigger(map, "resize");
                if (marker) {
                    map.setCenter(marker.getPosition());
                }
            }, 100);
        }

        function closeMapPopup() {
            document.getElementById("mapPopup").style.display = "none";
        }

        function confirmLocation() {
            if (marker) {
                updateLocationText(marker.getPosition());
            }
            closeMapPopup();
        }

        // Contact form submission
        document.getElementById("contactForm").addEventListener("submit", function(e) {
            e.preventDefault();

            // Get form data
            const formData = {
                name: document.getElementById("name").value,
                phone: document.getElementById("phone").value,
                location: document.getElementById("location").value,
                message: document.getElementById("message").value
            };

            // Here you would typically send the data to your server
            console.log("Form submitted:", formData);

            // Show confirmation message
            this.style.display = "none";
            document.getElementById("confirmationMessage").style.display = "block";

            // Reset form
            this.reset();
        });

        // Contact popup functions
        function openPopup() {
            document.getElementById("contactPopup").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("contactPopup").style.display = "none";
        }
    </script>

    <div id="overlay"></div>


</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>