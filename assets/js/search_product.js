function search(){
    let searchBar = document.querySelector('.search-input').value.toUpperCase();
    let productList = document.querySelector('#product-list');
    let product = document.querySelectorAll('#product');
    let productName = document.getElementsByClassName('h2');


    for (let i = 0; i< productName.length; i++) {
        if(productName[i].innerHTML.toUpperCase().indexOf(searchBar) >= 0){
            product[i].style.display = "";
        } else {
            product[i].style.display = "none";
        }
    }
}