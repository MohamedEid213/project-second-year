<?php
// إزالة session_start() و include config.php لأنها ستكون موجودة في الصفحة الرئيسية
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
$service_id = base64_decode($_GET['id']);

// جلب البيانات
$count_cart = "SELECT COUNT(*) as cart_count FROM `basket` WHERE Client_id = $user_id";
$result = mysqli_query($conn, $count_cart);
$row = mysqli_fetch_assoc($result);
$cart_items_count = $row['cart_count'];

$Sql = "SELECT * FROM `services` WHERE `service_id` = '$service_id'";
$service_data = mysqli_query($conn, $Sql);

$Sql_Services = "SELECT * FROM `services`";
$result_Services = mysqli_query($conn, $Sql_Services);

$Select_brand = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_brand);

// معالجة النموذج مباشرة هنا
$booking_success = '';
$booking_errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fullName'])) {
    // جلب البيانات من النموذج
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $carType = mysqli_real_escape_string($conn, $_POST['carType']);
    $service_id = mysqli_real_escape_string($conn, $_POST['service_id']);
    $deliveryAddress = isset($_POST['deliveryAddress']) ? mysqli_real_escape_string($conn, $_POST['deliveryAddress']) : '';

    // التحقق من صحة البيانات
    if (empty($fullName)) $booking_errors[] = 'Full name is required';
    if (empty($email)) $booking_errors[] = 'Email is required';
    if (empty($phone)) $booking_errors[] = 'Phone number is required';
    if (empty($date)) $booking_errors[] = 'Date is required';
    if (empty($carType)) $booking_errors[] = 'Car type is required';
    if (empty($service_id)) $booking_errors[] = 'Service is required';

    // التحقق من صحة البريد الإلكتروني
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $booking_errors[] = 'Please enter a valid email address';
    }

    // التحقق من صحة رقم الهاتف
    if (!empty($phone) && strlen($phone) < 11) {
        $booking_errors[] = 'Please enter a valid phone number (at least 11 digits)';
    }

    // التحقق من أن التاريخ ليس في الماضي
    if (!empty($date)) {
        $booking_date = new DateTime($date);
        $today = new DateTime();
        if ($booking_date < $today) {
            $booking_errors[] = 'Please select a future date';
        }
    }

    // إذا لم تكن هناك أخطاء، إدراج البيانات
    if (empty($booking_errors)) {
  
            $insert_query = "INSERT INTO bookings (user_id, service_id, full_name, email, phone, booking_date, car_type, delivery_address, status, created_at) 
            VALUES ('$user_id', '$service_id', '$fullName', '$email', '$phone', '$date', '$carType', '$deliveryAddress', 'pending', NOW())";

           
          
            if ( mysqli_query($conn, $insert_query)) {
                $booking_success = 'Booking request sent successfully! We will contact you soon.';
          
            } else {
                $booking_errors[] = 'An error occurred while sending the request. Please try again.';
        } 
    }
}
