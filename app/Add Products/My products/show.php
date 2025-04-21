
    <?php
    session_start();
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

    // التحقق من تسجيل الدخول
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
        header('location: ./index.php');
        exit();
    }

    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);

        $Show = "SELECT * FROM `products` WHERE `product_id` = $id";
        $Query = mysqli_query($conn, $Show);
        $Row = mysqli_fetch_assoc($Query);
    }

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

        <main class="">
            <section class="container col-md-5 my-5 ">
                <h1 class="text-strat  fw-bold my-4">Show Department
                    <a href="./index.php" class="btn btn-dark float-end"> List Department</a>
                </h1>
                <div class="card shadow p-4 bg-dark text-light">

                    <h3 class="text-center "><label class="me-4">Name: </label><?= $Row['product_name'] ?></h3>
                    <h3 class="text-center "><label class="me-4">Model Year: </label><?= $Row['model_year'] ?></h3>
                    <h3 class="text-center "><label class="me-4">Price: </label><?= $Row['price'] ?></h3>
                    <h3 class="text-center "><label class="me-4">Description: </label><?= $Row['description'] ?></h3>

                </div>
            </section>

        </main>

        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
        ?>
    </body>

    </html>