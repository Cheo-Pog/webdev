<?php include __DIR__ . "/../header.php"; ?>

<div class="container">
    <h1>Dashboard</h1>
    <p>Welcome to the admin dashboard</p>
    <div class="mt-3">
        <a href="/api/user" class="btn btn-primary">Manage Users</a>
    </div>
    <div class="mt-3">
        <a href="/api/product" class="btn btn-primary">Manage Products</a>
    </div>
    <div class="mt-3">
        <a href="/api/order" class="btn btn-primary">View orders</a>
    </div>
</div>

<?php include __DIR__ . "/../footer.php"; ?>