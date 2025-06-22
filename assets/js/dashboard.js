const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");

menuBtn.addEventListener('click',() =>  {
    sideMenu.style.display = 'block';
})

closeBtn.addEventListener('click',() => {
    sideMenu.style.display = 'none';
})

function applyTheme(theme) {
    if (theme === 'dark') {
        document.body.classList.add('dark-theme-variables');
    } else {
        document.body.classList.remove('dark-theme-variables');
    }
}

// On page load, apply theme from localStorage
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    applyTheme(savedTheme);
}



// Fix layout issue on resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sideMenu.style.display = ''; // Reset inline style
    }
});