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
                                <td>
                                    <?= $item->quantity ?>
                                </td>
                                <td>
                                    €
                                    <?= $item->totalprice() ?>
                                </td>
                                <td>
                                    <button class="btn btn-danger remove" value="<?= $item->id ?>" id=<?= $item->price ?>>Remove</button>
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
                <div class="col-6" id="subtotal">
                    <p>€
                        <?= $subtotal ?>
                    </p>
                </div>
                <div class="col-12">
                    <button class="btn btn-primary" id="checkout">Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('checkout').addEventListener('click', function () {
        checkout();
    });

    async function checkout() {
        const response = await fetch('/cart/checkout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                subtotal: <?= $subtotal ?>
            }),
        });
        if (response.ok) {
            window.location.href = '/cart/success';
        } else {
            alert('cart not checked out');
        }
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove')) {
            event.preventDefault();
            
            price = event.target.id;
            removeFromCart(event.target.value, price);
        }
    });

    async function removeFromCart(id, price) {
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
            document.getElementById('subtotal').innerHTML = '<p>€' + (<?= $subtotal ?> - price) + '</p>';
            document.getElementById('product-' + id).remove();
        } else {
            alert('product not removed');
        }
    }
</script>

<?php include __DIR__ . "/../footer.php"; ?>