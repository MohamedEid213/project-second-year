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


$id = $_SESSION['user_id'];
$email = $_SESSION['email'];

$Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
$All_Category = mysqli_query($conn, $Select_Category);

$Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
$All_Brands = mysqli_query($conn, $Select_Brands);

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
        $image_extansions = strtolower(end(explode('.', $image_name)));

        if ($image_errors == 4) {
            $errors[] = '<div>No File Uploaded</div>';
        } else {
            if (!in_array($image_extansions, $allowed_extansions)) {
                $errors[] = '<div> File is Not Valid </div>';
            }


            $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/project_2/data/uploads/image_products/';
            $target_file = $upload_dir . basename($image_name);
            move_uploaded_file($image_temp, $target_file);


            $Row_Data = "INSERT INTO `products`( `product_name`, `model_year`, `Images`, `price`, `Category_id`, `Brand_id`, `description`) 
        VALUES ('$name','$model_year','$image_name','$price','$category','$brand','$descript')";
            $Add_Product = mysqli_query($conn, $Row_Data);
            header('location: /project_2/app/categories/category.php');
        }
    }
}
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

    <main class="">
        <!-- محتوى الصفحة -->
        <section class="my-4" id="add_product">
            <div class="header_product">
                <h1>Add product</h1>
                <a href="/project_2/app/Add Products/My products/index.php" class="btn btn-dark p-2 "> <i class="fas fa-list me-2"></i> List Products</a>
            </div>
            <div class="form_product">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row justify-content-between">
                        <nav class="col-8">
                            <label class="text-start" for="name">Product Name</label>
                            <input type="text" id="name" name="name" placeholder="product name..." require>
                        </nav>
                        <nav class="col-4">
                            <label for="price">Price</label>
                            <input type="number" id="price" name="price" placeholder="price..." require>
                        </nav>
                        <nav class="col-8">
                            <label for="image">Product image</label>
                            <input type="file" id="image" name="image">
                        </nav>
                        <nav class="col-4">
                            <label for="model_year">Model Year </label>
                            <input type="number" class="form-control" id="model_year" name="model_year" min="1900" max="<?= date('Y') + 1 ?>" placeholder="potional">
                        </nav>
                    </div>

                    <label for="form_control">Choose of Category</label>
                    <select name="category" id="form_control">
                        <?php foreach ($All_Category as $category) : ?>
                            <option class="fw-bold" value="<?= $category['category_id'] ?>"> <?= $category['C_name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <label for="form_control">Choose of Brand</label>
                    <select name="brand" id="form_control">
                        <?php foreach ($All_Brands as $brand) : ?>
                            <option class="fw-bold" value="<?= $brand['brand_id'] ?>"> <?= $brand['b_name'] ?></option>
                        <?php endforeach ?>
                    </select>

                    <label for="details">Product Details</label>
                    <textarea rows="4" cols="50" id="details" name="descript" placeholder="Please enter the product details..." require></textarea>
                    <button class="button" type="submit" name="submit">
                        <i class="fas fa-plus-circle me-2"></i> Add Product
                    </button>
                </form>
            </div>
        </section>
    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
</body>

</html>