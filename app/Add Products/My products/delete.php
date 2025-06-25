<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $Delete_Products = "DELETE FROM `products` WHERE `product_id` = $id";
    $Query = mysqli_query($conn, $Delete_Products);
    header('location: /project_2/app/Add Products/My products/index.php');
    exit();
}
