<?php include __DIR__ . "/../../header.php"; ?>
<div class="container">
    <a href="/admin" class="btn btn-primary">Back</a>
    <h1 class="text-center">Category</h1>
        <a href="/admin/catagory/create" class="btn btn-primary">Create</a>
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
                <tr>
                    <td>
                        <?php echo $category->id; ?>
                    </td>
                    <td>
                        <?php echo $category->name; ?>
                    </td>
                    <td>
                        <a href="/admin/catagory/update/<?php echo $category->id; ?>" class="btn btn-primary">Edit</a>
                        <a href="/admin/catagory/delete/<?php echo $category->id; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/../../footer.php"; ?>