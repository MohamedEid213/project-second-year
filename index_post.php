<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {

        $email = trim($_POST['email']);
        $password = $_POST['password'];

        $errors = [];
        $error = 0;

        // التحقق من صحة البريد الإلكتروني
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 1;
            $errors['email_error'] = "<p class='error_code'>Invalid email address, please enter a valid email.</p>";
        }

        // التحقق من صحة كلمة المرور
        if (strlen($password) < 6) {
            $error = 1;
            $errors['pass_error'] = "<p class='error_code'>Invalid password, must be at least 6 characters long.</p>";
        }

        if ($error == 0) {

            $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
            $query = mysqli_query($conn, $sql);
            $DataROW = mysqli_fetch_assoc($query);

            if ($DataROW) {
                // التحقق من كلمة المرور
                if (password_verify($password, $DataROW['password'])) {
                    $_SESSION['user_id'] = $DataROW['id'];
                    $_SESSION['email'] = $DataROW['email'];
                    $_SESSION['username'] = $DataROW['name'];
                    $_SESSION['ban'] = $DataROW['ban'];
                    $_SESSION['user_permissions'] = $DataROW['User_Permissions'];
                    $_SESSION['image_private'] = $DataROW['image_profile'];
                    $_SESSION['birthday'] = $DataROW['birthday'];
                    $_SESSION['gender'] = $DataROW['gender'];

                    header('Location:/project_2/Home.php');
                    exit();
                } else {
                    $errors['pass_error'] = "<p class='error_code'>Incorrect password, please try again.</p>";
                }
            } else {
                $errors['email_error'] = "<p class='error_code'>Email not found, please register first.</p>";
            }
        }
    }
}
