<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
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
    <link rel="stylesheet" href="/project_2/assets/css/style_product_dashboard.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=grid_view" />
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/webfonts">

    <title>Products Dashboard</title>
</head>

<body>
    <main id="product_dashboard" class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <div class="content">
            <div class="dashboard-header center-header">
                <h1>Products Dashboard</h1>
                <p class="dashboard-desc">Manage your products, view statistics, and add new items easily.</p>
            </div>
            <div class="data-info">
                <div class="box">
                    <i class="fas fa-user"></i>
                    <div class="data">
                        <p>user</p>
                        <span>100</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-pen"></i>
                    <div class="data">
                        <p>posts</p>
                        <span>765</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-table"></i>
                    <div class="data">
                        <p>products</p>
                        <span>34</span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-dollar"></i>
                    <div class="data">
                        <p>revenue</p>
                        <span>$126</span>
                    </div>
                </div>
                <!--End div data-info-->
            </div>
            <div class="products-section">
                <div class="products-header">
                    <div class="title-info">
                        <p>Products List</p>
                        <i class="fas fa-table"></i>
                    </div>
                    <button class="add-product-btn"><i class="fas fa-plus"></i> Add Product</button>
                </div>
                <table class="product-list-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="product-name">Foldable Mini Drone</td>
                            <td>85631</td>
                            <td>Due</td>
                            <td><span class="status-pending">Pending</span></td>
                            <td>
                                <button class="table-action edit"><i class="fas fa-pen"></i></button>
                                <button class="table-action delete"><i class="fas fa-trash"></i></button>
                                <button class="table-action details">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-name">LARVENDER KF102 Drone</td>
                            <td>36378</td>
                            <td>Refunded</td>
                            <td><span class="status-declined">Declined</span></td>
                            <td>
                                <button class="table-action edit"><i class="fas fa-pen"></i></button>
                                <button class="table-action delete"><i class="fas fa-trash"></i></button>
                                <button class="table-action details">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-name">Ruko F11 Pro Drone</td>
                            <td>49347</td>
                            <td>Due</td>
                            <td><span class="status-pending">Pending</span></td>
                            <td>
                                <button class="table-action edit"><i class="fas fa-pen"></i></button>
                                <button class="table-action delete"><i class="fas fa-trash"></i></button>
                                <button class="table-action details">Details</button>
                            </td>
                        </tr>
                        <tr>
                            <td class="product-name">Drone with Camera Drone</td>
                            <td>96996</td>
                            <td>Paid</td>
                            <td><span class="status-delivered">Delivered</span></td>
                            <td>
                                <button class="table-action edit"><i class="fas fa-pen"></i></button>
                                <button class="table-action delete"><i class="fas fa-trash"></i></button>
                                <button class="table-action details">Details</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

    </main>

</body>

</html>