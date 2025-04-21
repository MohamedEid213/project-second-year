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

        $Show_Products = "SELECT * FROM `products` WHERE `product_id` = $id";
        $Query = mysqli_query($conn, $Show_Products);
        $Row = mysqli_fetch_assoc($Query);

        $Select_Category = 'SELECT * FROM `categories` ORDER BY c_name';
        $All_Category = mysqli_query($conn, $Select_Category);

        $Select_Brands = 'SELECT * FROM `brands` ORDER BY b_name';
        $All_Brands = mysqli_query($conn, $Select_Brands);



        if (isset($_POST['eidt'])) {
            $eidt = $_POST['eidt'];
            $Update_Product = "UPDATE `products` SET `title`='$eidt' WHERE `id` = $id";
            $Query = mysqli_query($conn, $Update_Product);
            header('location: /project_2/app/Add Products/My products/index.php');
            exit();
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Eidt</title>
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    </head>

    <body>
        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
        ?>

        <main class="">
            <section class="container col-md-5 my-5 ">
                <h1 class="text-strat  fw-bold my-4">Edit Department
                    <a href="/project_2/app/Add Products/My products/index.php" class="btn btn-dark float-end"> List Department</a>
                </h1>
                <form action="" method="post">

                    <div class="card shadow p-4 bg-dark text-light">
                        <label for="form_control">Name</label>
                        <input type="text" name="eidt" value="<?= $Row['product_name'] ?>" class="fw-bold py-2">


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

                        <button class="btn btn-primary mt-4 ">Eidt</button>
                    </div>


                </form>
            </section>
        </main>

        <?php
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
        include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
        ?>
    </body>

    </html>