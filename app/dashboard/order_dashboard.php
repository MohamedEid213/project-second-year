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

// جلب جميع الطلبات
$orders = [];
$query = "SELECT o.*, u.name AS client_name, s.store_name
          FROM orders o
          LEFT JOIN users u ON o.client_id = u.id
          LEFT JOIN stores s ON o.store_id = s.store_id
          ORDER BY o.order_date DESC";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}

// إحصائيات الطلبات
$total_orders = count($orders);
$pending_orders = 0;
$completed_orders = 0;
$total_revenue = 0;

foreach ($orders as $order) {
    $status = strtolower($order['order_status']);
    if ($status == 'pending') $pending_orders++;
    if ($status == 'delivered') $completed_orders++;
    $total_revenue += floatval($order['total_price']);
}
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
                <p class="p_order">The Orders page displays all orders within the system, with the ability to easily track, filter, and effectively manage each order status.</p>
            </div>
            <!-- Order Summary Cards -->
            <div class="order-summary-cards">
                <div class="summary-card">
                    <div class="icon total-orders"><i class="fas fa-shopping-cart"></i></div>
                    <div class="info">
                        <h3><?= $total_orders ?></h3>
                        <p>Total Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon pending-orders"><i class="fas fa-hourglass-half"></i></div>
                    <div class="info">
                        <h3><?= $pending_orders ?></h3>
                        <p>Pending Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon completed-orders"><i class="fas fa-check-circle"></i></div>
                    <div class="info">
                        <h3><?= $completed_orders ?></h3>
                        <p>Completed Orders</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="icon total-revenue"><i class="fas fa-dollar-sign"></i></div>
                    <div class="info">
                        <h3>$<?= number_format($total_revenue, 2) ?></h3>
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
                            <th>Store</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Payment Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($orders) > 0): ?>
                            <?php $i = 1;
                            foreach ($orders as $order): ?>
                                <tr>
                                    <td>#<?= $i++ ?></td>
                                    <td><?= htmlspecialchars($order['client_name'] ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars($order['store_name'] ?? 'Unknown') ?></td>
                                    <td><?= htmlspecialchars($order['order_date']) ?></td>
                                    <td>$<?= number_format($order['total_price'], 2) ?></td>
                                    <td>
                                        <?php
                                        $status = strtolower($order['order_status']);
                                        $statusClass = 'status ';
                                        switch ($status) {
                                            case 'completed':
                                                $statusClass .= 'status-completed';
                                                break;
                                            case 'pending':
                                                $statusClass .= 'status-pending';
                                                break;
                                            case 'cancelled':
                                                $statusClass .= 'status-cancelled';
                                                break;
                                            case 'shipped':
                                                $statusClass .= 'status-shipped';
                                                break;
                                            case 'delivered':
                                                $statusClass .= 'status-delivered';
                                                break;
                                            case 'processing':
                                                $statusClass .= 'status-processing';
                                                break;
                                            default:
                                                $statusClass .= 'status-pending';
                                        }
                                        ?>
                                        <span class="<?= $statusClass ?>">
                                            <?= ucfirst($order['order_status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        $payStatus = strtolower($order['payment_status']);
                                        $payClass = 'status ';
                                        if ($payStatus == 'paid') $payClass .= 'status-completed';
                                        elseif ($payStatus == 'pending') $payClass .= 'status-pending';
                                        elseif ($payStatus == 'failed' || $payStatus == 'cancelled') $payClass .= 'status-cancelled';
                                        else $payClass .= 'status-pending';
                                        ?>
                                        <span class="<?= $payClass ?>">
                                            <?= ucfirst($order['payment_status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="order_dashboard/view.php?id=<?= $order['order_id'] ?>">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No orders found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>