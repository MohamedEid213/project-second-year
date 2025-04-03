<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}
$ban = $_SESSION['ban'];
$permissions = $_SESSION['user_permissions'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <main class="container">
        <!-- محتوى الصفحة -->
        <?= "<h1>$ban</h1>" ?>
        <?= "<h1>$username</h1>" ?>
        <?= "<h1>$permissions</h1>" ?>
        <?= "<h1>$email</h1>" ?>


    </main>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
</body>

</html>