

function showProductCard(id) {
    let product = document.getElementById(id);
    let productCard = product.cloneNode(true);
    productCard.classList = "product-card";
    console.log(product, productCard)
    for (let el of productCard.querySelectorAll("*")) {
        el.classList = el.classList.toString().replace("product", "product-card");
    }
    let cartBtn = productCard.querySelector(".product-card__cart-button");
    cartBtn.classList.remove("unfilled-button");
    cartBtn.classList.add("filled-button");
    showPopup(productCard.outerHTML)
}
