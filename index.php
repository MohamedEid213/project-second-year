<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/project_2/index_post.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Auto Repair Center</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    
    <!-- Design System -->
    <link rel="stylesheet" href="/project_2/assets/css/design-system.css">
    <link rel="stylesheet" href="/project_2/assets/css/style_login.css">
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
        <a href="/project_2/app/registration/registration.php" class="btn btn-primary">
            <i class="fas fa-user-plus"></i>
            Create Account
        </a>
    </nav>

    <!-- Main Content -->
    <main class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Side - Branding -->
            <div class="auth-branding">
                <div class="branding-content">
                    <h1>Welcome Back</h1>
                    <p>Sign in to access your account and manage your vehicle services with ease.</p>
                    
                    <div class="features-list">
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                            <div class="feature-text">
                                <strong>Secure Access</strong>
                                <span>Your data is protected with encryption</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-clock"></i></div>
                            <div class="feature-text">
                                <strong>24/7 Support</strong>
                                <span>We are always here to help you</span>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="feature-icon"><i class="fas fa-tools"></i></div>
                            <div class="feature-text">
                                <strong>Expert Service</strong>
                                <span>Professional auto repair services</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="auth-form-container">
                <div class="auth-form-wrapper">
                    <div class="auth-form-header">
                        <div class="form-icon">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h2>Sign In</h2>
                        <p>Enter your credentials to continue</p>
                    </div>

                    <form method="post" class="auth-form">
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
                                placeholder="Enter your email address"
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
                                    placeholder="Enter your password"
                                    required
                                >
                                <button type="button" class="password-toggle" onclick="togglePassword()">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Remember & Forgot -->
                        <div class="form-options">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="remember">
                                <span class="checkmark"></span>
                                Remember me
                            </label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" name="submit" class="btn btn-primary btn-lg w-full">
                            <i class="fas fa-sign-in-alt"></i>
                            Sign In
                        </button>
                    </form>

                    <div class="auth-footer">
                        <p>Don&apos;t have an account? <a href="/project_2/app/registration/registration.php">Create one</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('password-icon');
            
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
