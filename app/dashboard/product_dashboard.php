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

// جلب المنتجات من قاعدة البيانات
$query = "SELECT p.*, c.c_name, b.b_name, u.name AS added_by_name
            FROM products p
            JOIN categories c ON p.Category_id = c.category_id
            JOIN brands b ON p.Brand_id = b.brand_id
            JOIN users u ON p.`Added by` = u.id
            ORDER BY p.product_id DESC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

// إحصائيات المنتجات
$total_products = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM products"))['count'];
$total_categories = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM categories"))['count'];
$total_brands = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM brands"))['count'];
$total_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(price) as total FROM products"))['total'];

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

<body id="product_dashboard_page">
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <main>
            <div class="profile-container">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo htmlspecialchars($username); ?></b></p>
                        <p class="text-muted"><?= ucfirst($_SESSION['user_permissions']) ?></p>

                    </div>
                    <div class="profile-photo">
                        <img src="/project_2/assets/image/image_users/photo_private.png" alt="User Avatar">
                    </div>
                </div>
            </div>

            <div class="dashboard-header center-header">
                <h1>Products Dashboard</h1>
                <p class="dashboard-desc">Manage your products, view statistics, and add new items easily.</p>
            </div>
            <div class="data-info">
                <div class="box">
                    <i class="fas fa-table"></i>
                    <div class="data">
                        <p>Products</p>
                        <span><?= $total_products ?></span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-list"></i>
                    <div class="data">
                        <p>Categories</p>
                        <span><?= $total_categories ?></span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-tags"></i>
                    <div class="data">
                        <p>Brands</p>
                        <span><?= $total_brands ?></span>
                    </div>
                </div>
                <div class="box">
                    <i class="fas fa-dollar-sign"></i>
                    <div class="data">
                        <p>Total Value</p>
                        <span>$<?= number_format($total_price, 2) ?></span>
                    </div>
                </div>
            </div>
            <div class="products-section">
                <div class="products-header">
                    <div class="title-info">
                        <p>Products List</p>
                        <i class="fas fa-table"></i>
                    </div>
                    <a href="add_product.php" class="add-product-btn"><i class="fas fa-plus"></i> Add Product</a>
                </div>
                <table class="product-list-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Model Year</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Description</th>
                            <th>Added by</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($products) > 0): ?>
                            <?php $i = 1;
                            foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= htmlspecialchars($product['product_name']) ?></td>
                                    <td><?= htmlspecialchars($product['model_year']) ?></td>
                                    <td>
                                        <?php if ($product['Images']): ?>
                                            <img src="/project_2/data/uploads/image_products/<?= htmlspecialchars($product['Images']) ?>" alt="Product Image">
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($product['price']) ?></td>
                                    <td><?= htmlspecialchars($product['c_name']) ?></td>
                                    <td><?= htmlspecialchars($product['b_name']) ?></td>
                                    <td class="description-cell"><?= htmlspecialchars($product['description']) ?></td>
                                    <td><?= htmlspecialchars($product['added_by_name']) ?></td>
                                    <td>
                                        <a href="product_dashboard/edit.php?id=<?= $product['product_id'] ?>" class="table-action edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="product_dashboard/delete.php?id=<?= $product['product_id'] ?>" class="table-action delete" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">No products found.</td>
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