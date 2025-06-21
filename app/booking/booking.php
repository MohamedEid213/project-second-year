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

// متغيرات للرسائل
$success_message = '';
$error_message = '';
$show_success = false;

// معالجة إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // استلام البيانات
    $fullName = trim($_POST['fullName'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $date = trim($_POST['date'] ?? '');
    $deliveryOption = trim($_POST['deliveryOption'] ?? '');
    $deliveryAddress = trim($_POST['deliveryAddress'] ?? '');

    // التحقق من صحة البيانات
    $isValid = true;
    $errors = [];

    // التحقق من الاسم
    if (empty($fullName) || !preg_match('/^[\p{L}\s]+$/u', $fullName)) {
        $isValid = false;
        $errors['fullName'] = 'يرجى إدخال الاسم الكامل باستخدام الحروف فقط';
    }

    // التحقق من البريد الإلكتروني
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $isValid = false;
        $errors['email'] = 'يرجى إدخال بريد إلكتروني صحيح';
    }

    // التحقق من رقم الهاتف
    if (empty($phone) || !preg_match('/^\d{11,}$/', $phone)) {
        $isValid = false;
        $errors['phone'] = 'يرجى إدخال رقم هاتف صحيح (11 رقم على الأقل)';
    }

    // التحقق من التاريخ
    if (empty($date)) {
        $isValid = false;
        $errors['date'] = 'يرجى اختيار التاريخ';
    }

    // التحقق من عنوان التوصيل إذا كان خيار التوصيل مختار
    if ($deliveryOption === 'delivery' && empty($deliveryAddress)) {
        $isValid = false;
        $errors['deliveryAddress'] = 'يرجى إدخال عنوان التوصيل';
    }

    // إذا كانت البيانات صحيحة، حفظها في قاعدة البيانات
    if ($isValid) {
        try {
            // إعداد الاستعلام
            $sql = "INSERT INTO bookings (user_id, full_name, email, phone, booking_date, delivery_option, delivery_address, created_at) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("issssss", $user_id, $fullName, $email, $phone, $date, $deliveryOption, $deliveryAddress);

            if ($stmt->execute()) {
                $show_success = true;
                $success_message = 'تم الحجز بنجاح!';

                // إعادة تعيين النموذج
                $fullName = $email = $phone = $date = $deliveryAddress = '';
                $deliveryOption = 'pickup';
            } else {
                $error_message = 'حدث خطأ أثناء حفظ البيانات';
            }

            $stmt->close();
        } catch (Exception $e) {
            $error_message = 'حدث خطأ في النظام';
        }
    }
}
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

            <?php if ($show_success): ?>
                <!-- رسالة النجاح -->
                <div class="alert alert-success text-center" role="alert">
                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                    <h4>تم الحجز بنجاح!</h4>
                    <p>شكراً لك، تم إرسال طلب الحجز بنجاح</p>
                    <p>سيتم التواصل معك قريباً لتأكيد الموعد</p>
                </div>
            <?php endif; ?>

            <?php if (!empty($error_message)): ?>
                <!-- رسالة الخطأ -->
                <div class="alert alert-danger" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-user"></i>Full Name</label>
                    <input type="text" name="fullName" class="form-control <?php echo isset($errors['fullName']) ? 'is-invalid' : ''; ?>"
                        placeholder="enter name..." value="<?php echo htmlspecialchars($fullName ?? ''); ?>" required>
                    <?php if (isset($errors['fullName'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['fullName']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-envelope"></i>Email</label>
                    <input type="email" name="email" class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>"
                        placeholder="enter email..." value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    <?php if (isset($errors['email'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-phone"></i>Phone Number</label>
                    <input type="tel" name="phone" class="form-control <?php echo isset($errors['phone']) ? 'is-invalid' : ''; ?>"
                        placeholder="enter phone number..." value="<?php echo htmlspecialchars($phone ?? ''); ?>" required>
                    <?php if (isset($errors['phone'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['phone']; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-calendar"></i> Date</label>
                    <input type="date" name="date" class="form-control <?php echo isset($errors['date']) ? 'is-invalid' : ''; ?>"
                        value="<?php echo htmlspecialchars($date ?? ''); ?>" required>
                    <?php if (isset($errors['date'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['date']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label"><i class="fa fa-truck"></i> Receipt method</label>
                    <select name="deliveryOption" class="form-select" onchange="toggleAddressField(this.value)">
                        <option value="pickup" <?php echo ($deliveryOption ?? 'pickup') === 'pickup' ? 'selected' : ''; ?>>Pick up from the center</option>
                        <option value="delivery" <?php echo ($deliveryOption ?? '') === 'delivery' ? 'selected' : ''; ?>>delivery</option>
                    </select>
                </div>

                <div class="mb-3" id="addressBox" style="display: <?php echo ($deliveryOption ?? 'pickup') === 'delivery' ? 'block' : 'none'; ?>;">
                    <label class="form-label"><i class="fa fa-map-marker-alt"></i>Delivery address</label>
                    <input type="text" name="deliveryAddress" class="form-control <?php echo isset($errors['deliveryAddress']) ? 'is-invalid' : ''; ?>"
                        placeholder="Enter delivery address" value="<?php echo htmlspecialchars($deliveryAddress ?? ''); ?>">
                    <?php if (isset($errors['deliveryAddress'])): ?>
                        <div class="invalid-feedback"><?php echo $errors['deliveryAddress']; ?></div>
                    <?php endif; ?>
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

        <!-- رسالة النجاح مع الشعار -->
        <div id="successMessage" class="success-message" style="display: none;">
            <div class="success-content">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>تم الحجز بنجاح!</h3>
                <p>شكراً لك، تم إرسال طلب الحجز بنجاح</p>
                <p>سيتم التواصل معك قريباً لتأكيد الموعد</p>
            </div>
        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <script>
        // التحكم في ظهور حقل العنوان
        function toggleAddressField(value) {
            const addressBox = document.getElementById('addressBox');
            if (value === 'delivery') {
                addressBox.style.display = 'block';
            } else {
                addressBox.style.display = 'none';
            }
        }
    </script>
    <div id="overlay"></div>


</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>