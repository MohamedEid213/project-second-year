<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// تحقق من صلاحية الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/index.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $delete = mysqli_query($conn, "DELETE FROM services WHERE service_id = $id");
}

header('Location: /project_2/app/dashboard/service_dashboard.php');
exit();
