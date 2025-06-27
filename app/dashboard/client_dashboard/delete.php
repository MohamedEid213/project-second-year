<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

if (isset($_GET['id'])) {
    $id = base64_decode($_GET['id']);

    $Delete_Products = "DELETE FROM `users` WHERE `id` = $id";
    $Query = mysqli_query($conn, $Delete_Products);
    header('location: /project_2/app/dashboard/client_dashboard.php');
    exit();
}
