<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    // جلب معلومات المنتج مع معلومات الفئة والعلامة التجارية والمستخدم
    $Show = "SELECT p.*, c.C_name as category_name, b.b_name as brand_name, u.name as added_by_name 
             FROM `products` p 
             JOIN `categories` c ON p.Category_id = c.category_id 
             JOIN `brands` b ON p.Brand_id = b.brand_id 
             JOIN `users` u ON p.`Added by` = u.id 
             WHERE p.`product_id` = $id";
    $Query = mysqli_query($conn, $Show);
    $Row = mysqli_fetch_assoc($Query);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Show Product</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_add_product.css">
    <link rel="stylesheet" href="/project_2/assets/css/dark-mode.css">
    <style>
        .container {
            width: 50%;
        }


        .product-show-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.13);
            padding: 36px 28px;
            margin-bottom: 36px;
            transition: box-shadow 0.2s;
        }

        .product-show-card:hover {
            box-shadow: 0 16px 48px 0 rgba(0, 0, 0, 0.18);
        }

        .product-show-title {
            color: var(--color-primary);
            font-size: 2.3rem;
            font-weight: bold;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-show-title a {
            font-size: 1.08rem;
            padding: 10px 22px;
            border-radius: 10px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-hover));
            color: #fff;
            text-decoration: none;
            font-weight: 600;
            box-shadow: 0 2px 8px rgba(8, 102, 255, 0.10);
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .product-show-title a:hover {
            background: linear-gradient(90deg, var(--color-primary-hover), var(--color-primary));
            box-shadow: 0 4px 16px rgba(8, 102, 255, 0.18);
            transform: translateY(-2px) scale(1.04);
        }

        .product-info {
            background: #f8fafd;
            border-radius: 12px;
            padding: 24px;
            margin-top: 16px;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        .product-table th,
        .product-table td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e1e5e9;
        }

        .product-table th {
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-hover));
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .product-table tr:hover {
            background: #f0f4ff;
            transition: background 0.2s;
        }

        .product-table td {
            font-size: 1rem;
            color: #333;
            font-weight: 500;
        }

        .product-table td:first-child {
            font-weight: bold;
            color: var(--color-primary);
            min-width: 140px;
        }

        .product-image {
            max-width: 200px;
            max-height: 150px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            object-fit: cover;
        }

        .product-description {
            max-width: 400px;
            line-height: 1.6;
            color: #666;
        }

        .price-value {
            font-weight: bold;
            color: #28a745;
            font-size: 1.2rem;
        }

        .category-badge {
            background: linear-gradient(90deg, #17a2b8, #138496);
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .brand-badge {
            background: linear-gradient(90deg, #6f42c1, #5a32a3);
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .user-badge {
            background: linear-gradient(90deg, #fd7e14, #e55a00);
            color: #fff;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .product-info h3 label {
            color: var(--color-primary);
            font-weight: bold;
            min-width: 120px;
        }
    </style>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">
        <section class="container col-md-10 my-5 ">
            <div class="product-show-card">
                <div class="product-show-title">
                    Product Details
                    <a href="./index.php"><i class="fas fa-list me-2"></i> List Products</a>
                </div>
                <div class="product-info">
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th colspan="2">Product Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Product ID</td>
                                <td>#<?= $Row['product_id'] ?></td>
                            </tr>
                            <tr>
                                <td>Product Name</td>
                                <td><?= $Row['product_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Model Year</td>
                                <td><?= $Row['model_year'] ? $Row['model_year'] : 'Not specified' ?></td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td><span class="price-value">$<?= number_format($Row['price'], 2) ?></span></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td><span class="category-badge"><?= $Row['category_name'] ?></span></td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td><span class="brand-badge"><?= $Row['brand_name'] ?></span></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td class="product-description"><?= $Row['description'] ?></td>
                            </tr>
                            <tr>
                                <td>Product Image</td>
                                <td>
                                    <?php if ($Row['Images']) : ?>
                                        <img src="/project_2/data/uploads/image_products/<?= $Row['Images'] ?>"
                                            alt="<?= $Row['product_name'] ?>"
                                            class="product-image"
                                            onerror="this.src='/project_2/assets/image/image_product/photo_private.png'">
                                    <?php else : ?>
                                        <span style="color: #999;">No image available</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Added By</td>
                                <td><span class="user-badge"><?= $Row['added_by_name'] ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
    <div id="overlay"></div>

</body>

</html>
<script src="/project_2/assets/js/sidebar.js"></script>