<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// تحقق من صلاحيات الأدمن
if (!isset($_SESSION['user_id']) || $_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/index.php');
    exit();
}

// استقبال معرف المستخدم
if (!isset($_GET['id'])) {
    die('User ID is required.');
}
$client_id = intval($_GET['id']);

// جلب بيانات المستخدم
$query = "SELECT u.id, u.name, u.email, u.User_Permissions, u.ban, u.image_profile
          FROM users u
          WHERE u.id = $client_id";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("SQL Error: " . mysqli_error($conn));
}

$client = mysqli_fetch_assoc($result);

if (!$client) {
    die('User not found or cannot edit admin.');
}

// عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_permissions = $_POST['User_Permissions'];
    $new_ban = $_POST['ban'];

    // تحقق من القيم المسموح بها فقط
    $allowed_permissions = ['user', 'moderator'];
    $allowed_ban = ['0', '1'];

    if (in_array($new_permissions, $allowed_permissions) && in_array($new_ban, $allowed_ban)) {
        $update = "UPDATE users SET  User_Permissions='$new_permissions', ban='$new_ban' WHERE id=$client_id";
        $update_result = mysqli_query($conn, $update);
        if ($update_result) {
            $success = "User updated successfully.";
            // تحديث بيانات المستخدم بعد التعديل
            $client['User_Permissions'] = $new_permissions;
            $client['ban'] = $new_ban;
            header('location: /project_2/app/dashboard/client_dashboard.php');
            exit();
        } else {
            $error = "Failed to update user.";
        }
    } else {
        $error = "Invalid input values.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit User Permissions</title>
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_client_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .edit-form-container {
            max-width: 420px;
            margin: 2.5rem auto 0 auto;
            background: var(--color-white);
            padding: 2.5rem 2rem 2rem 2rem;
            border-radius: var(--card-border-radius);
            box-shadow: var(--box-shadow);
        }

        .edit-form-container h2 {
            margin-bottom: 1.5rem;
            text-align: center;
            color: #6c63ff;
        }

        .edit-form-container label {
            display: block;
            margin-top: 1.2rem;
            margin-bottom: 0.5rem;
            color: var(--color-dark);
            font-weight: 600;
        }

        .edit-form-container select,
        .edit-form-container input {
            width: 100%;
            padding: 0.7rem;
            border-radius: var(--border-radius-2);
            border: 1px solid var(--color-light);
            background: var(--color-white);
            color: var(--color-dark);
            font-size: 1rem;
            margin-bottom: 0.5rem;
        }

        .edit-form-container button {
            margin-top: 1.5rem;
            width: 100%;
            background: var(--primary-color);
            color: #fff;
            font-weight: 700;
            border-radius: var(--border-radius-2);
            padding: 0.9rem;
            font-size: 1.1rem;
            border: none;
            cursor: pointer;
            transition: background 0.2s;
        }

        .edit-form-container button:hover {
            background: #5548c8;
        }

        .msg-success {
            color: #28a745;
            margin-top: 1rem;
            text-align: center;
        }

        .msg-error {
            color: #dc3545;
            margin-top: 1rem;
            text-align: center;
        }

        .profile-bar-edit {
            display: flex;
            align-items: center;
            gap: 1.2rem;
            margin-bottom: 2rem;
            justify-content: center;
        }

        .profile-bar-edit .profile-photo {
            width: 3.5rem;
            height: 3.5rem;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid var(--primary-color);
        }

        .profile-bar-edit .profile-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-bar-edit .info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .profile-bar-edit .info p {
            margin: 0;
            font-size: 1.1rem;
            color: var(--color-dark);
        }

        .profile-bar-edit .info small {
            color: var(--color-info-dark);
        }

        @media (max-width: 900px) {
            #clients_page_layout .container {
                grid-template-columns: 1fr;
            }
        }

        .dark-theme-variables {
            --color-background: #181a1e;
            --color-white: #202528;
            --color-dark: #edeffd;
            --color-light: rgba(0, 0, 0, 0.4);
            --color-primary-variant: #a3bdcc;
            /* ... */
        }
    </style>
</head>

<body id="clients_page_layout">
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>
        <main>
            <!-- Profile Bar -->
            <div class="profile-bar-edit">
                <div class="profile-photo">
                    <img src="/project_2/assets/image/image_users/<?= htmlspecialchars($client['image_profile']) ?>" alt="Profile">
                </div>
                <div class="info">
                    <p><b><?= htmlspecialchars($client['name']) ?></b></p>
                    <small><?= htmlspecialchars($client['email']) ?></small>
                </div>
            </div>
            <!-- Edit Form -->
            <div class="edit-form-container">
                <h2>Edit User</h2>
                <?php if (isset($success)): ?>
                    <div class="msg-success"><?= $success ?></div>
                <?php elseif (isset($error)): ?>
                    <div class="msg-error"><?= $error ?></div>
                <?php endif; ?>
                <form method="post">
                    <label for="User_Permissions">Permissions:</label>
                    <select name="User_Permissions" id="User_Permissions" required>
                        <option value="user" <?= $client['User_Permissions'] == 'user' ? 'selected' : '' ?>>User</option>
                        <option value="moderator" <?= $client['User_Permissions'] == 'moderator' ? 'selected' : '' ?>>Moderator</option>
                    </select>

                    <label for="ban">Status:</label>
                    <select name="ban" id="ban" required>
                        <option value="0" <?= $client['ban'] == 0 ? 'selected' : '' ?>>Active</option>
                        <option value="1" <?= $client['ban'] == 1 ? 'selected' : '' ?>>Banned</option>
                    </select>

                    <button type="submit">Save Changes</button>
                </form>
                <a href="/project_2/app/dashboard/client_dashboard.php" style="display:block;text-align:center;margin-top:1rem;">Back to Clients</a>
            </div>
        </main>
    </div>

    <script>
        // تفعيل الوضع الداكن أو الفاتح تلقائياً حسب localStorage
        const theme = localStorage.getItem('theme');
        if (theme === 'dark') {
            document.body.classList.add('dark-theme-variables');
        } else {
            document.body.classList.remove('dark-theme-variables');
        }
    </script>
</body>

</html>