<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = "DELETE FROM products WHERE product_id = $id";
    mysqli_query($conn, $delete);
    header('location: /project_2/app/dashboard/product_dashboard.php');
    exit();
}
