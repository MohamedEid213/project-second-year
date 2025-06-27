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
            <tr>
              <td>Foldable Mini Drone</td>
              <td>85631</td>
              <td>Due</td>
              <td class="warning">Pending</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>LARVENDER KF102 Drone</td>
              <td>36378</td>
              <td>Refunded</td>
              <td class="danger">Declined</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>Ruko F11 Pro Drone</td>
              <td>49347</td>
              <td>Due</td>
              <td class="warning">Pending</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>Drone with Camera Drone</td>
              <td>96996</td>
              <td>Paid</td>
              <td class="success">Delivered</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>GPS 4k Drone</td>
              <td>22821</td>
              <td>Paid</td>
              <td class="success">Delivered</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>DJI Air 2S</td>
              <td>81475</td>
              <td>Due</td>
              <td class="warning">Pending</td>
              <td class="primary">Details</td>
            </tr>
            <tr>
              <td>Lozenge Drone</td>
              <td>00482</td>
              <td>Paid</td>
              <td class="success">Delivered</td>
              <td class="primary">Details</td>
            </tr>

          </tbody>
        </table>
        <a href="#">Show All</a>
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
            <p>Hey, <b>Daniel</b></p>
            <small class="text-muted">Admin</small>
          </div>
          <div class="profile-photo">
            <img src="Images/profile-1.jpg" alt="">
          </div>
        </div>

      </div>
      <!-- End top section -->
      <div class="recent-updates">
        <h2>recent updates</h2>
        <div class="updates">
          <div class="update">
            <div class="profile-photo">
              <img src="Images/profile-2.jpg" alt="">
            </div>
            <div class="messages">
              <p><b>Mike Tyson</b>Received his order of Night lion tech GPS drone </p>
              <small class="text-muted">2 Minutes Ago</small>
            </div>
          </div>
          <div class="update">
            <div class="profile-photo">
              <img src="Images/profile-3.jpeg" alt="">
            </div>
            <div class="messages">
              <p><b>Mike Tyson</b>Received his order of Night lion tech GPS drone </p>
              <small class="text-muted">2 Minutes Ago</small>
            </div>
          </div>
          <div class="update">
            <div class="profile-photo">
              <img src="Images/profile-1.jpg" alt="">
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
        <div class="item add-product">
          <div>
            <i class="fas fa-plus"></i>
            <h3>Add Product</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>