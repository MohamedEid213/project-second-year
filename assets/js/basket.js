document.querySelectorAll(".quantity-control").forEach(control => {
    const quantitySpan = control.querySelector(".quantity");
    const increaseBtn = control.querySelector(".increase");
    const decreaseBtn = control.querySelector(".decrease");

    increaseBtn.addEventListener("click", () => {
        let currentQuantity = parseInt(quantitySpan.textContent);
        quantitySpan.textContent = currentQuantity + 1;
    });

    decreaseBtn.addEventListener("click", () => {
        let currentQuantity = parseInt(quantitySpan.textContent);
        if (currentQuantity > 1) {
            quantitySpan.textContent = currentQuantity - 1;
        }
    });
});

// const delete_item = document.querySelector(".delete-item")
// const delete_card = document.querySelector(".showcase-container")

// delete_item.addEventListener("click" , () =>{
//     delete_card.classList.add("delete")
// })