<?php
include __DIR__ . '/../header.php';
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form id="login-form">
                        <h1 class="h3 mb-3 fw-normal text-center">Please sign in</h1>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="email">
                            <label for="email">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                            <label for="password">Password</label>
                        </div>
                        <div class="form-check text-start mb-3">
                            <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>
                        </div>
                        <div>
                            <div class="alert alert-danger" id="alert" style="display: none;">
                                <p id="error" class=""></p>
                            </div>
                        </div>
                        <div><button class="btn btn-primary w-100 py-2" id="submitButton" type="submit">Sign
                                in</button>
                        </div>
                        <div class="card-footer">
                            <p class="mt-3 mb-0 text-muted text-center">Don't have an account? <a
                                    href="/login/register">Signup</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById("login-form").addEventListener('submit', function (event) {
        event.preventDefault();
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        login(email, password);
    });

    async function login(email, password) {
        const response = await fetch('/login/Login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email,
                password
            }),
        });
        if (response.ok) {
            window.location.href = '/';
        } else {
            document.getElementById("alert").setAttribute("style", "display: block;");
            document.getElementById("error").innerText = 'Login failed';
        }
    }

</script>
<?php include __DIR__ . '/../footer.php'; ?>