<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

if ($_SESSION['user_permissions'] == 'user') {
    header('location: /project_2/Home.php');
    exit();
}

$num = 1;
$id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

$Select_Products = "SELECT * FROM products WHERE `Added by` = '$id' ORDER BY `product_id` DESC ";
$All_product = mysqli_query($conn, $Select_Products);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Products</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_add_product.css">
    <link rel="stylesheet" href="/project_2/assets/css/dark-mode.css">
    <style>
        .container {
            width: 50%;
        }

        .product-list-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.13);
            padding: 36px 28px;
            margin-bottom: 36px;
            transition: box-shadow 0.2s;
        }

        .product-list-card:hover {
            box-shadow: 0 16px 48px 0 rgba(0, 0, 0, 0.18);
        }

        .product-list-title {
            color: var(--color-primary);
            font-size: 2.3rem;
            font-weight: bold;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-list-title a {
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

        .product-list-title a:hover {
            background: linear-gradient(90deg, var(--color-primary-hover), var(--color-primary));
            box-shadow: 0 4px 16px rgba(8, 102, 255, 0.18);
            transform: translateY(-2px) scale(1.04);
        }

        .product-list-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 16px;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .product-list-table th {
            background: var(--color-primary);
            color: #fff;
            font-weight: bold;
            font-size: 1.12rem;
            border: none;
            padding: 16px 10px;
        }

        .product-list-table td {
            background: #f8fafd;
            color: #222;
            font-size: 1.05rem;
            border-bottom: 1px solid #eaeaea;
            padding: 14px 10px;
            transition: background 0.2s;
        }

        .product-list-table tr:last-child td {
            border-bottom: none;
        }

        .product-list-table tr:hover td {
            background: #e6f0ff;
        }

        .product-list-table td.action-cell {
            padding: 0 4px;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            min-width: 38px;
            height: 38px;
            border-radius: 24px;
            background: #f0f4ff;
            font-size: 1.08rem;
            margin: 0 4px;
            border: 2px solid var(--color-primary);
            box-shadow: 0 1px 4px rgba(8, 102, 255, 0.07);
            transition: background 0.2s, color 0.2s, box-shadow 0.2s, min-width 0.2s;
            position: relative;
            padding: 0 16px 0 10px;
            gap: 7px;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            color: var(--color-primary);
            text-decoration: none ;
        }

        .action-btn.show {
            background: #f0f4ff;
            border-color: var(--color-primary);
            color: var(--color-primary);
        }

        .action-btn.edit {
            background: #e8f9f0;
            border-color: #28a745;
            color: #28a745;
        }

        .action-btn.delete {
            background: #fff0f0;
            border-color: #dc3545;
            color: #dc3545;
        }

        .action-btn i {
            font-size: 1.18rem;
            opacity: 0;
            margin-right: 0;
            margin-left: 0;
            transition: opacity 0.2s, transform 0.2s, color 0.2s;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) scale(0.7);
        }

        .action-btn span {
            display: inline-block;
            opacity: 1;
            transition: opacity 0.2s, transform 0.2s;
        }

        .action-btn:hover {
            color: #fff;
            box-shadow: 0 2px 8px rgba(8, 102, 255, 0.18);
            justify-content: center;
            text-decoration: none !important;
        }

        .action-btn.show:hover {
            background: var(--color-primary);
            border-color: var(--color-primary);
        }

        .action-btn.edit:hover {
            background: #28a745;
            border-color: #28a745;
        }

        .action-btn.delete:hover {
            background: linear-gradient(90deg, #c82333, #dc3545);
            box-shadow: 0 4px 16px rgba(220, 53, 69, 0.18);
            transform: translateY(-2px);
        }

        .action-btn:hover span {
            opacity: 0;
            transform: scale(0.7);
        }

        .action-btn:hover i {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.2);
            color: #fff;
        }

   
    </style>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">
        <section class="container col-md-7 my-5 ">
            <div class="product-list-card">
                <div class="product-list-title">
                    List Products
                    <a href="/project_2/app/Add Products/add_products.php"><i class="fas fa-plus-circle me-2"></i> Add Product</a>
                </div>
                <table class="product-list-table">
                    <tr>
                        <th class="text-light  fs-4">id</th>
                        <th class="text-light fs-4">Name</th>
                        <th class="text-light align-center fs-4" colspan="3">Actions</th>
                    </tr>
                    <?php foreach ($All_product as $product) : ?>
                        <tr>
                            <td> <?= $num++; ?> </td>
                            <td> <?= $product['product_name'] ?></td>
                            <td class="action-cell"><a title="Show" class="action-btn show" href="/project_2/app/Add Products/My products/show.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-eye"></i> <span>Show</span></a></td>
                            <td class="action-cell"><a title="Edit" class="action-btn edit" href="/project_2/app/Add Products/My products/eidt.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-pen-to-square"></i> <span>Edit</span></a></td>
                            <td class="action-cell"><a title="Delete" class="action-btn delete" href="/project_2/app/Add Products/My products/delete.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-trash"></i> <span>Delete</span></a></td>
                        </tr>
                    <?php endforeach ?>
                </table>
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