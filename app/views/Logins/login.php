<?php
include __DIR__ . '/../header.php';
?>
<main class="form-signin w-100 m-auto container">
    <form action='/login/LoginUser' method='post' ?>
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
</main>

<script>

</script>
<?php include __DIR__ . '/../footer.php'; ?>