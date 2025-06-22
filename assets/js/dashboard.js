const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// --- Side Menu Logic ---
if (menuBtn) {
    menuBtn.addEventListener('click', () => {
        sideMenu.style.display = 'block';
    });
}

if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        sideMenu.style.display = 'none';
    });
}

// --- Theme Toggler Logic ---
function applyTheme(isDark) {
    if (isDark) {
        document.body.classList.add('dark-theme-variables');
        if (themeToggler) {
            themeToggler.querySelector('.fa-sun').classList.remove('active');
            themeToggler.querySelector('.fa-moon').classList.add('active');
        }
    } else {
        document.body.classList.remove('dark-theme-variables');
        if (themeToggler) {
            themeToggler.querySelector('.fa-sun').classList.add('active');
            themeToggler.querySelector('.fa-moon').classList.remove('active');
        }
    }
}

if (themeToggler) {
    themeToggler.addEventListener('click', () => {
        const isDarkMode = document.body.classList.toggle('dark-theme-variables');
        
        // Toggle icons
        themeToggler.querySelector('.fa-sun').classList.toggle('active', !isDarkMode);
        themeToggler.querySelector('.fa-moon').classList.toggle('active', isDarkMode);

        // Save theme to localStorage
        localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
    });
}

// On page load, apply theme from localStorage
document.addEventListener('DOMContentLoaded', () => {
    const savedTheme = localStorage.getItem('theme');
    applyTheme(savedTheme === 'dark');
});


// Fix layout issue on resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && sideMenu) {
        sideMenu.style.display = ''; // Reset inline style
    }
});