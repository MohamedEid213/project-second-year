-- =====================================================
-- إضافة جدول الحجوزات إلى قاعدة البيانات
-- =====================================================

-- استخدام قاعدة البيانات
USE `repair-center`;

-- =====================================================
-- إنشاء جدول الحجوزات
-- =====================================================

CREATE TABLE `bookings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- إضافة بيانات تجريبية للحجوزات
-- =====================================================

-- التحقق من وجود المستخدمين والخدمات قبل الإدراج
INSERT INTO `bookings` (`user_id`, `service_id`, `full_name`, `email`, `phone`, `booking_date`, `car_type`, `delivery_address`, `status`, `notes`) VALUES
(17, 1, 'أحمد محمد علي', 'ahmed@example.com', '01234567890', '2025-01-15', 'Toyota', NULL, 'confirmed', 'مطلوب فحص شامل للمحرك'),
(17, 2, 'فاطمة أحمد', 'fatima@example.com', '01234567891', '2025-01-16', 'Honda', 'شارع النصر، القاهرة', 'pending', 'تغيير زيت وفلتر'),
(19, 3, 'محمد عبدالله', 'mohamed@example.com', '01234567892', '2025-01-17', 'BMW', NULL, 'pending', 'فحص نظام الفرامل'),
(19, 1, 'سارة محمود', 'sara@example.com', '01234567893', '2025-01-18', 'Mercedes', 'شارع التحرير، الإسكندرية', 'confirmed', 'صيانة دورية'),
(17, 4, 'علي حسن', 'ali@example.com', '01234567894', '2025-01-19', 'Audi', NULL, 'pending', 'إصلاح نظام التكييف');

-- =====================================================
-- إنشاء View لعرض الحجوزات مع تفاصيل المستخدم والخدمة
-- =====================================================

CREATE VIEW `bookings_details` AS
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
ORDER BY b.created_at DESC;

-- =====================================================
-- إنشاء Stored Procedure لحساب إحصائيات الحجوزات
-- =====================================================

DELIMITER //
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
DELIMITER ;

-- =====================================================
-- إنشاء Trigger لتحديث تاريخ التعديل
-- =====================================================

DELIMITER //
CREATE TRIGGER update_booking_timestamp 
BEFORE UPDATE ON bookings
FOR EACH ROW
BEGIN
    SET NEW.updated_at = CURRENT_TIMESTAMP;
END //
DELIMITER ;

-- =====================================================
-- إنشاء Function لحساب عدد الحجوزات للمستخدم
-- =====================================================

DELIMITER //
CREATE FUNCTION GetUserBookingCount(user_id_param INT) 
RETURNS INT
READS SQL DATA
DETERMINISTIC
BEGIN
    DECLARE booking_count INT;
    
    SELECT COUNT(*) INTO booking_count
    FROM bookings 
    WHERE user_id = user_id_param;
    
    RETURN booking_count;
END //
DELIMITER ;

-- =====================================================
-- إنشاء Indexes إضافية لتحسين الأداء
-- =====================================================

-- Index للبحث حسب التاريخ
CREATE INDEX idx_booking_date ON bookings(booking_date);

-- Index للبحث حسب الحالة
CREATE INDEX idx_booking_status ON bookings(status);

-- Index للبحث حسب المستخدم والتاريخ
CREATE INDEX idx_user_date ON bookings(user_id, booking_date);

-- Index للبحث حسب الخدمة
CREATE INDEX idx_service_id ON bookings(service_id);

-- =====================================================
-- أوامر للتحقق من نجاح الإضافة
-- =====================================================

-- التحقق من إنشاء الجدول
SHOW TABLES LIKE 'bookings';

-- عرض هيكل الجدول
DESCRIBE bookings;

-- عرض البيانات المدرجة
SELECT * FROM bookings;

-- عرض View التفاصيل
SELECT * FROM bookings_details;

-- اختبار Stored Procedure
CALL GetBookingStats();

-- اختبار Function
SELECT GetUserBookingCount(17) as user_bookings;

-- =====================================================
-- أوامر مفيدة للاستعلام
-- =====================================================

-- عرض جميع الحجوزات مرتبة حسب التاريخ
-- SELECT * FROM bookings ORDER BY created_at DESC;

-- عرض الحجوزات المعلقة
-- SELECT * FROM bookings WHERE status = 'pending' ORDER BY booking_date;

-- عرض حجوزات مستخدم معين
-- SELECT * FROM bookings WHERE user_id = 17 ORDER BY created_at DESC;

-- عرض الحجوزات المؤكدة
-- SELECT * FROM bookings WHERE status = 'confirmed';

-- عرض إحصائيات الحجوزات
-- CALL GetBookingStats();

-- عرض عدد حجوزات مستخدم معين
-- SELECT GetUserBookingCount(17) as user_bookings;

-- عرض تفاصيل الحجوزات مع معلومات المستخدم والخدمة
-- SELECT * FROM bookings_details;

-- =====================================================
-- رسالة نجاح
-- =====================================================

SELECT 'تم إنشاء جدول الحجوزات بنجاح!' as message; 