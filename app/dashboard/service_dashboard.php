<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: /project_2/index.php');
    exit();
}
if ($_SESSION['user_permissions'] != 'admin') {

    header('location: /project_2/Home.php');
    exit();
}

$username = $_SESSION['username'];

// جلب كل الخدمات
$services = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
$services = mysqli_fetch_all($services, MYSQLI_ASSOC);

// إحصائيات
$total_services = count($services);
$active_services = 0;
foreach ($services as $srv) {
    if ($srv['status'] == 'active') $active_services++;
}
$inactive_services = $total_services - $active_services;
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
                                <p>Hey, <span><?php echo htmlspecialchars($username); ?></span></p>
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
                    <section class="stats">
                        <div class="stat-box"><span>👤</span>
                            <h3>150</h3>
                            <p>Customers</p>
                        </div>
                        <div class="stat-box"><span>📅</span>
                            <h3>85</h3>
                            <p>Appointments</p>
                        </div>
                        <div class="stat-box"><span>🛠️</span>
                            <h3>12</h3>
                            <p>Services Offered</p>
                        </div>
                        <div class="stat-box"><span>💵</span>
                            <h3>$4,600</h3>
                            <p>Total Revenue</p>
                        </div>
                    </section>

                    <!-- Appointments Table -->

                    <section class="table-section">
                        <div class="table-header">
                            <h2>Service Appointments</h2>
                            <button class="add-btn">+ Add Appointment</button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Service Type</th>
                                    <th>Booking ID</th>
                                    <th>Payment Status</th>
                                    <th>Job Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Oil Change</td>
                                    <td>10234</td>
                                    <td>Due</td>
                                    <td><span class="status pending">Pending</span></td>
                                    <td><button class="edit">✏️</button><button class="delete">🗑️</button><button class="details">Details</button></td>
                                </tr>
                                <tr>
                                    <td>Brake Inspection</td>
                                    <td>10289</td>
                                    <td>Paid</td>
                                    <td><span class="status delivered">Completed</span></td>
                                    <td><button class="edit">✏️</button><button class="delete">🗑️</button><button class="details">Details</button></td>
                                </tr>
                                <tr>
                                    <td>Tire Rotation</td>
                                    <td>10345</td>
                                    <td>Refunded</td>
                                    <td><span class="status declined">Canceled</span></td>
                                    <td><button class="edit">✏️</button><button class="delete">🗑️</button><button class="details">Details</button></td>
                                </tr>
                                <tr>
                                    <td>Engine Diagnostic</td>
                                    <td>10478</td>
                                    <td>Due</td>
                                    <td><span class="status pending">Pending</span></td>
                                    <td><button class="edit">✏️</button><button class="delete">🗑️</button><button class="details">Details</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </section>
                </main>
            </div>
        </div>
    </div>
    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>