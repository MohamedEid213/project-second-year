<?php
// ملف إنشاء جدول الحجوزات
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: /project_2/index.php');
    exit();
}

// التحقق من وجود جدول الحجوزات
$check_table = "SHOW TABLES LIKE 'bookings'";
$table_exists = mysqli_query($conn, $check_table);

if (mysqli_num_rows($table_exists) == 0) {
    // إنشاء جدول الحجوزات
    $create_table = "CREATE TABLE `bookings` (
        `booking_id` int(11) NOT NULL AUTO_INCREMENT,
        `user_id` int(11) NOT NULL,
        `service_id` int(11) DEFAULT NULL,
        `full_name` varchar(255) NOT NULL,
        `email` varchar(255) NOT NULL,
        `phone` varchar(20) NOT NULL,
        `booking_date` date NOT NULL,
        `car_type` varchar(100) DEFAULT NULL,
        `delivery_address` text DEFAULT NULL,
        `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
        `notes` text DEFAULT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
        `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
        PRIMARY KEY (`booking_id`),
        KEY `user_id` (`user_id`),
        KEY `service_id` (`service_id`),
        KEY `status` (`status`),
        KEY `booking_date` (`booking_date`),
        CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
        CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    if (mysqli_query($conn, $create_table)) {
        echo "تم إنشاء جدول الحجوزات بنجاح!<br>";

        // إنشاء View لعرض الحجوزات مع تفاصيل المستخدم والخدمة
        $create_view = "CREATE VIEW `bookings_details` AS
        SELECT 
            b.booking_id,
            b.full_name,
            b.email,
            b.phone,
            b.booking_date,
            b.car_type,
            b.delivery_address,
            b.status,
            b.notes,
            b.created_at,
            u.username,
            s.s_name as service_name,
            s.s_description as service_description
        FROM bookings b
        LEFT JOIN users u ON b.user_id = u.user_id
        LEFT JOIN services s ON b.service_id = s.service_id
        ORDER BY b.created_at DESC";

        if (mysqli_query($conn, $create_view)) {
            echo "تم إنشاء View التفاصيل بنجاح!<br>";
        } else {
            echo "خطأ في إنشاء View: " . mysqli_error($conn) . "<br>";
        }

        // إنشاء Stored Procedure لحساب إحصائيات الحجوزات
        $create_procedure = "DELIMITER //
        CREATE PROCEDURE GetBookingStats()
        BEGIN
            SELECT 
                COUNT(*) as total_bookings,
                COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending_bookings,
                COUNT(CASE WHEN status = 'confirmed' THEN 1 END) as confirmed_bookings,
                COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed_bookings,
                COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as cancelled_bookings
            FROM bookings;
        END //
        DELIMITER ;";

        if (mysqli_query($conn, $create_procedure)) {
            echo "تم إنشاء Stored Procedure بنجاح!<br>";
        } else {
            echo "خطأ في إنشاء Stored Procedure: " . mysqli_error($conn) . "<br>";
        }

        // إنشاء Trigger لتحديث تاريخ التعديل
        $create_trigger = "DELIMITER //
        CREATE TRIGGER update_booking_timestamp 
        BEFORE UPDATE ON bookings
        FOR EACH ROW
        BEGIN
            SET NEW.updated_at = CURRENT_TIMESTAMP;
        END //
        DELIMITER ;";

        if (mysqli_query($conn, $create_trigger)) {
            echo "تم إنشاء Trigger بنجاح!<br>";
        } else {
            echo "خطأ في إنشاء Trigger: " . mysqli_error($conn) . "<br>";
        }

        // إنشاء Indexes لتحسين الأداء
        $indexes = [
            "CREATE INDEX idx_booking_date ON bookings(booking_date)",
            "CREATE INDEX idx_booking_status ON bookings(status)",
            "CREATE INDEX idx_user_date ON bookings(user_id, booking_date)",
            "CREATE INDEX idx_service_id ON bookings(service_id)"
        ];

        foreach ($indexes as $index) {
            if (mysqli_query($conn, $index)) {
                echo "تم إنشاء Index بنجاح!<br>";
            } else {
                echo "خطأ في إنشاء Index: " . mysqli_error($conn) . "<br>";
            }
        }

        // إضافة بيانات تجريبية
        $sample_data = "INSERT INTO `bookings` (`user_id`, `service_id`, `full_name`, `email`, `phone`, `booking_date`, `car_type`, `delivery_address`, `status`, `notes`) VALUES
        (17, 1, 'أحمد محمد علي', 'ahmed@example.com', '01234567890', '2025-01-15', 'Toyota', NULL, 'confirmed', 'مطلوب فحص شامل للمحرك'),
        (17, 2, 'فاطمة أحمد', 'fatima@example.com', '01234567891', '2025-01-16', 'Honda', 'شارع النصر، القاهرة', 'pending', 'تغيير زيت وفلتر'),
        (19, 3, 'محمد عبدالله', 'mohamed@example.com', '01234567892', '2025-01-17', 'BMW', NULL, 'pending', 'فحص نظام الفرامل'),
        (19, 1, 'سارة محمود', 'sara@example.com', '01234567893', '2025-01-18', 'Mercedes', 'شارع التحرير، الإسكندرية', 'confirmed', 'صيانة دورية'),
        (17, 4, 'علي حسن', 'ali@example.com', '01234567894', '2025-01-19', 'Audi', NULL, 'pending', 'إصلاح نظام التكييف')";

        if (mysqli_query($conn, $sample_data)) {
            echo "تم إضافة البيانات التجريبية بنجاح!<br>";
        } else {
            echo "خطأ في إضافة البيانات التجريبية: " . mysqli_error($conn) . "<br>";
        }

        echo "<br><strong>تم إنشاء جدول الحجوزات بالكامل!</strong><br>";
        echo "<a href='/project_2/app/dateils_services/dateils_service.php?id=" . base64_encode(1) . "'>العودة لصفحة الخدمات</a>";
    } else {
        echo "خطأ في إنشاء جدول الحجوزات: " . mysqli_error($conn);
    }
} else {
    echo "جدول الحجوزات موجود بالفعل!<br>";
    echo "<a href='/project_2/app/dateils_services/dateils_service.php?id=" . base64_encode(1) . "'>العودة لصفحة الخدمات</a>";
}

mysqli_close($conn);
