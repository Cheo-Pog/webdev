<?php include __DIR__ . "/../../header.php"; ?>

<div class="container">
    <a href="/admin" class="btn btn-primary">Back</a>  
    <h1 class="text-center">Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>User Email</th>
                <th>Total price</th>
                <th>Order Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr id="order-<?= $order->id ?>">
                    <td>
                        <?= $order->id; ?>
                    </td>
                    <td>
                        <?= $order->email; ?>
                    </td>
                    <td>
                        <?= $order->totalPrice; ?>
                    </td>
                    <td>
                        <?= $order->orderDate; ?>
                    <td>
                        <a href="/api/order/view/<?= $order->id; ?>" class="btn btn-primary">View items</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/../../footer.php"; ?>