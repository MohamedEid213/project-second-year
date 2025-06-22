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
    <title>Clients Management</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/style_client_dashboard.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=grid_view" />
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/webfonts">
</head>

<body id="clients_page_layout"> <!-- Unique ID to prevent CSS conflicts -->
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <main>
            <!-- Top Bar inside Main Content -->
            <div class="main-top-bar">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo htmlspecialchars($username); ?></b></p>
                        <small class="text-muted">User</small>
                    </div>
                    <div class="profile-photo">
                        <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="User Avatar">
                    </div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="clients-page-header">
                <h1>Clients</h1>
                <p>Manage your client relationships and track business performance</p>
            </div>

            <!-- Action Bar -->
            <div class="clients-actions">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search clients...">
                </div>
                <div class="action-buttons">
                    <select name="status" id="status-filter">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <button class="add-client-btn">
                        <i class="fas fa-plus"></i>
                        Add Client
                    </button>
                </div>
            </div>

            <!-- Clients List Table -->
            <div class="clients-list-container">

                <table class="clients-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row 1 -->
                        <tr>
                            <td>John Smith</td>
                            <td>john.smith@example.com</td>
                            <td>+1 (555) 123-4567</td>
                            <td><span class="status status-active">Active</span></td>
                            <td class="action-icons">
                                <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Example Row 2 -->
                        <tr>
                            <td>Sarah Johnson</td>
                            <td>sarah.johnson@techcorp.com</td>
                            <td>+1 (555) 987-6543</td>
                            <td><span class="status status-active">Active</span></td>
                            <td class="action-icons">
                                <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Example Row 3 -->
                        <tr>
                            <td>David Wilson</td>
                            <td>david@freelance.com</td>
                            <td>+1 (555) 654-3210</td>
                            <td><span class="status status-inactive">Inactive</span></td>
                            <td class="action-icons">
                                <a href="#" title="Edit"><i class="fas fa-pen"></i></a>
                                <a href="#" title="Delete" class="delete"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>