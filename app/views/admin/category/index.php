<?php include __DIR__ . "/../../header.php"; ?>
<div class="container">
    <a href="/admin" class="btn btn-primary">Back</a>
    <h1 class="text-center">Category</h1>
    <a href="/api/product/createCategory" class="btn btn-primary">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr id="category-<?= $category->id ?>">
                    <td>
                        <?= $category->id; ?>
                    </td>
                    <td>
                        <?= $category->name; ?>
                    </td>
                    <td>
                        <a href="/api/product/editCategory/<?= $category->id; ?>" class="btn btn-primary">Edit</a>
                        <button value="<?= $category->id ?>" class="btn btn-danger delete">Delete</button>
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
        const response = await fetch(`/api/product/deleteCategory/` + id, {
            method: 'DELETE',
        });
        if (response.ok) {
            document.getElementById('category-' + id).remove();
        }
    }
</script>

<?php include __DIR__ . "/../../footer.php"; ?>