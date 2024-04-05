<?php include __DIR__ . "/../header.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-4 container">
            <h1 class="text-center">Profile</h1>
            <p class="">Firstname:
                <?= $_SESSION['currentUser']->firstname ?>
            </p>
            <p class="">Lastname:
                <?= $_SESSION['currentUser']->lastname ?>
            </p>
            <p class="">Email:
                <?= $_SESSION['currentUser']->email ?>
            </p>
        <div>
            <a href="/user/edit" class="btn btn-primary" id="edit">edit profile</a>
        </div>
        </div>

    </div>
    <?php include __DIR__ . "/../footer.php"; ?>