const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector('.theme-toggler');
menuBtn.addEventListener('click',() =>  {
    sideMenu.style.display = 'block';
})
closeBtn.addEventListener('click',() => {
    sideMenu.style.display = 'none';
})
// Change themes
themeToggler.addEventListener('click',() => {
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('i:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('i:nth-child(2)').classList.toggle('active');
})

// Fix layout issue on resize
window.addEventListener('resize', () => {
    if (window.innerWidth > 768) {
        sideMenu.style.display = ''; // Reset inline style
    }
});