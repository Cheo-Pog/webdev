<?php include __DIR__ . "/../header.php";
$subtotal = 0; ?>

<div class="container">
    <h1>Cart</h1>
    <div class="row">
        <div class="col-md-8 col-sm-12">
            <div class="table-responsive">
                <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cart as $item) {
                            $subtotal += $item->totalprice(); ?>
                            <tr id="product-<?= $item->id ?>">
                                <td>
                                    <?= $item->name ?>
                                </td>
                                <td>
                                    €
                                    <?= $item->price ?>
                                </td>
                                <td id="<?= $item->price ?>">
                                    <button value="minus" class="btn btn-primary quantity">-</button>
                                    <span class="quantity-value">
                                        <?= $item->quantity ?>
                                    </span>
                                    <button value="plus" class="btn btn-primary quantity">+</button>
                                </td>
                                <td id="total-<?= $item->id ?>">
                                    €
                                    <?= $item->totalprice() ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger remove" value="<?= $item->id ?>">Remove</button>
                                </td>
                            </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <h1>Order Summary</h1>
            <div class="row">
                <div class="col-6">
                    <p>Subtotal</p>
                </div>
                <div class="col-6" id="subtotal" value=<?= $subtotal ?>>
                    <p>€<?= $subtotal ?></p>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" id="checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let subtotal = parseFloat(<?= $subtotal ?>);

    document.getElementById('checkout').addEventListener('click', function (event) {
        event.preventDefault();
        checkout();
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('quantity')) {
            event.preventDefault();

            updateQuantity(event.target);
        }
    });

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove')) {
            event.preventDefault();

            removeFromCart(event.target.value);
        }
    });

    async function updateQuantity(button) {
        const type = button.value;
        const price = button.parentNode.id;
        const id = button.parentNode.parentNode.id.split('-')[1];
        const quantityElement = button.parentNode.querySelector('.quantity-value');
        let quantity = parseInt(quantityElement.textContent); // Get current quantity

        if (type === 'plus') {
            quantity++;
            subtotal += parseFloat(price); //doest work otherwise
        } else if (type === 'minus') {
            if (quantity < 2) {
                alert("If you want to remove a product, please press the 'REMOVE' button");
                return;
            }
            quantity--;
            subtotal -= price;
        }

        const response = await fetch('/cart/updateQuantity', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id,
                quantity,
            }),
        });

        document.getElementById('subtotal').innerHTML = '<p>€' + subtotal.toFixed(2) + '</p>'; // Update subtotal in HTML
        document.getElementById('total-' + id).innerHTML = '<p>€' + (price * quantity).toFixed(2) + '</p>'; // Update subtotal in HTML
        quantityElement.textContent = quantity; // Update quantity in HTML
    }

    async function checkout() {
        const response = await fetch('/cart/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                subtotal: subtotal
            }),
        });
        if (response.ok) {
            window.location.href = '/cart/success';
        } else {
            alert('cart not checked out');
        }
    }

    async function removeFromCart(id) {
        const price = document.getElementById('total-' + id).textContent.split('€')[1];
        const response = await fetch('/cart/removeFromCart', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id
            }),
        });
        if (response.ok) {
            subtotal -= price;
            document.getElementById('subtotal').innerHTML = '<p>€' + subtotal.toFixed(2) + '</p>';
            document.getElementById('product-' + id).remove();
        } else {
            alert('product not removed');
        }
    }
</script>

<?php include __DIR__ . "/../footer.php"; ?>