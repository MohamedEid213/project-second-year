// Custom stars
const stars = document.querySelectorAll('.stars i');

// Loop through stars
stars.forEach((star, index1) => {
    star.addEventListener("click", () => {
        stars.forEach((star, index2) => {
            index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
        });
    });
});

// Character count for textarea
var count = document.getElementById('count'),
    textArea = document.getElementById('text'),
    maxLength = textArea.getAttribute('maxlength');

textArea.oninput = function () {
    if (count.innerHTML == 0) {
        count.classList.add('zero');
    } else {
        count.classList.remove('zero');
    }
}
// Get the search box and select element
const searchBox = document.getElementById('search-box');
const selectElement = document.getElementById('model-cars');

// Add an input event listener to the search box
searchBox.addEventListener('input', function () {
    const searchTerm = searchBox.value.toLowerCase(); // Get the search term in lowercase

    // Loop through all options in the select element
    Array.from(selectElement.options).forEach(option => {
        const optionText = option.text.toLowerCase(); // Get the option text in lowercase

        // Show or hide options based on the search term
        if (optionText.includes(searchTerm)) {
            option.style.display = 'block'; // Show the option
        } else {
            option.style.display = 'none'; // Hide the option
        }
    });

    // Show all optgroups and options if the search box is empty
    if (searchTerm === '') {
        Array.from(selectElement.options).forEach(option => {
            option.style.display = 'block'; // Show all options
        });
    }
});