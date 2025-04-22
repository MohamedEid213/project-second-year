<!-- تجهيذ افتراضي لي الصفحه -->


<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
    header('location: ./index.php');
    exit();
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$permissions = $_SESSION['user_permissions'];
$gender = $_SESSION['gender'];
$birthday = $_SESSION['birthday'];
$image = $_SESSION['image_private'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/header.php'); ?>
    <title>Profile</title>
    <link rel="stylesheet" href="/project_2/assets/css/style_profile.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>

</head>

<body>
    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/navbar.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/sidebar.php');
    ?>

    <div class="profile-container">
        <div class="profile-header">
            <button class="edit-btn">
                <i class="fas fa-pen"></i>
            </button>
            <img src="/project_2/assets/image/image_users/<?= $image ?>" alt="Profile" class="profile-avatar">
            <h1 class="profile-name"><?= $username ?></h1>
            <div class="profile-title"><?= $permissions ?></div>
            <div class="profile-social">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>

        <div class="profile-content">
            <div class="profile-tabs">
                <div class="tab active" data-tab="about">About</div>
                <div class="tab" data-tab="activity">Activity</div>
                <div class="tab" data-tab="settings">Settings</div>
            </div>

            <div class="tab-content active" id="about">
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?= $email ?></div>
                    </div>

                    <div class="info-card">
                        <div class="info-label">Birthday</div>
                        <div class="info-value"><?= $birthday ?></div>
                    </div>

                    <div class="info-card">
                        <div class="info-label">Gender</div>
                        <div class="info-value"><?= $gender ?></div>
                    </div>

                    <div class="info-card">
                        <div class="info-label">Member Since</div>
                        <div class="info-value">Jan 2023</div>
                    </div>
                </div>

                <h3 style="margin: 2rem 0 1rem;">Statistics</h3>
                <div class="stats-container">
                    <div class="stat-card">
                        <div class="stat-value">142</div>
                        <div class="stat-label">Orders</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">87%</div>
                        <div class="stat-label">Success Rate</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">4.9</div>
                        <div class="stat-label">Rating</div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="activity">
                <p style="text-align: center; padding: 2rem; color: var(--text-light);">User activity will appear here</p>
            </div>

            <div class="tab-content" id="settings">
                <p style="text-align: center; padding: 2rem; color: var(--text-light);">Account settings will appear here</p>
            </div>
        </div>
    </div>

    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                // Remove active class from all tabs and contents
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Add active class to clicked tab and corresponding content
                tab.classList.add('active');
                const tabId = tab.getAttribute('data-tab');
                document.getElementById(tabId).classList.add('active');
            });
        });

    </script>

    <?php
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/footer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/shared/script.php');
    ?>
</body>

</html>