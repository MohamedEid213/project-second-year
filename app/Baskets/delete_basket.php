<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $Delete_Basket = "DELETE FROM `basket` WHERE `basket_id` = $id";
    $Query = mysqli_query($conn, $Delete_Basket);
    header('location: /project_2/app/Baskets/basket.php');
    exit();
}
