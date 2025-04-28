<style>
    .error_code {
        color: red;
        font-size: 15px;
        margin-top: 8px;
    }
</style>

<?php
session_start();

include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/vendor/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $username = strtolower(trim($_POST['username']));
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $UserName = mysqli_real_escape_string($conn, $username);
    $gmail = mysqli_real_escape_string($conn, $email);
    $hash_password = password_hash($password, PASSWORD_BCRYPT);

    $errors = [];
    $error = 0;
    if (!empty($_POST['birthday_year']) && !empty($_POST['birthday_month']) && !empty($_POST['birthday_day'])) {

        $birthday_day = (int) $_POST['birthday_day'];
        $birthday_month = (int) $_POST['birthday_month'];
        $birthday_year = (int) $_POST['birthday_year'];

        $year_now = date('Y');
        $min_birth_year = $year_now - 10;


        if ($birthday_year <= $min_birth_year && checkdate($birthday_month, $birthday_day, $birthday_year)) {
            $birthday = (new DateTime("$birthday_year-$birthday_month-$birthday_day"))->format("Y-m-d");
        } else {
            $error = 1;
            $errors['date_error'] = "<p class='error_code'>Invalid date of birth. You must be at least 12 years old.</p>";
        }
    } else {
        $error = 1;
        $errors['date_error'] = "<p class='error_code'>please choose birthday</p>";
    }

    if (!empty($_POST['gender'])) {
        $gender = strtolower(trim($_POST['gender']));
        if (in_array($gender, ['female', 'male', 'custom'])) {
            $gender = mysqli_real_escape_string($conn, $gender);
        } else {
            $error = 1;
            $errors['gender_error'] = "<p class='error_code'> Invalid gender, please enter a valid gender.</p>";
        }
    } else {
        $error = 1;
        $errors['gender_error'] = "<p class='error_code'> Please choose a valid gender..</p>";
    }



    if (empty($UserName) || strlen($UserName) < 2) {
        $error = 1;
        $errors['username_error'] = "<p class='error_code'>Invalid username, must be at least 6 characters long.</p>";
    }

    if (empty($password) || strlen($password) < 4) {
        $error = 1;
        $errors['password_error'] = "<p class='error_code'>Password must be at least 6 characters and contain both letters and numbers.</p>";
    }

    if (empty($gmail) || !filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $error = 1;
        $errors['gmail_error'] = "<p class='error_code'>Invalid email address, please enter a valid email.</p>";
    }



    if ($error == 0) {
        $check_sql = "SELECT id FROM users WHERE email='$gmail' OR name='$UserName'";
        $check_result = mysqli_query($conn, $check_sql);
        if (mysqli_num_rows($check_result) > 0) {
            $errors['duplicate_error'] = "<p class='error_code'>Username or Email already exists.</p>";
        } else {

            $sql = "INSERT INTO `users`(`name`,`password`,`email`,`gender`,`birthday`)
                VALUES ('$UserName','$hash_password','$gmail','$gender','$birthday') ";

            if (mysqli_query($conn, $sql)) {
                $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
                $query = mysqli_query($conn, $sql);
                $DataROW = mysqli_fetch_assoc($query);
                if ($DataROW) {
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
                    }
                }
            } else {
                $errors['register_error'] = '<p class="error_code">Database error, please try again.</p>';
            }
        }
    } else {
        $errors['register_error'] = '<p class="error_code">Try again.</p>';
    }
}

?>