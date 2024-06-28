async function addToCart(id) {
    await fetch(`/cart/add/${id}`);
}