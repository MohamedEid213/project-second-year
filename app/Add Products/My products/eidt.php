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

    $Show_Products = "SELECT p.*, c.C_name as category_name, b.b_name as brand_name 
                      FROM `products` p 
                      JOIN `categories` c ON p.Category_id = c.category_id 
                      JOIN `brands` b ON p.Brand_id = b.brand_id 
                      WHERE p.`product_id` = $id";
    $Query = mysqli_query($conn, $Show_Products);
    $Row = mysqli_fetch_assoc($Query);

    $Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
    $All_Category = mysqli_query($conn, $Select_Category);

    $Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
    $All_Brands = mysqli_query($conn, $Select_Brands);

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $brand = $_POST['brand'];
        $description = $_POST['description'];
        $model_year = $_POST['model_year'];

        $Update_Product = "UPDATE `products` SET 
                          `product_name`='$name', 
                          `price`='$price', 
                          `Category_id`='$category', 
                          `Brand_id`='$brand', 
                          `description`='$description', 
                          `model_year`='$model_year' 
                          WHERE `product_id` = $id";
        $Query = mysqli_query($conn, $Update_Product);
        header('location: /project_2/app/Add Products/My products/index.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Product</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_add_product.css">
    <link rel="stylesheet" href="/project_2/assets/css/dark-mode.css">
    <style>
        .container {
            width: 50%;
        }

        .product-edit-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.13);
            padding: 36px 28px;
            margin-bottom: 36px;
            transition: box-shadow 0.2s;
        }

        .product-edit-card:hover {
            box-shadow: 0 16px 48px 0 rgba(0, 0, 0, 0.18);
        }

        .product-edit-title {
            color: var(--color-primary);
            font-size: 2.3rem;
            font-weight: bold;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-edit-title a {
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

        .product-edit-title a:hover {
            background: linear-gradient(90deg, var(--color-primary-hover), var(--color-primary));
            box-shadow: 0 4px 16px rgba(8, 102, 255, 0.18);
            transform: translateY(-2px) scale(1.04);
        }

        .edit-form {
            background: #f8fafd;
            border-radius: 12px;
            padding: 24px;
            margin-top: 16px;
        }

        .edit-form h3 {
            color: var(--color-primary);
            font-size: 1.3rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .product-image-preview {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 120px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            background: #f9f9f9;
            transition: border-color 0.2s;
        }

        .product-image-preview:hover {
            border-color: var(--color-primary);
        }

        .product-thumbnail {
            max-width: 100%;
            max-height: 100%;
            border-radius: 6px;
            object-fit: cover;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: #999;
        }

        .no-image i {
            font-size: 2rem;
        }

        .no-image span {
            font-size: 0.9rem;
        }

        .edit-form label {
            display: block;
            color: var(--color-primary);
            font-weight: bold;
            margin-bottom: 8px;
            font-size: 1.1rem;
        }

        .edit-form input,
        .edit-form select,
        .edit-form textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .edit-form textarea {
            resize: vertical;
            min-height: 100px;
        }

        .edit-form input:focus,
        .edit-form select:focus,
        .edit-form textarea:focus {
            border-color: var(--color-primary);
            outline: none;
            box-shadow: 0 0 8px rgba(8, 102, 255, 0.2);
        }

        .edit-btn {
            background: linear-gradient(90deg, var(--color-primary), var(--color-primary-hover));
            color: #fff;
            border: none;
            padding: 12px 24px;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            box-shadow: 0 2px 8px rgba(8, 102, 255, 0.10);
            width: 100%;
        }

        .edit-btn:hover {
            background: linear-gradient(90deg, var(--color-primary-hover), var(--color-primary));
            box-shadow: 0 4px 16px rgba(8, 102, 255, 0.18);
            transform: translateY(-2px);
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
            <div class="product-edit-card">
                <div class="product-edit-title">
                    Edit Product
                    <a href="/project_2/app/Add Products/My products/index.php"><i class="fas fa-list me-2"></i> List Products</a>
                </div>

                <!-- Edit Form -->
                <form action="" method="post" class="edit-form">
                    <h3>Update Product Information</h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" name="name" value="<?= $Row['product_name'] ?>" id="name" required>
                        </div>
                        <div class="form-group">
                            <label>Product Image</label>
                            <div class="product-image-preview">
                                <?php if ($Row['Images']) : ?>
                                    <img src="/project_2/data/uploads/image_products/<?= $Row['Images'] ?>"
                                        alt="<?= $Row['product_name'] ?>"
                                        class="product-thumbnail"
                                        onerror="this.src='/project_2/assets/image/image_product/photo_private.png'">
                                <?php else : ?>
                                    <div class="no-image">
                                        <i class="fas fa-image"></i>
                                        <span>No Image</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Price (£E)</label>
                            <input type="number" name="price" value="<?= $Row['price'] ?>" id="price" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="model_year">Model Year</label>
                            <input type="number" name="model_year" value="<?= $Row['model_year'] ?>" id="model_year" min="1900" max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" required>
                                <?php foreach ($All_Category as $category) : ?>
                                    <option value="<?= $category['category_id'] ?>" <?= ($category['category_id'] == $Row['Category_id']) ? 'selected' : '' ?>>
                                        <?= $category['C_name'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand</label>
                            <select name="brand" id="brand" required>
                                <?php foreach ($All_Brands as $brand) : ?>
                                    <option value="<?= $brand['brand_id'] ?>" <?= ($brand['brand_id'] == $Row['Brand_id']) ? 'selected' : '' ?>>
                                        <?= $brand['b_name'] ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" required><?= $Row['description'] ?></textarea>
                    </div>

                    <button type="submit" name="submit" class="edit-btn">
                        <i class="fas fa-save me-2"></i> Save Changes
                    </button>
                </form>
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