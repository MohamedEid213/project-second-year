<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
  header('location: ./index.php');
  exit();
}

if ($_SESSION['user_permissions'] != 'admin') {

  header('location: /project_2/Home.php');
  exit();
}

$permissions = $_SESSION['user_permissions'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];



// جلب آخر 7 طلبات (يمكنك تغيير العدد حسب الحاجة)
$recent_orders = [];
$query_recent = "SELECT o.order_id, o.order_status, o.payment_status, o.total_price, o.order_date, 
                        p.product_name
                 FROM orders o
                  JOIN order_items oi ON o.order_id = oi.Order_id
                  JOIN products p ON oi.Product_id = p.product_id
                 ORDER BY o.order_date DESC
                 LIMIT 7";
$result_recent = mysqli_query($conn, $query_recent);
if ($result_recent && mysqli_num_rows($result_recent) > 0) {
  $recent_orders = mysqli_fetch_all($result_recent, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
  <!-- cdnjs library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=grid_view" />
  <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/webfonts">
  <title>Dashboard</title>
</head>

<body id="dashboard">
  <div class="container">
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
    <main>
      <h1 class="title">Dashboard</h1>
      <div class="date">
        <input type="date">
      </div>
      <div class="insights">
        <div class="sales">
          <div class="middle">
            <div class="left">
              <i class="fas fa-chart-bar"></i>
              <h3>Total Sales</h3>
              <h1>$25,024</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>81%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
          <!-- End of sales  -->
        </div>
        <div class="expenses">
          <div class="middle">
            <div class="left">
              <i class="fas fa-chart-bar"></i>
              <h3>Total Expenses</h3>
              <h1>$14,160</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>62%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
          <!-- End of sales  -->
        </div>
        <div class="income">
          <div class="middle">
            <div class="left">
              <i class="fas fa-chart-line"></i>
              <h3>Total Income</h3>
              <h1>$10,864</h1>
            </div>
            <div class="progress">
              <svg>
                <circle cx="38" cy="38" r="36"></circle>
              </svg>
              <div class="number">
                <p>44%</p>
              </div>
            </div>
          </div>
          <small class="text-muted">Last 24 Hours</small>
          <!-- End of sales  -->
        </div>
        <!-- End Insights -->
      </div>

      <div class="recent-orders">
        <h2>Recent Orders</h2>
        <table>
          <thead>
            <tr>
              <th>Product Name</th>
              <th>Product Number</th>
              <th>Payment</th>
              <th>Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php if (count($recent_orders) > 0): ?>
              <?php foreach ($recent_orders as $order): ?>
                <tr>
                  <td><?= htmlspecialchars($order['product_name'] ?? '---') ?></td>
                  <td><?= htmlspecialchars($order['order_id']) ?></td>
                  <td><?= htmlspecialchars($order['payment_status']) ?></td>
                  <td class="<?php
                              $status = strtolower($order['order_status']);
                              if ($status == 'pending') echo 'warning';
                              elseif ($status == 'completed' || $status == 'delivered') echo 'success';
                              elseif ($status == 'declined' || $status == 'cancelled') echo 'danger';
                              else echo 'primary';
                              ?>">
                    <?= ucfirst($order['order_status']) ?>
                  </td>
                  <td class="primary">
                    <a href="/project_2/app/dashboard/order_dashboard/view.php?id=<?= $order['order_id'] ?>" style="color:inherit;text-decoration:none;">Details</a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No recent orders found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        <a href="/project_2/app/dashboard/order_dashboard.php">Show All</a>
      </div>
    </main>
    <!-- End main Section  -->
    <div class="right">
      <div class="top">
        <button id="menu-btn">
          <i class="fas fa-bars"></i>
        </button>
        <div class="profile">
          <div class="info">
            <p>Hey, <b><?= htmlspecialchars($username) ?></b></p>
            <small class="text-muted">Admin</small>
          </div>
          <div class="profile-photo">
            <img src="/project_2/assets/image/image_users/photo_private.png" alt="">
          </div>
        </div>

      </div>
      <!-- End top section -->
      <div class="recent-updates">
        <h2>recent updates</h2>
        <div class="updates">
          <div class="update">
            <div class="profile-photo">
              <img src="/project_2/assets/image/photo_dashboard/profile-2.jpg" alt="">
            </div>
            <div class="messages">
              <p><b>Mike Tyson</b>Received his order of Night lion tech GPS drone </p>
              <small class="text-muted">2 Minutes Ago</small>
            </div>
          </div>
          <div class="update">
            <div class="profile-photo">
              <img src="/project_2/assets/image/photo_dashboard/profile-3.jpeg" alt="">
            </div>
            <div class="messages">
              <p><b>Mike Tyson</b>Received his order of Night lion tech GPS drone </p>
              <small class="text-muted">2 Minutes Ago</small>
            </div>
          </div>
          <div class="update">
            <div class="profile-photo">
              <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="">
            </div>
            <div class="messages">
              <p><b>Ahmed Hussin</b>Received his order of Night lion tech GPS drone </p>
              <small class="text-muted">2 Minutes Ago</small>
            </div>
          </div>
        </div>
      </div>
      <!-- End recent updates -->
      <div class="sales-analytics">
        <h2>Sales Analytics</h2>
        <div class="item online">
          <div class="icon">
            <i class="fas fa-shopping-cart"></i>
          </div>
          <div class="right">
            <div class="info">
              <h3>ONLINE ORDERS</h3>
              <small class="text-muted">Last 24 Hours</small>
            </div>
            <h5>+39%</h5>
            <h3>3849</h3>
          </div>
        </div>
        <!-- End online  -->
        <div class="item customers">
          <div class="icon">
            <i class="fas fa-user"></i>
          </div>
          <div class="right">
            <div class="info">
              <h3>NEW CUSTOMERS</h3>
              <small class="text-muted">Last 24 Hours</small>
            </div>
            <h5>+39%</h5>
            <h3>3849</h3>
          </div>
        </div>
        <!-- End online  -->
        <div class="item offline">
          <div class="icon">
            <i class="fas fa-shopping-bag"></i>
          </div>
          <div class="right">
            <div class="info">
              <h3>OFFLINE ORDERS</h3>
              <small class="text-muted">Last 24 Hours</small>
            </div>
            <h5>-17%</h5>
            <h3>1100</h3>
          </div>
        </div>
        <!-- End online  -->
        <a href="/project_2/app/dashboard/add_product.php" class="item add-product" style="text-decoration:none;">
          <div>
            <i class="fas fa-plus"></i>
            <h3>Add Product</h3>
          </div>
        </a>
      </div>
    </div>
  </div>
  <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>