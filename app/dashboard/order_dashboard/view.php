<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// تحقق من صلاحية الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/index.php');
    exit();
}

// تحقق من وجود رقم الطلب
if (!isset($_GET['id'])) {
    header('location: /project_2/app/dashboard/order_dashboard.php');
    exit();
}

$order_id = intval($_GET['id']);

// جلب بيانات عناصر الطلب مع أسماء المنتج والخدمة
$order_items = [];
$query = "SELECT oi.*, p.product_name, s.s_name
          FROM order_items oi
          LEFT JOIN products p ON oi.Product_id = p.product_id
          LEFT JOIN services s ON oi.service_id = s.service_id
          WHERE oi.Order_id = $order_id";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $order_items = mysqli_fetch_all($result, MYSQLI_ASSOC);
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order Details</title>
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_order_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .order-items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px #e0e0e0;
        }

        .order-items-table th,
        .order-items-table td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .order-items-table th {
            background: #6c63ff;
            color: #fff;
            font-weight: 700;
        }

        .order-items-table tr:last-child td {
            border-bottom: none;
        }

        .order-items-table tbody tr:nth-child(even) td {
            background: #f6f6f9;
        }

        .order-items-table tbody tr:hover td {
            background: #e0e7ff;
        }

        .back-btn {
            display: inline-block;
            margin: 18px 0;
            padding: 10px 22px;
            background: linear-gradient(90deg, #6c63ff 0%, #43e97b 100%);
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.2s, box-shadow 0.2s;
        }

        .back-btn:hover {
            background: linear-gradient(90deg, #5548c8 0%, #43e97b 100%);
        }

        .order-header-flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            margin-top: 20px;
        }

        .order-header-flex h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
            color: #5548c8;
        }

        @media (max-width: 600px) {
            .order-header-flex {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .order-header-flex h2 {
                font-size: 1.1rem;
            }
        }

        body.dark-theme-variables .order-items-table {
            background: #23233a;
            box-shadow: 0 2px 12px #0006;
        }

        body.dark-theme-variables .order-items-table th {
            background: #8b7cff;
            color: #fff;
        }

        body.dark-theme-variables .order-items-table td {
            color: #f6f6f9;
        }

        body.dark-theme-variables .order-items-table tbody tr:nth-child(even) td {
            background: #23233a;
        }

        body.dark-theme-variables .order-items-table tbody tr:nth-child(odd) td {
            background: #181a1e;
        }

        body.dark-theme-variables .order-items-table tbody tr:hover td {
            background: #2d2d4d;
            color: #fff;
        }

        body.dark-theme-variables .back-btn {
            background: linear-gradient(90deg, #8b7cff 0%, #43e97b 100%);
            color: #fff;
        }

        body.dark-theme-variables .back-btn:hover {
            background: linear-gradient(90deg, #5548c8 0%, #43e97b 100%);
            color: #fff;
        }
    </style>
</head>

<body id="orders_page_layout">
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
        <main>
            <div class="order-header-flex">
                <h2>Order Items for Order </h2>
                <a href="/project_2/app/dashboard/order_dashboard.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
            </div>
            <table class="order-items-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product </th>
                        <th>Service ID</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($order_items) > 0): ?>
                        <?php $i = 1;
                        foreach ($order_items as $item): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($item['product_name'] ?? '---') ?></td>
                                <td><?= htmlspecialchars($item['s_name'] ?? '---') ?></td>
                                <td><?= htmlspecialchars($item['quantity_order']) ?></td>
                                <td>$<?= number_format($item['price'], 2) ?></td>
                                <td><?= htmlspecialchars($item['discount']) ?>%</td>
                                <td>$<?= number_format($item['total_price'], 2) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No items found for this order.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </main>
    </div>
    <script>
        // تفعيل الوضع الداكن تلقائياً إذا كان محفوظ في localStorage
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.body.classList.add('dark-theme-variables');
        } else {
            document.body.classList.remove('dark-theme-variables');
        }
    </script>
</body>

</html>