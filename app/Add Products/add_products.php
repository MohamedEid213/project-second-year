<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

if($_SESSION['user_permissions'] == 'user'){
    header('location: /project_2/Home.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Products</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <link rel="stylesheet" href="/project_2/assets/css/style_add_product.css">
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="" id="add_product">
        <!-- محتوى الصفحة -->
        
            <div class="form_product">
                <h1>Add product</h1>
                <form action="" method="post">
                    <label for="name">Product Title</label>
                    <input type="text" id="name" name="" placeholder="Please enter the product name...">

                    <label for="picture">Product image</label>
                    <input type="file" id="picture" name="">

                    <label for="price">Product Price</label>
                    <input type="text" id="price" name="" placeholder="Please enter the product price...">

                    <label for="form_control">Product</label>
                    <select name="" id="form_control">
                        <option disabled selected>Select Category</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Clothing">Clothing</option>
                        <option value="Books">Books</option>
                        <option value="Toys">Toys</option>
                    </select>

                    <label for="details">Product Details</label>
                    <textarea rows="4" cols="50" id="details" name="" placeholder="Please enter the product details..."></textarea>

                    <button class="button" type="submit" name="">
                        Add Product
                    </button>
                </form>
            </div>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
</body>

</html>