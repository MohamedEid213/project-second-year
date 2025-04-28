<?php
include('./register_post.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="/project_2/assets/css/style_regi.css">
    <link rel="icon"
        href="https://thumbs.dreamstime.com/z/secure-login-web-button-icon-vector-illustration-isolated-white-background-shadow-secure-login-web-button-119434393.jpg"
        type="image/x-icon">
</head>

<body>
    <div class="login-button">
        <a href="/project_2/index.php" class="login-link">Log In</a>
    </div>

    <section class="registration-container">
        <div class="registration-wapper">
            <div class="registration-header">
                <h2>Registration Here</h2>
                <p>Facebook helps you connect and share with the people in your life.</p>
            </div>

            <div class="registration-content">
                <div class="content-header">
                    <img src="https://th.bing.com/th/id/OIP.g7pCyO-Wp8LxA5oJII-b_QHaHa?rs=1&pid=ImgDetMain" alt="User Icon">
                    <h2>Create a new account</h2>
                    <p>It's quick and easy.</p>
                </div>

                <form method="POST">
                    <?php if (isset($errors['duplicate_error'])) {
                        echo $errors['duplicate_error'];
                    } ?>

                    <?php if (isset($errors['username_error'])) {
                        echo $errors['username_error'];
                    } ?>
                    <input type="text" name="username" placeholder="Username..." autofocus>

                    <?php if (isset($errors['gmail_error'])) {
                        echo $errors['gmail_error'];
                    } ?>
                    <input type="email" name="email" placeholder="Enter email...">

                    <?php if (isset($errors['password_error'])) {
                        echo $errors['password_error'];
                    } ?>
                    <input type="password" name="password" placeholder="Enter password...">

                    <div class="date-selection">

                        <?php if (isset($errors['date_error'])) {
                            echo $errors['date_error'];
                        } ?>

                        <label class="date-label">Date of birth:</label>
                        <div class="date-fields">
                            <select name="birthday_day" required>
                                <option disabled selected>Day</option>
                                <?php for ($day = 1; $day <= 31; $day++) echo "<option>$day</option>"; ?>
                            </select>

                            <select name="birthday_month" required>
                                <option disabled selected>Month</option>
                                <?php
                                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                                foreach ($months as $index => $month) echo "<option value='" . ($index + 1) . "'>$month</option>";
                                ?>
                            </select>

                            <select name="birthday_year" required>
                                <option disabled selected>Year</option>
                                <?php for ($year = date('Y'); $year >= 1970; $year--) echo "<option>$year</option>"; ?>
                            </select>
                        </div>
                    </div>

                    <div class="gender-selection">
                        <?php if (isset($errors['gender_error'])) {
                            echo $errors['gender_error'];
                        } ?>
                        <label>Gender:</label>
                        <div class="gender-options">
                            <label><input type="radio" name="gender" value="Female"> Female</label>
                            <label><input type="radio" name="gender" value="Male"> Male</label>
                            <label><input type="radio" name="gender" value="Custom" checked> Custom</label>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="register-button">Sign Up</button>
                </form>
            </div>
        </div>
    </section>
</body>

</html>