<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/index_post.php');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/project_2/assets/css/style_login.css">
    <link rel="stylesheet" 
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <title>Login</title>
    <style>
        .error_code {
            color: red;
            font-size: 15px;
            margin-top: 8px;
            margin-bottom: 5px;

        }
    </style>

</head>

<body>
    <nav class="nav_link">
        <a class="nav_button" href="/project_2/app/registration/registration.php">Registration</a>
    </nav>
    <main>
        <form method='post'>

            <div class="login_container">
                <div class="login_content">
                    <nav class="login_header">
                        <h2>Log In Here</h2>
                        <p>Facebook helps you connect and share with the people in your life.</p>
                    </nav>
                    <div class="login_inputs">
                        <nav>
                            <img src="https://th.bing.com/th/id/OIP.g7pCyO-Wp8LxA5oJII-b_QHaHa?rs=1&pid=ImgDetMain" alt="User Image">
                        </nav>
                        <?php if (isset($errors['email_error'])) {
                            echo $errors['email_error'];
                        } ?>

                        <nav>
                            <input type="email" name='email' id="username" placeholder="Please enter gmail...">
                        </nav>
                        <nav>
                            <?php if (isset($errors['pass_error'])) {
                                echo $errors['pass_error'];
                            } ?>

                            <input type="password" id="password" name="password" placeholder="Please enter password...">
                        </nav>
                        <nav class="login_button_container">
                            <button name='submit'>Log In</button>
                        </nav>
                    </div>
                </div>
            </div>
        </form>
    </main>
</body>

</html>