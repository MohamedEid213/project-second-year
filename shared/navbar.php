<!-- Start Header -->
<header id="header">
    <div class="header">
        <div class="header-container">
            <!-- Mobile Menu Toggle -->
            <button onclick="toggleSidebar()" id="toggle-btn" class="mobile-menu-btn" aria-label="Toggle menu">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <!-- Logo -->
            <a href="/project_2/Home.php" class="logo">
                <span class="logo-icon">
                    <i class="fas fa-car"></i>
                </span>
                <span class="logo-text">Auto<span class="logo-accent">Repair</span></span>
            </a>
            
            <!-- Main Navigation -->
            <nav class="main-nav">
                <a href="/project_2/Home.php" class="nav-link">
                    <i class="fas fa-home"></i>
                    <span>Home</span>
                </a>
                <a href="/project_2/app/servicess/services.php" class="nav-link">
                    <i class="fas fa-wrench"></i>
                    <span>Services</span>
                </a>
                <a href="/project_2/app/categories/category.php" class="nav-link">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
                <a href="/project_2/app/about/about.php" class="nav-link">
                    <i class="fas fa-info-circle"></i>
                    <span>About</span>
                </a>
                <a href="/project_2/app/contact/contact.php" class="nav-link">
                    <i class="fas fa-envelope"></i>
                    <span>Contact</span>
                </a>
            </nav>
            
            <!-- Right Actions -->
            <div class="header-actions">
                <a href="/project_2/app/Baskets/basket.php" class="action-btn cart-btn" aria-label="Shopping cart">
                    <i class="fas fa-shopping-cart"></i>
                    <?php if(isset($cart_items_count) && $cart_items_count > 0): ?>
                    <span class="cart-badge"><?= $cart_items_count ?></span>
                    <?php endif; ?>
                </a>
                <a href="/project_2/app/Profiles/profile.php" class="action-btn" aria-label="User profile">
                    <i class="fas fa-user"></i>
                </a>
                <a href="/project_2/app/log_out/out.php" class="action-btn logout-btn" aria-label="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
    </div>
</header>
<!-- End Header -->
