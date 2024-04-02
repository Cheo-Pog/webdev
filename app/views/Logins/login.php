<?php
include __DIR__ . '/../header.php';
?>
<div class="container">
    <form id="login-form">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <div class="form-floating">
            <input type="text" class="form-control" id="email" name="email" placeholder="email">
            <label for="email">E-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>
        <div class="form-check text-start my-3">
            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                Remember me
            </label>
        </div>
        <button class="btn btn-primary w-100 py-2" id="submitButton" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">Don't have an account? <a href="/login/register">Sign up</a></p>
    </form>
</div>

<script>
    document.getElementById(login - form).addEventListener('submit', function (event) {
        event.preventDefault();
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        login(email, password);
    });

    async function login(email, password) {
        const response = await fetch('/login/LoginUser', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(email, password),
        })
            .then(response => response.json())
            .then(data => {
                if (response.ok) {
                    window.location.href = '/';
                } else {
                    alert('Login failed');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }
</script>
<?php include __DIR__ . '/../footer.php'; ?>