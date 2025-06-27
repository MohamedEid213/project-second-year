<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// تحقق من صلاحيات الأدمن
if (!isset($_SESSION['user_id']) || $_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/index.php');
    exit();
}

// استقبال معرف المنتج
if (!isset($_GET['id'])) {
    die('Product ID is required.');
}
$product_id = intval($_GET['id']);

// جلب بيانات المنتج
$query = "SELECT * FROM products WHERE product_id = $product_id";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}
$product = mysqli_fetch_assoc($result);
if (!$product) {
    die('Product not found.');
}

// جلب التصنيفات
$res = mysqli_query($conn, "SELECT * FROM categories");
$categories =  mysqli_fetch_all($res, MYSQLI_ASSOC);

// جلب الماركات
$res = mysqli_query($conn, "SELECT * FROM brands");
$brands =  mysqli_fetch_all($res, MYSQLI_ASSOC);

// عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // جلب القيم من النموذج
    $product_name = $_POST['product_name'] ?? '';
    $model_year = $_POST['model_year'] ?? '';
    $price = $_POST['price'] ?? '';
    $Category_id = $_POST['Category_id'] ?? '';
    $Brand_id = $_POST['Brand_id'] ?? '';
    $description = $_POST['description'] ?? '';

    // استعلام التحديث
    $update = "UPDATE products SET 
        product_name = '$product_name',
        model_year = '$model_year',
        price = '$price',
        Category_id = '$Category_id',
        Brand_id = '$Brand_id',
        description = '$description'
        WHERE product_id = $product_id";

    if (mysqli_query($conn, $update)) {
        $success = "Product updated successfully.";
        // تحديث البيانات المعروضة في الصفحة مباشرة
        $product['product_name'] = $product_name;
        $product['model_year'] = $model_year;
        $product['price'] = $price;
        $product['Category_id'] = $Category_id;
        $product['Brand_id'] = $Brand_id;
        $product['description'] = $description;
        header('location: /project_2/app/dashboard/product_dashboard.php');
        exit();
    } else {
        $error = "Failed to update product: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_product_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .edit-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }

        .edit-main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .edit-form-container {
            width: 100%;
            max-width: 420px;
            background: var(--color-white);
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            margin: 3rem 0 2.5rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .edit-form-container h2 {
            margin-bottom: 1.5rem;
            text-align: center;
            color: #6c63ff;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: 1px;
        }

        .edit-form-container form {
            width: 100%;
        }

        .edit-form-container label {
            display: block;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--color-dark);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .edit-form-container select,
        .edit-form-container input {
            width: 100%;
            padding: 0.7rem;
            border-radius: var(--border-radius-2);
            border: 1px solid var(--color-light);
            background: var(--color-white);
            color: var(--color-dark);
            font-size: 1rem;
            margin-bottom: 0.5rem;
            transition: border 0.2s;
        }

        .edit-form-container select:focus,
        .edit-form-container input:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .edit-form-container button {
            margin-top: 1.8rem;
            width: 100%;
            background: linear-gradient(90deg, #6c63ff 0%, #43e97b 100%);
            color: #fff;
            font-weight: 700;
            border-radius: var(--border-radius-2);
            padding: 1rem;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(60, 60, 100, 0.08);
            transition: background 0.2s, transform 0.2s;
        }

        .edit-form-container button:hover {
            background: linear-gradient(90deg, #43e97b 0%, #6c63ff 100%);
            transform: translateY(-2px) scale(1.01);
        }

        .msg-success {
            color: #28a745;
            margin-top: 1rem;
            text-align: center;
            font-weight: 600;
        }

        .msg-error {
            color: #dc3545;
            margin-top: 1rem;
            text-align: center;
            font-weight: 600;
        }

        .edit-form-container a {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: var(--primary-color);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .edit-form-container a:hover {
            color: #43e97b;
        }

        @media (max-width: 900px) {
            .edit-wrapper {
                flex-direction: column;
                align-items: stretch;
            }

            .edit-form-container {
                min-width: unset;
                max-width: 98vw;
            }
        }

        .row-flex {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.2rem;
        }

        .col-half {
            flex: 1 1 0;
            min-width: 0;
        }

        @media (max-width: 700px) {
            .row-flex {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        .current-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 12px;
            border: 2.5px solid var(--primary-color);
            box-shadow: 0 2px 12px rgba(60, 60, 100, 0.10);
            background: #f6f6f9;
        }

        body.dark-theme-variables input,
        body.dark-theme-variables textarea,
        body.dark-theme-variables select {
            background: #232b3b !important;
            color: #fff !important;
            border: 1.5px solid #60a5fa !important;
            box-shadow: none;
        }

        body.dark-theme-variables input:focus,
        body.dark-theme-variables textarea:focus,
        body.dark-theme-variables select:focus {
            border-color: #3b82f6 !important;
            background: #1e293b !important;
            color: #fff !important;
        }

        .edit-form-container textarea {
            min-height: 120px;
            height: 110px;
            max-height: 320px;
            width: 100%;
            resize: vertical;
            font-size: 1.08rem;
            line-height: 1.7;
            padding: 1rem;
        }
    </style>
</head>

<body id="product_dashboard_page" class="dark-theme-variables">
    <div class="edit-wrapper">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
        <div class="edit-main-content">
            <div class="edit-form-container">
                <h2>Edit Product</h2>
                <?php if (isset($success)): ?>
                    <div class="msg-success"><?= $success ?></div>
                <?php elseif (isset($error)): ?>
                    <div class="msg-error"><?= $error ?></div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="row-flex">
                        <div class="col-half">
                            <label for="product_name">Product Name</label>
                            <input type="text" name="product_name" id="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                        </div>
                        <div class="col-half">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" value="<?= htmlspecialchars($product['price']) ?>" required>
                        </div>
                    </div>

                    <label for="model_year">Model Year</label>
                    <input type="text" name="model_year" id="model_year" value="<?= htmlspecialchars($product['model_year']) ?>" required>

                    <div class="row-flex">
                        <div class="col-half">
                            <label>Product Image</label>
                            <div class="current-image">
                                <?php if ($product['Images']): ?>
                                    <img src="/project_2/data/uploads/image_products/<?= htmlspecialchars($product['Images']) ?>" alt="Product Image">
                                <?php else: ?>
                                    <span>No image</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-half">
                            <label for="price2">Price</label>
                            <input type="number" name="price2" id="price2" value="<?= htmlspecialchars($product['price']) ?>" readonly style="background:#f6f6f9;">
                        </div>
                    </div>

                    <div class="row-flex">
                        <div class="col-half">
                            <label for="Category_id">Category</label>
                            <select name="Category_id" id="Category_id" required>
                                <?php foreach (
                                    $categories as $cat
                                ): ?>
                                    <option value="<?= $cat['category_id'] ?>" <?= $product['Category_id'] == $cat['category_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($cat['C_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-half">
                            <label for="Brand_id">Brand</label>
                            <select name="Brand_id" id="Brand_id" required>
                                <?php foreach ($brands as $brand): ?>
                                    <option value="<?= $brand['brand_id'] ?>" <?= $product['Brand_id'] == $brand['brand_id'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($brand['b_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="6" required><?= htmlspecialchars($product['description']) ?></textarea>

                    <label>Added by</label>
                    <input type="text" value="<?= htmlspecialchars($product['Added by']) ?>" readonly>

                    <button type="submit">Save Changes</button>
                </form>
                <a href="/project_2/app/dashboard/product_dashboard.php">← Back to Products</a>
            </div>
        </div>
    </div>
    <script>
        // تحقق من تفضيل المستخدم في localStorage
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.body.classList.add('dark-theme-variables');
        } else {
            document.body.classList.remove('dark-theme-variables');
        }
    </script>
</body>

</html>