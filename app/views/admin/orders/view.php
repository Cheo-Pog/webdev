<?php include __DIR__ . "/../../header.php"; ?>

<div class="container">
    <a href="/api/order" class="btn btn-primary">Back</a>
    <h1 class="text-center">Order Items</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orderItems as $item): ?>
                <tr id="item-<?= $item->id ?>">
                    <td>
                        <?= $item->id; ?>
                    </td>
                    <td>
                        <?= $item->productName; ?>
                    </td>
                    <td>
                        <?= $item->quantity; ?>
                    </td>
                    <td>
                        <?= $item->price; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/../../footer.php"; ?>