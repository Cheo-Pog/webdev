document.addEventListener('click', function (event) {
    if (event.target.classList.contains('add-btn')) {
        event.preventDefault();
        id = event.target.value;
        save(id);
    }
});


async function save(id) {
    const response = await fetch('cart/addToCart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            id
        }),
    });
    if (response.ok) {
        alert('Product added to cart');
    } else if (response.status === 401) {
        alert('Please login first');
    } else {
        alert('Product not added to cart');
    }
}