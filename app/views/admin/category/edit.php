<?php include __DIR__ . "/../../header.php";
$url = $_SERVER['REQUEST_URI'];
$isEdit = str_contains($url, 'edit')?>

<div class="container">
    <h1 class="text-center"><?= $isEdit ? 'Edit' : 'Create' ?> Category</h1>
<a href="/api/product" class="btn btn-primary">Back</a>
    <form>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $isEdit ? $category->name : '' ?>">
        </div>
        <button id="save" type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script>
    document.getElementById('save').addEventListener('click', function (event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        editCategory(name);
    });

    async function editCategory(name) {
        $url = '<?= $isEdit ? '/api/product/editCategory/' . $category->id : '/api/product/createCategory' ?>';
        const response = await fetch('<?= $url ?>', {
            method: <?= $isEdit ? "'PUT'" : "'POST'" ?>,
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ name }),
        });
        if (response.ok) {
            window.location.href = '/api/product';
        } else {
            console.log('Error');
        }
    }
</script>

<?php $isEdit ? require __DIR__ . "/../products/index.php" : ''; ?>

<?php include __DIR__ . "/../../footer.php"; ?>