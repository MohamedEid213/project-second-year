<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/app/registration/registration_post.php');
$currentYear = date("Y");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Auto Repair Center</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Design System -->
    <link rel="stylesheet" href="/project_2/assets/css/design-system.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_regi.css">
</head>

<body>
    <!-- Background Elements -->
    <div class="auth-background">
        <div class="bg-gradient"></div>
        <div class="bg-glow bg-glow-1"></div>
        <div class="bg-glow bg-glow-2"></div>
    </div>

    <!-- Navigation -->
    <nav class="auth-nav">
        <a href="/project_2/index.php" class="auth-logo">
            <span class="logo-icon"><i class="fas fa-car"></i></span>
            <span class="logo-text">Auto<span>Repair</span></span>
        </a>
        <a href="/project_2/index.php" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i>
            Sign In
        </a>
    </nav>

    <!-- Main Content -->
    <main class="auth-container">
        <div class="auth-wrapper auth-wrapper-wide">
            <!-- Left Side - Branding -->
            <div class="auth-branding">
                <div class="branding-content">
                    <h1>Join Us Today</h1>
                    <p>Create your account to access premium auto repair services and exclusive member benefits.</p>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-calendar-check"></i></div>
                            <div class="feature-text">
                                <strong>Easy Booking</strong>
                                <span>Schedule services online anytime</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-history"></i></div>
                            <div class="feature-text">
                                <strong>Service History</strong>
                                <span>Track all your vehicle repairs</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-tags"></i></div>
                            <div class="feature-text">
                                <strong>Exclusive Discounts</strong>
                                <span>Member-only deals and offers</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-headset"></i></div>
                            <div class="feature-text">
                                <strong>Priority Support</strong>
                                <span>Get help when you need it</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Registration Form -->
            <div class="auth-form-container">
                <div class="auth-form-wrapper auth-form-wrapper-wide">
                    <div class="auth-form-header">
                        <div class="form-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h2>Create Account</h2>
                        <p>Fill in your details to get started</p>
                    </div>

                    <form method="post" class="auth-form">
                        <!-- Name Fields Row -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="first_name">
                                    <i class="fas fa-user"></i>
                                    First Name
                                </label>
                                <input 
                                    type="text" 
                                    name="first_name" 
                                    id="first_name" 
                                    class="form-input" 
                                    placeholder="John"
                                    required
                                >
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="last_name">
                                    <i class="fas fa-user"></i>
                                    Last Name
                                </label>
                                <input 
                                    type="text" 
                                    name="last_name" 
                                    id="last_name" 
                                    class="form-input" 
                                    placeholder="Doe"
                                    required
                                >
                            </div>
                        </div>

                        <!-- Email Field -->
                        <div class="form-group">
                            <label class="form-label" for="email">
                                <i class="fas fa-envelope"></i>
                                Email Address
                            </label>
                            <?php if (isset($errors['email_error'])): ?>
                                <div class="form-error"><?= $errors['email_error'] ?></div>
                            <?php endif; ?>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-input" 
                                placeholder="john.doe@example.com"
                                required
                            >
                        </div>

                        <!-- Password Field -->
                        <div class="form-group">
                            <label class="form-label" for="password">
                                <i class="fas fa-lock"></i>
                                Password
                            </label>
                            <?php if (isset($errors['pass_error'])): ?>
                                <div class="form-error"><?= $errors['pass_error'] ?></div>
                            <?php endif; ?>
                            <div class="password-input-wrapper">
                                <input 
                                    type="password" 
                                    name="password" 
                                    id="password" 
                                    class="form-input" 
                                    placeholder="Create a strong password"
                                    required
                                >
                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'password-icon')">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="form-group">
                            <label class="form-label" for="confirm_password">
                                <i class="fas fa-lock"></i>
                                Confirm Password
                            </label>
                            <?php if (isset($errors['pass2_error'])): ?>
                                <div class="form-error"><?= $errors['pass2_error'] ?></div>
                            <?php endif; ?>
                            <div class="password-input-wrapper">
                                <input 
                                    type="password" 
                                    name="confirm_password" 
                                    id="confirm_password" 
                                    class="form-input" 
                                    placeholder="Confirm your password"
                                    required
                                >
                                <button type="button" class="password-toggle" onclick="togglePassword('confirm_password', 'confirm-password-icon')">
                                    <i class="fas fa-eye" id="confirm-password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Date of Birth -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-calendar"></i>
                                Date of Birth
                            </label>
                            <div class="date-row">
                                <select name="day" class="form-select" required>
                                    <option value="">Day</option>
                                    <?php for ($i = 1; $i <= 31; $i++): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <select name="month" class="form-select" required>
                                    <option value="">Month</option>
                                    <?php 
                                    $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                                    foreach ($months as $index => $month): ?>
                                        <option value="<?= $index + 1 ?>"><?= $month ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <select name="year" class="form-select" required>
                                    <option value="">Year</option>
                                    <?php for ($i = $currentYear; $i >= $currentYear - 100; $i--): ?>
                                        <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-venus-mars"></i>
                                Gender
                            </label>
                            <div class="gender-row">
                                <label class="radio-card">
                                    <input type="radio" name="gender" value="male" required>
                                    <span class="radio-content">
                                        <i class="fas fa-mars"></i>
                                        Male
                                    </span>
                                </label>
                                <label class="radio-card">
                                    <input type="radio" name="gender" value="female" required>
                                    <span class="radio-content">
                                        <i class="fas fa-venus"></i>
                                        Female
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="form-group">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="terms" required>
                                <span class="checkmark"></span>
                                I agree to the <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="submit" class="btn btn-primary btn-lg w-full">
                            <i class="fas fa-user-plus"></i>
                            Create Account
                        </button>
                    </form>

                    <div class="auth-footer">
                        <p>Already have an account? <a href="/project_2/index.php">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('fa-eye');
                passwordIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('fa-eye-slash');
                passwordIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
