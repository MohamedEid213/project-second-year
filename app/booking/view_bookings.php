<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: /project_2/index.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

// جلب حجوزات المستخدم
$sql = "SELECT b.*, s.s_name as service_name, s.s_description as service_description 
        FROM bookings b 
        LEFT JOIN services s ON b.service_id = s.service_id 
        WHERE b.user_id = ? 
        ORDER BY b.created_at DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// حساب إحصائيات الحجوزات
$stats_sql = "SELECT 
    COUNT(*) as total_bookings,
    COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending_bookings,
    COUNT(CASE WHEN status = 'confirmed' THEN 1 END) as confirmed_bookings,
    COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed_bookings,
    COUNT(CASE WHEN status = 'cancelled' THEN 1 END) as cancelled_bookings
FROM bookings WHERE user_id = ?";

$stats_stmt = $conn->prepare($stats_sql);
$stats_stmt->bind_param("i", $user_id);
$stats_stmt->execute();
$stats_result = $stats_stmt->get_result();
$stats = $stats_result->fetch_assoc();
$stats_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Bookings</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_booking.css">
    <style>
        .booking-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #007bff;
        }

        .booking-card.pending {
            border-left-color: #ffc107;
        }

        .booking-card.confirmed {
            border-left-color: #28a745;
        }

        .booking-card.completed {
            border-left-color: #17a2b8;
        }

        .booking-card.cancelled {
            border-left-color: #dc3545;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }

        .status-completed {
            background: #d1ecf1;
            color: #0c5460;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: bold;
        }

        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mb-4">My Bookings</h1>

                <!-- إحصائيات الحجوزات -->
                <div class="stats-card">
                    <h3 class="text-center mb-3">Booking Statistics</h3>
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number"><?= $stats['total_bookings'] ?></div>
                            <div class="stat-label">Total Bookings</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?= $stats['pending_bookings'] ?></div>
                            <div class="stat-label">Pending</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?= $stats['confirmed_bookings'] ?></div>
                            <div class="stat-label">Confirmed</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number"><?= $stats['completed_bookings'] ?></div>
                            <div class="stat-label">Completed</div>
                        </div>
                    </div>
                </div>

                <?php if (empty($bookings)): ?>
                    <div class="text-center">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h3>No Bookings Found</h3>
                        <p class="text-muted">You haven't made any bookings yet.</p>
                        <a href="/project_2/app/servicess/services.php" class="btn btn-primary">Book a Service</a>
                    </div>
                <?php else: ?>
                    <!-- قائمة الحجوزات -->
                    <?php foreach ($bookings as $booking): ?>
                        <div class="booking-card <?= $booking['status'] ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5><?= htmlspecialchars($booking['service_name'] ?? 'Service') ?></h5>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-calendar"></i>
                                        <?= date('F j, Y', strtotime($booking['booking_date'])) ?>
                                    </p>
                                    <p class="mb-2">
                                        <strong>Name:</strong> <?= htmlspecialchars($booking['full_name']) ?><br>
                                        <strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?><br>
                                        <strong>Car Type:</strong> <?= htmlspecialchars($booking['car_type']) ?>
                                    </p>
                                    <?php if (!empty($booking['delivery_address'])): ?>
                                        <p class="mb-2">
                                            <strong>Delivery Address:</strong> <?= htmlspecialchars($booking['delivery_address']) ?>
                                        </p>
                                    <?php endif; ?>
                                    <?php if (!empty($booking['notes'])): ?>
                                        <p class="mb-2">
                                            <strong>Notes:</strong> <?= htmlspecialchars($booking['notes']) ?>
                                        </p>
                                    <?php endif; ?>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i>
                                        Booked on <?= date('M j, Y g:i A', strtotime($booking['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <span class="status-badge status-<?= $booking['status'] ?>">
                                        <?= ucfirst($booking['status']) ?>
                                    </span>
                                    <div class="mt-3">
                                        <a href="/project_2/app/dateils_services/dateils_service.php?id=<?= base64_encode($booking['service_id']) ?>"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i> View Service
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>

    <div id="overlay"></div>
</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>