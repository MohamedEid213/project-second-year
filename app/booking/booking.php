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
    <title>Booking</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_booking.css">

</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <!-- محتوى الصفحة -->
        <div class="booking-form" id="bookingFormContainer">
            <h2 class="text-center">Book your service now</h2>
            <form id="bookingForm">
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-user"></i>Full Name</label>
                    <input type="text" id="fullName" class="form-control" placeholder="enter name..." required>
                    <div class="invalid-feedback">Please enter your full name using letters only.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-envelope"></i>Email</label>
                    <input type="email" id="email" class="form-control" placeholder="enter email..." required>
                    <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-phone"></i>Phone Number</label>
                    <input type="tel" id="phone" class="form-control" placeholder="enter phone number..." required>
                    <div class="invalid-feedback">Please enter a phone number of at least 11 digits.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-calendar"></i> Date</label>
                    <input type="date" id="date" class="form-control" required>
                    <div class="invalid-feedback">Please select a date.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-truck"></i> Receipt method</label>
                    <select id="deliveryOption" class="form-select">
                        <option value="pickup">Pick up from the center</option>
                        <option value="delivery">delivery</option>
                    </select>
                </div>

                <div class="mb-3" id="addressBox" style="display: none;">
                    <label class="form-label"><i class="fa fa-map-marker-alt"></i>Delivery address</label>
                    <input type="text" id="deliveryAddress" class="form-control" placeholder="Enter delivery address">
                    <div class=" invalid-feedback">Please enter your delivery address.
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Confirm your reservation</button>
            </form>
        </div>


        <div id="loading" class="text-center" style="display: none;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-3">You are being redirected to the payment page...</p>
        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <script src="/project_2/assets/js/booking.js"></script>

</body>

</html>