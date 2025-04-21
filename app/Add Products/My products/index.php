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
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="">
        <section class="container col-md-5 my-5 ">
            <h1 class="text-strat  fw-bold my-4">List Products
                <a href="/project_2/app/Add Products/add_products.php" class="btn btn-dark float-end p-2"><i class="fas fa-plus-circle "></i> Add Product</a>
            </h1>
            <div class="card shadow p-4">

                <table class="table table-dark table-striped">
                    <tr>
                        <th class="text-danger fs-4">id</th>
                        <th class="text-danger fs-4">Name</th>
                        <th class="text-danger fs-4" colspan="3">Actions</th>

                    </tr>

                    <?php foreach ($All_product as $product) : ?>
                        <tr>
                            <td> <?= $num++; ?> </td>
                            <td> <?= $product['product_name'] ?></td>

                            <td><a href="/project_2/app/Add Products/My products/show.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a href="/project_2/app/Add Products/My products/eidt.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td><a href="/project_2/app/Add Products/My products/delete.php?id=<?= base64_encode($product['product_id']) ?>"><i class="fa-solid fa-trash"></i></i></a></td>

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
</body>

</html>