<?php include __DIR__ . "/../header.php";
$url = $_SERVER['REQUEST_URI'];
$isApi = str_contains($url, 'api');
?>

<div class="container">
    <form id="profile-form">
        <div class="mb-3">
            <label for="firstname" class="form-label">Firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->firstname ?>">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->lastname ?>">
        </div>
        <?php if (!$isApi): ?>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="optional">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Current password</label>
                <input type="password" class="form-control" id="CPassword" name="password">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Repeat current password</label>
                <input type="password" class="form-control" id="CRPassword" name="password">
            </div>
        <?php endif; ?>
        <?php if ($isApi): ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user->email ?>">
            </div>
            <div class="mb-3">
                <label for="rank" class="form-label">Rank</label>
                <select class="form-select" id="rank" name="rank">
                    <option value="1" <?= $user->rank == 1 ? 'selected' : '' ?>>User</option>
                    <option value="2" <?= $user->rank == 2 ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    document.getElementById('profile-form').addEventListener('submit', function (e) {
        e.preventDefault();
        const firstname = document.getElementById('firstname').value;
        const lastname = document.getElementById('lastname').value;
        <?php if (!$isApi): ?>
            const password = document.getElementById('password').value;
            const CPassword = document.getElementById('CPassword').value;
            const CRPassword = document.getElementById('CRPassword').value;
            if (checkPasswords(CPassword, CRPassword)) {
                updateUser(firstname, lastname, CPassword, password);
                return;
            }
            return;
        <?php endif; ?>
        <?php if ($isApi): ?>
            const id = <?= $user->id ?>;
            const rank = document.getElementById('rank').value;
            const email = document.getElementById('email').value;
            updateUserAdmin(id, firstname, lastname, email, rank);
        <?php endif; ?>
    });

    function checkPasswords(Cpassword, CRPassword) {
        if (Cpassword !== CRPassword) {
            alert('Passwords do not match');
            return false;
        }
        return true;
    }

    async function updateUserAdmin(id, firstname, lastname, email, rank) {
        const response = await fetch('api/user/edit/' . id, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id,
                firstname,
                lastname,
                email,
                rank
            }),
        });
        if (response.ok) {
            window.location.href = '/api/user';
        } else {
            alert('Update failed');
        }
    }

    async function updateUser(firstname, lastname, Cpassword, password) {
        const response = await fetch('/user/edit', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                firstname,
                lastname,
                Cpassword,
                password
            }),
        });
        if (response.ok) {
            window.location.href = '/';
        } else {
            alert('Update failed');
        }
    } 
</script>
<?php include __DIR__ . "/../footer.php"; ?>