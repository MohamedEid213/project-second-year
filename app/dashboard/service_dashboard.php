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

// جلب جميع الخدمات
$services = mysqli_query($conn, "SELECT * FROM services");
$services = mysqli_fetch_all($services, MYSQLI_ASSOC);

// إحصائيات
$total_services = count($services);
$active_services = 0;
$inactive_services = 0;
$latest_service_date = null;

foreach ($services as $srv) {
    $status = strtolower(trim($srv['status']));
    if ($status == 'actitive') $active_services++;
    if ($status == 'inactive') $inactive_services++;
    if (!$latest_service_date || strtotime($srv['create_at']) > strtotime($latest_service_date)) {
        $latest_service_date = $srv['create_at'];
    }
}



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

                                <p class="service-profile-role"><?= ucfirst($_SESSION['user_permissions']) ?></p>

                            </div>
                            <div class="service-profile-photo">
                                <img src="/project_2/assets/image/image_users/photo_private.png" alt="User Avatar">
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
                        <div class="stat-box">
                            <span class="stat-icon stat-icon-blue"><i class="fas fa-cogs"></i></span>
                            <h3><?= $total_services ?></h3>
                            <p>Total Services</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></span>
                            <h3><?= $active_services ?></h3>
                            <p>Active Services</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon stat-icon-red"><i class="fas fa-times-circle"></i></span>
                            <h3><?= $inactive_services ?></h3>
                            <p>Inactive Services</p>
                        </div>
                        <div class="stat-box">
                            <span class="stat-icon stat-icon-orange"><i class="fas fa-clock"></i></span>
                            <h3><?= $latest_service_date ? date('Y-m-d', strtotime($latest_service_date)) : '--' ?></h3>
                            <p>Last Added</p>
                        </div>
                    </section>

                    <!-- Appointments Table -->

                    <section class="table-section">
                        <div class="table-header">
                            <h2>Services List</h2>
                            <a href="#" class="add-btn">+ Add Service</a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Video</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($services as $service): ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($service['s_name']) ?></td>
                                        <td><?= htmlspecialchars($service['s_description']) ?></td>
                                        <td>
                                            <?php if ($service['status'] == 'actitive'): ?>
                                                <span class="status delivered">Active</span>
                                            <?php else: ?>
                                                <span class="status declined">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($service['image']): ?>
                                                <img src="/project_2/assets/image/image_serivce/<?= htmlspecialchars($service['image']) ?>" alt="Service Image" style="width:40px;height:40px;">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($service['video']): ?>
                                                <a href="/project_2/app/dateils_services/Videos/<?= htmlspecialchars($service['video']) ?>" target="_blank">View</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($service['create_at']) ?></td>
                                        <td>
                                            <a href="service_dashboard/edit.php?id=<?= $service['service_id'] ?>" class="table-action edit" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="service_dashboard/delete.php?id=<?= $service['service_id'] ?>" class="table-action delete" title="Delete" onclick="return confirm('Are you sure?');">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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