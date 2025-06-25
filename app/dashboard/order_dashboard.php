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
    <title>Orders Dashboard</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/style_order_dashboard.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="orders_page_layout">
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <main>
            <!-- Top Bar -->
            <div class="main-top-bar">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo htmlspecialchars($username); ?></b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="User Avatar">
                    </div>
                </div>
            </div>
            <div>

                <h1 class="title_order">Orders Management</h1>
                <p class="p_order" >The Orders page displays all orders within the system, with the ability to easily track, filter, and effectively manage each order status.</p>
            </div>
            <!-- Order Summary Cards -->
            <div class="order-summary-cards">
                <div class="summary-card">
                    <div class="icon total-orders"><i class="fas fa-shopping-cart"></i></div>
                    <div class="info">
                        <h3>1,020</h3>
                        <p>Total Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon pending-orders"><i class="fas fa-hourglass-half"></i></div>
                    <div class="info">
                        <h3>80</h3>
                        <p>Pending Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon completed-orders"><i class="fas fa-check-circle"></i></div>
                    <div class="info">
                        <h3>940</h3>
                        <p>Completed Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon total-revenue"><i class="fas fa-dollar-sign"></i></div>
                    <div class="info">
                        <h3>$62,500</h3>
                        <p>Total Revenue</p>
                    </div>
                </div>
            </div>

            <!-- Orders List Section -->
            <div class="orders-list-section">
                <div class="orders-filters">
                    <h2>Recent Orders</h2>
                    <div class="filter-group">
                        <input type="date" name="start_date">
                        <select name="status">
                            <option value="all">All Status</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
                <table class="orders-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#85631</td>
                            <td>John Smith</td>
                            <td>01-10-2024</td>
                            <td>$128.50</td>
                            <td><span class="status status-completed">Completed</span></td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>#96378</td>
                            <td>Sarah Johnson</td>
                            <td>01-10-2024</td>
                            <td>$75.00</td>
                            <td><span class="status status-pending">Pending</span></td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>#49347</td>
                            <td>Michael Brown</td>
                            <td>30-09-2024</td>
                            <td>$210.20</td>
                            <td><span class="status status-completed">Completed</span></td>
                            <td><a href="#">View</a></td>
                        </tr>
                        <tr>
                            <td>#96996</td>
                            <td>Emily Davis</td>
                            <td>29-09-2024</td>
                            <td>$55.75</td>
                            <td><span class="status status-cancelled">Cancelled</span></td>
                            <td><a href="#">View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>