
function search() {
    const input = document.querySelector('.search-input');
    const filter = input.value.toUpperCase();
    const productItems = document.querySelectorAll('.product-item');
    
    productItems.forEach(item => {
        const title = item.querySelector('.product-title').textContent.toUpperCase();
        const desc = item.querySelector('.product-desc').textContent.toUpperCase();
        
        if (title.includes(filter) || desc.includes(filter)) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    });
}