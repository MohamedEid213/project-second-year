<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول وصلاحية الأدمن
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: /project_2/index.php');
    exit();
}
if ($_SESSION['user_permissions'] != 'admin') {
    header('location: /project_2/Home.php');
    exit();
}

$username = $_SESSION['username'];

// جلب جميع بيانات المستخدمين باستثناء كلمة المرور
$query = "SELECT u.id, u.name, u.email, u.gender, u.birthday, u.User_Permissions, u.ban, u.image_profile,
                 (SELECT phone FROM phone WHERE user_id = u.id LIMIT 1) as phone
          FROM users u
          WHERE u.User_Permissions IN ('user', 'moderator')
          ORDER BY u.name ASC";
$result = mysqli_query($conn, $query);

$clients = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients Management</title>

    <!-- Main CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/dashboard.css">
    <!-- Page-specific CSS -->
    <link rel="stylesheet" href="/project_2/assets/css/style_client_dashboard.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=grid_view" />
    <link rel="stylesheet" href="../fontawesome-free-6.6.0-web/webfonts">

    <style>
        /* شكل pill للـ Permissions */
        .clients-table .permission-pill {
            padding: 0.3rem 0.8rem;
            border-radius: 1rem;
            font-weight: 600;
            font-size: 0.8rem;
            text-align: center;
            display: inline-block;
            background-color: #f3f3f3;
            color: #555;
            border: 1px solid #e0e0e0;
            letter-spacing: 0.5px;
            transition: background 0.2s, color 0.2s;
        }

        .clients-table .permission-user {
            background-color: #e3f6ff;
            color: #0d6efd;
            border-color: #b6e0fe;
        }

        .clients-table .permission-moderator {
            background-color: #fffbe6;
            color: #eab308;
            border-color: #ffe58f;
        }

        .clients-table .permission-admin {
            background-color: #e8f9f0;
            color: #28a745;
            border-color: #b7f7d8;
        }

        .improved-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            background: linear-gradient(90deg, #6c63ff 0%, #43e97b 100%);
            color: #fff !important;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 0.85rem 2.1rem;
            border-radius: 2rem;
            box-shadow: 0 4px 16px rgba(108, 99, 255, 0.13);
            border: none;
            outline: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.18s, box-shadow 0.18s;
            text-decoration: none;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .improved-btn i {
            font-size: 1.2rem;
            margin-right: 0.2rem;
        }

        .improved-btn:hover,
        .improved-btn:focus {
            background: linear-gradient(90deg, #43e97b 0%, #6c63ff 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 24px rgba(108, 99, 255, 0.18);
            color: #fff;
            text-decoration: none;
        }
    </style>

</head>

<body id="clients_page_layout" class="dark-theme-variables"> <!-- Unique ID to prevent CSS conflicts -->
    <div class="container">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar_dashboard.php'); ?>

        <main>
            <!-- Top Bar inside Main Content -->
            <div class="main-top-bar">
                <div class="profile">
                    <div class="info">
                        <p>Hey, <b><?php echo htmlspecialchars($username); ?></b></p>
                        <small class="text-muted">User</small>
                    </div>
                    <div class="profile-photo">
                        <img src="/project_2/assets/image/photo_dashboard/profile-1.jpg" alt="User Avatar">
                    </div>
                </div>
            </div>

            <!-- Page Header -->
            <div class="clients-page-header">
                <h1>Clients</h1>
                <p>Manage your client relationships and track business performance</p>
            </div>

            <!-- Action Bar -->
            <div class="clients-actions">
                <div class="search-bar">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Search clients...">
                </div>
                <div class="action-buttons">
                    <select name="status" id="status-filter">
                        <option value="all">All Status</option>
                        <option value="active">Active</option>
                        <option value="pending">Pending</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    <a href="/project_2/app/registration/registration.php" class="add-client-btn improved-btn">
                        <i class="fas fa-plus"></i>
                        Add Client
                    </a>
                </div>
            </div>

            <!-- Clients List Table -->
            <div class="clients-list-container">

                <table class="clients-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Birthday</th>
                            <th>Permissions</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Profile</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($clients) > 0): ?>
                            <?php foreach ($clients as $client): ?>
                                <tr>
                                    <td><?= htmlspecialchars($client['id']) ?></td>
                                    <td><?= htmlspecialchars($client['name']) ?></td>
                                    <td><?= htmlspecialchars($client['email']) ?></td>
                                    <td><?= htmlspecialchars($client['gender']) ?></td>
                                    <td><?= htmlspecialchars($client['birthday']) ?></td>
                                    <td>
                                        <?php
                                        $perm = strtolower($client['User_Permissions']);
                                        $permClass = "permission-pill permission-$perm";
                                        echo "<span class='$permClass'>" . ucfirst($client['User_Permissions']) . "</span>";
                                        ?>
                                    </td>
                                    <td><?= htmlspecialchars($client['phone'] ?? 'N/A') ?></td>
                                    <td>
                                        <span class="status <?= $client['ban'] == 0 ? 'status-active' : 'status-inactive' ?>">
                                            <?= $client['ban'] == 0 ? 'Active' : 'Inactive' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <img src="/project_2/assets/image/image_users/<?= htmlspecialchars($client['image_profile']) ?>" alt="Profile" width="28" style="border-radius:50%;">
                                    </td>
                                    <td class="action-cell">
                                        <a class="action-btn edit" href="client_dashboard/edit.php?id=<?= $client['id'] ?>">Edit</a>
                                        <a href="" class="action-btn delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="10">No clients found.</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </main>
    </div>


</body>

</html>