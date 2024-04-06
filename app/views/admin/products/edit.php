<?php include __DIR__ . "/../../header.php";
$url = $_SERVER['REQUEST_URI'];
$isEdit = str_contains($url, 'edit') ?>

<div class="container">
    <a href="/api/product/editCategory/<?= $isEdit ? $product->category : $id ?>" class="btn btn-primary">Back</a>
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
                    <option value="<?= $category->id ?>" <?= $isEdit && $category->id == $product->category || $category->id == $id ? 'selected' : '' ?>>
                        <?= $category->name ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <?php if (isset($product->image) && $product->image !== ""): ?>
                <img src='<?= $product->image ?>' alt='<?= $product->image ?>' id="image_path"
                    style="width:500px;height:600px;">
                <button class="btn btn-danger" id="delete_image">Delete image</button>
            <?php endif ?>
            <div>
                <label class="mt-3" for="image">Image</label>
                <input type="file" name="image" id="image" accept="image/*">
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

    async function upload() {
        const image = document.getElementById('image').files[0];
        const imageElement = document.getElementById('image_path');

        if (imageElement && imageElement.src !== "" && !image) {
            return imageElement.src;
        }

        const formData = new FormData();
        formData.append('image', image);

        const url = '/admin/upload';
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
        });

        return response.text();
    }


    async function editProduct(name, description, price, category) {
        $url = '<?= $isEdit ? '/api/product/editProduct/' . $product->id : '/api/product/createProduct' ?>';
        const image = await upload();

        const response = await fetch('<?= $url ?>', {
            method: <?= $isEdit ? "'PUT'" : "'POST'" ?>,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name, description, image, price, category }),
        });
        if (response.ok) {
            window.location.href = '/api/product/editCategory/' + category;
        } else {
            console.log('Error');
        }
    }
    document.getElementById('delete_image').addEventListener('click', async (event) => {
    event.preventDefault();
    document.getElementById('image_path').remove();
  });
</script>

<?php include __DIR__ . "/../../footer.php"; ?>