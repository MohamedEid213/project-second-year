<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: /project_2/index.php');
    exit();
}

$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Dashboard</title>
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_dash_dashboard.css">
    <!-- يمكن إضافة ملف CSS مخصص للخدمات لاحقاً إذا لزم -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body id="service_dashboard_page">
    <div class="service-dashboard-bg">
        <div class="service-dashboard-container">
            <div class="container">
                <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
                <main>
                    <!-- Profile Bar هنا -->
                    <div class="service-profile-bar">
                        <div class="service-profile-info">
                            <div class="service-profile-text">
                                <p>Hey, <b><?php echo htmlspecialchars($username); ?></b></p>
                                <small class="service-profile-role">User</small>
                            </div>
                            <div class="service-profile-photo">
                                <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="User Avatar">
                            </div>
                        </div>
                    </div>

                    <!-- Dashboard Header -->
                    <div class="dashboard-header center-header">
                        <h1>Services Dashboard</h1>
                        <p class="dashboard-desc">Manage appointments, view statistics, and handle services efficiently.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="data-info">
                        <div class="box">
                            <i class="fas fa-user"></i>
                            <div class="data">
                                <p>Customers</p>
                                <span>150</span>
                            </div>
                        </div>
                        <div class="box">
                            <i class="fas fa-calendar-alt"></i>
                            <div class="data">
                                <p>Appointments</p>
                                <span>85</span>
                            </div>
                        </div>
                        <div class="box">
                            <i class="fas fa-tools"></i>
                            <div class="data">
                                <p>Services Offered</p>
                                <span>12</span>
                            </div>
                        </div>
                        <div class="box">
                            <i class="fas fa-dollar-sign"></i>
                            <div class="data">
                                <p>Total Revenue</p>
                                <span>$4,600</span>
                            </div>
                        </div>
                    </div>

                    <!-- Appointments Table -->
                    <div class="products-section">
                        <div class="products-header">
                            <div class="title-info">
                                <p>Service Appointments</p>
                                <i class="fas fa-table"></i>
                            </div>
                            <button class="add-product-btn"><i class="fas fa-plus"></i> Add Appointment</button>
                        </div>
                        <table class="product-list-table">
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Booking ID</th>
                                    <th>Payment Status</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oil Change</td>
                                    <td>10234</td>
                                    <td>Due</td>
                                    <td><span class="status status-pending">Pending</span></td>
                                    <td class="action-icons">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                                        <a href="#" title="Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Brake Inspection</td>
                                    <td>10289</td>
                                    <td>Paid</td>
                                    <td><span class="status status-completed">Completed</span></td>
                                    <td class="action-icons">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                                        <a href="#" title="Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Tire Rotation</td>
                                    <td>10345</td>
                                    <td>Refunded</td>
                                    <td><span class="status status-cancelled">Cancelled</span></td>
                                    <td class="action-icons">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                                        <a href="#" title="Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Engine Diagnostic</td>
                                    <td>10478</td>
                                    <td>Due</td>
                                    <td><span class="status status-pending">Pending</span></td>
                                    <td class="action-icons">
                                        <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                        <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                                        <a href="#" title="Details"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    </div>
    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>