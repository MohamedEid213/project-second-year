<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// تحقق من صلاحية الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/index.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: /project_2/app/dashboard/service_dashboard.php');
    exit();
}

$id = intval($_GET['id']);

// جلب بيانات الخدمة
$query = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($query);

if (!$service) {
    header('Location: /project_2/app/dashboard/service_dashboard.php');
    exit();
}

// عند إرسال النموذج
if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['s_name']);
    $desc = mysqli_real_escape_string($conn, $_POST['s_description']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);
    $video = mysqli_real_escape_string($conn, $_POST['video']);

    $update = mysqli_query($conn, "UPDATE services SET 
        s_name = '$name',
        s_description = '$desc',
        status = '$status',
        image = '$image',
        video = '$video'
        WHERE service_id = $id
    ");

    header('Location: /project_2/app/dashboard/service_dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Service</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_dash_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: var(--color-background, #f6f6f9);
            color: var(--color-dark, #23233a);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 99%;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 14rem auto;
            gap: 1rem;
        }

        .edit-container {
            max-width: 480px;
            margin: 48px auto;
            background: var(--color-white, #fff);
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 #e0e0e0;
            padding: 36px 28px;
            transition: box-shadow 0.2s, background 0.2s;
        }

        .edit-container h2 {
            color: #6c63ff;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 22px;
            text-align: center;
        }

        .edit-form label {
            display: block;
            color: #6c63ff;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.08rem;
        }

        .edit-form input,
        .edit-form textarea,
        .edit-form select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1rem;
            margin-bottom: 18px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #f8fafd;
        }

        .edit-form textarea {
            resize: vertical;
            min-height: 80px;
        }

        .edit-form input:focus,
        .edit-form textarea:focus,
        .edit-form select:focus {
            border-color: #6c63ff;
            outline: none;
            box-shadow: 0 0 8px #6c63ff33;
        }

        .edit-form button[type="submit"] {
            background: linear-gradient(90deg, #6c63ff 0%, #43e97b 100%);
            color: #fff;
            border: none;
            padding: 12px 0;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            box-shadow: 0 2px 8px #6c63ff22;
        }

        .edit-form button[type="submit"]:hover {
            background: linear-gradient(90deg, #5548c8 0%, #43e97b 100%);
            box-shadow: 0 4px 16px #6c63ff33;
            transform: translateY(-2px) scale(1.04);
        }

        @media (max-width: 900px) {
            .container {
                grid-template-columns: 1fr;
            }

            .edit-container {
                margin: 24px auto;
            }
        }

        @media (max-width: 600px) {
            .edit-container {
                padding: 16px 6px;
            }

            .edit-container h2 {
                font-size: 1.2rem;
            }
        }

        /* Dark mode support */
        body.dark-theme-variables {
            --color-background: #181a1e;
            --color-white: #23233a;
            --color-dark: #f6f6f9;
        }

        body.dark-theme-variables .edit-container {
            background: var(--color-white, #23233a);
            box-shadow: 0 4px 24px 0 #0006;
        }

        body.dark-theme-variables .edit-form input,
        body.dark-theme-variables .edit-form textarea,
        body.dark-theme-variables .edit-form select {
            background: #23233a;
            color: #f6f6f9;
            border: 1px solid #444;
        }

        body.dark-theme-variables .edit-form label {
            color: #8b7cff;
        }

        body.dark-theme-variables .edit-form button[type="submit"] {
            background: linear-gradient(90deg, #8b7cff 0%, #43e97b 100%);
        }

        .back-btn-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 18px;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #23233a;
            text-decoration: none;
            font-weight: 700;
            border-radius: 24px;
            padding: 12px 28px;
            box-shadow: 0 2px 12px #ff980044;
            transition: background 0.2s, box-shadow 0.2s, transform 0.1s;
            font-size: 1.08rem;
            justify-content: center;
            border: none;
            outline: none;
        }

        .back-btn:hover {
            box-shadow: 0 4px 20px #ff980055;
            transform: translateY(-2px) scale(1.06);
            color: #23233a;
        }

        body.dark-theme-variables .back-btn {
            color: #fff;
            box-shadow: 0 2px 12px #0006;
        }

        body.dark-theme-variables .back-btn:hover {
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- هنا sidebar -->
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
        <!-- هنا نموذج التعديل -->
        <main>
            <div class="edit-container">

                <h2>Edit Service</h2>
                <form method="post" class="edit-form">
                    <label>Name:</label>
                    <input type="text" name="s_name" value="<?= htmlspecialchars($service['s_name']) ?>" required>
                    <label>Description:</label>
                    <textarea name="s_description" required><?= htmlspecialchars($service['s_description']) ?></textarea>
                    <label>Status:</label>
                    <select name="status">
                        <option value="actitive" <?= $service['status'] == 'actitive' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $service['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <label>Image (filename):</label>
                    <input type="text" name="image" value="<?= htmlspecialchars($service['image']) ?>">
                    <label>Video (filename):</label>
                    <input type="text" name="video" value="<?= htmlspecialchars($service['video']) ?>">
                    <button type="submit" name="submit">Save</button>
                    <div class="back-btn-wrapper">
                        <a href="/project_2/app/dashboard/service_dashboard.php" class="back-btn">
                            <i class="fas fa-arrow-left"></i> Back to Services
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>
    <script>
        // تفعيل الوضع الداكن تلقائياً إذا كان محفوظ في localStorage
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.body.classList.add('dark-theme-variables');
        } else {
            document.body.classList.remove('dark-theme-variables');
        }
    </script>
</body>

</html>