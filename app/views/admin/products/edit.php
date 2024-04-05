<?php include __DIR__ . "/../../header.php";
$url = $_SERVER['REQUEST_URI'];
$isEdit = str_contains($url, 'edit') ?>

<div class="container">
    <a href="/api/product/editCategory/<?= $isEdit ? $product->category : $id?>" class="btn btn-primary">Back</a>
    <h1 class="text-center">
        <?= $isEdit ? 'Edit' : 'Create' ?> Product
    </h1>
    <form>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $isEdit ? $product->name : '' ?>">
        </div>
        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <input type="text" class="form-control" id="Description" name="Description"
                value="<?= $isEdit ? $product->description : '' ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" id="price" name="price"
                value="<?= $isEdit ? $product->price : '' ?>">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->id ?>" <?= $isEdit && $category->id == $product->category || $category->id == $id? 'selected' : '' ?>>
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button id="save" type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    document.getElementById('save').addEventListener('click', function (event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const Description = document.getElementById('Description').value;
        const price = document.getElementById('price').value;
        const category = document.getElementById('category').value;
        editProduct(name, Description, price, category);
    });

    async function editProduct(name, description, price, category) {
        $url = '<?= $isEdit ? '/api/product/editProduct/' . $product->id : '/api/product/createProduct' ?>';
        const response = await fetch('<?= $url ?>', {
            method: <?= $isEdit ? "'PUT'" : "'POST'" ?>,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name, description, price, category }),
        });
        if (response.ok) {
            window.location.href = '/api/product/editCategory/' + category;
        } else {
            console.log('Error');
        }
    }
</script>

<?php include __DIR__ . "/../../footer.php"; ?>