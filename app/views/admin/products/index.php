<div class="container">
    <h1 class="text-center">Products</h1>
    <a href="/api/product/createProduct/<?= $category->id ?>" class="btn btn-primary">Create</a>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th class="d-none d-lg-table-cell">Img</th>
                <th class="d-none d-lg-table-cell">Img path</th>
                <th>Price</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr id="product-<?= $product->id ?>">
                    <td><?= $product->id; ?></td>
                    <td><?= $product->name; ?></td>
                    <td><?= $product->description; ?></td>
                    <td class="d-none d-lg-table-cell"><img src="<?= $product->image; ?>" alt="<?= $product->name; ?>" style="max-width: 100px;"></td>
                    <td class="d-none d-lg-table-cell"><?= $product->image; ?></td>
                    <td><?= $product->price; ?></td>
                    <td><?= $product->category; ?></td>
                    <td>
                        <a href="/api/product/editProduct/<?= $product->id; ?>" class="btn btn-primary">Edit</a>
                        <button value="<?= $product->id ?>" class="btn btn-danger delete">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete')) {
            event.preventDefault();
            id = event.target.value;
            console.log(id);
            deleteProduct(id);
        }
    });

    async function deleteProduct(id) {
        const response = await fetch(`/api/product/deleteProduct/` + id, {
            method: 'DELETE',
        });
        if (response.ok) {
            document.getElementById('product-' + id).remove();
        }
    }
</script>

<?php include __DIR__ . "/../../footer.php"; ?>