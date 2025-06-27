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


$id = $_SESSION['user_id'];
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

// حساب عدد عناصر السله
$count_cart = "SELECT COUNT(*) as cart_count FROM `basket` WHERE Client_id = $user_id";
$result = mysqli_query($conn, $count_cart);
$row = mysqli_fetch_assoc($result);
$cart_items_count = $row['cart_count'];

$Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
$All_Category = mysqli_query($conn, $Select_Category);

$Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_Brands);

$errors = [];
if (isset($_POST['submit'])) {
    if (!empty($_POST['name']) && !empty($_POST['price']) && !empty($_POST['category']) && !empty($_POST['brand']) && !empty($_POST['descript'])) {
        $name = $_POST['name'];
        $price = (int) $_POST['price'];
        $category = (int) $_POST['category'];
        $brand = (int) $_POST['brand'];
        $descript = $_POST['descript'];
        $model_year = (int) $_POST['model_year'] || null;

        // upload image
        $image = $_FILES['image'];
        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $image_type = $_FILES['image']['type'];
        $image_size = $_FILES['image']['size'];
        $image_errors = $_FILES['image']['error'];

        $allowed_extansions = array('jpg', 'gif', 'jpeg', 'png', 'jfif');
        $image_extansions = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $is_image = false;
        if ($image_errors == 4) {
            $errors[] = 'You must upload an image file.';
        } else {
            // تحقق من نوع الملف (MIME type) بالإضافة للامتداد
            $mime_types = array('image/jpeg', 'image/png', 'image/gif', 'image/jpg', 'image/jfif');
            if (in_array($image_extansions, $allowed_extansions) && in_array($image_type, $mime_types)) {
                $is_image = true;
            }
            if (!$is_image) {
                $errors[] = 'Only image files (jpg, jpeg, png, gif, jfif) are allowed.';
            }
        }
        if (empty($errors)) {
            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/project_2/data/uploads/image_products/';
            $target_file = $upload_dir . basename($image_name);
            move_uploaded_file($image_temp, $target_file);

            $Row_Data = "INSERT INTO `products`( `product_name`, `model_year`, `Images`, `price`, `Category_id`, `Brand_id`, `description`,`Added by`) 
        VALUES ('$name','$model_year','$image_name','$price','$category','$brand','$descript',$user_id)";
            $Add_Product = mysqli_query($conn, $Row_Data);
            header('location: /project_2/app/dashboard/product_dashboard.php');
        }
    } else {
        $errors[] = 'Please fill in all required fields.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/dark-mode.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Add Product - Dashboard</title>
    <style>
        .form-container {
            background: var(--color-white);
            padding: var(--card-padding);
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
            margin-top: 1rem;
        }

        .form-title {
            color: var(--primary-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--color-dark);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--color-info-light);
            border-radius: var(--border-radius-1);
            background: var(--color-white);
            color: var(--color-dark);
            font-size: 0.9rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .btn-submit {
            background: var(--primary-color);
            color: var(--color-white);
            padding: 0.75rem 2rem;
            border: none;
            border-radius: var(--border-radius-1);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-submit:hover {
            background: var(--color-primary-variant);
            transform: translateY(-2px);
        }

        .error-messages {
            background: rgba(255, 119, 130, 0.1);
            border: 1px solid var(--color-danger);
            border-radius: var(--border-radius-1);
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .error-title {
            color: var(--color-danger);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .error-messages ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .error-messages li {
            color: var(--color-dark);
            margin-bottom: 0.25rem;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .btn-back {
            background: var(--color-info-dark);
            color: var(--color-white);
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius-1);
            text-decoration: none;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: var(--color-primary-variant);
        }
    </style>
</head>

<body id="dashboard">
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <main>
            <h1 class="title">Add New Product</h1>
            <div class="date">
                <input type="date">
            </div>

            <div class="form-container">
                <div class="header">
                    <h2>Product Information</h2>
                    <a href="/project_2/app/dashboard/product_dashboard.php" class="btn-back">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>

                <?php if (!empty($errors)) : ?>
                    <div class="error-messages">
                        <div class="error-title">Please fix the following errors:</div>
                        <ul>
                            <?php foreach ($errors as $error) : ?>
                                <li><?= $error ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name *</label>
                        <input type="text" name="name" id="name" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Price (£E) *</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" required>
                        </div>
                        <div class="form-group">
                            <label for="model_year">Model Year</label>
                            <input type="number" name="model_year" id="model_year" min="1900" max="2030">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select name="category" id="category" required>
                                <option value="">Select Category</option>
                                <?php foreach ($All_Category as $category) : ?>
                                    <option value="<?= $category['category_id'] ?>"><?= $category['C_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="brand">Brand *</label>
                            <select name="brand" id="brand" required>
                                <option value="">Select Brand</option>
                                <?php foreach ($All_Brands as $brand) : ?>
                                    <option value="<?= $brand['brand_id'] ?>"><?= $brand['b_name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image *</label>
                        <input type="file" name="image" id="image" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="descript">Description *</label>
                        <textarea name="descript" id="descript" rows="4" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn-submit">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                </form>
            </div>
        </main>

        <div class="right">
            <div class="top">
                <button id="menu-btn">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?= $_SESSION['username'] ?></b></p>
                        <small class="text-muted"><?= ucfirst($_SESSION['user_permissions']) ?></small>
                    </div>
                    <div class="profile-photo">
                        <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="recent-updates">
                <h2>Quick Tips</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="messages">
                            <p><b>Image Requirements</b></p>
                            <small class="text-muted">Use JPG, PNG, GIF, or JFIF formats</small>
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="messages">
                            <p><b>Required Fields</b></p>
                            <small class="text-muted">All fields marked with * are required</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/project_2/assets/js/dashboard.js"></script>
</body>

</html>