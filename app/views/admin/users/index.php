<?php include __DIR__ . "/../../header.php"; ?>

<div class="container">
    <a href="/admin" class="btn btn-primary">Back</a>
    <h1 class="text-center">Users</h1>
    <a href="/admin/catagory/create" class="btn btn-primary">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Email</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>rank</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr id="user-<?= $user->id ?>">
                    <td>
                        <?= $user->id; ?>
                    </td>
                    <td>
                        <?= $user->email; ?>
                    </td>
                    <td>
                        <?= $user->firstname; ?>
                    </td>
                    <td>
                        <?= $user->lastname; ?>
                    </td>
                    <td>
                        <?= $user->rank; ?>
                    </td>
                    <td>
                        <a href="/api/user/edit/<?= $user->id; ?>" class="btn btn-primary">Edit</a>
                        <button value="<?= $user->id ?>" class="btn btn-danger delete">Delete</button>
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
            deleteUser(id);
        }
    });

    async function deleteUser(id) {
        const response = await fetch(`/api/user/delete/${id}`, {
            method: 'DELETE',
        });
        if (response.ok) {
            document.getElementById('user-' + id).remove();
        }
    }
</script>

<?php include __DIR__ . "/../../footer.php"; ?>