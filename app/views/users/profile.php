<?php include __DIR__ . "/../header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Profile</h1>
                    <p class="mb-2">Firstname: <?= $_SESSION['currentUser']->firstname ?></p>
                    <p class="mb-2">Lastname: <?= $_SESSION['currentUser']->lastname ?></p>
                    <p class="mb-2">Email: <?= $_SESSION['currentUser']->email ?></p>
                    <div class="text-center">
                        <a href="/user/edit" class="btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php include __DIR__ . "/../footer.php"; ?>