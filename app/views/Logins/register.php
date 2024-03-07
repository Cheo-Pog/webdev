<?php include __DIR__ . '/../header.php'; ?>
<body>
<main class="form-signin w-100 m-auto mt-5 container">
  <form action="/login/RegisterUser" method='post'>
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <div class="form-floating">
      <input class="form-control" id="email" name="email" placeholder="name@example.com">
      <label for="email">email</label>
    </div>
    <div class="form-floating">
      <input class="form-control" id="firstname" name="firstname" placeholder="firstname">
      <label for="firstname">firstname</label>
    </div>
    <div class="form-floating">
      <input class="form-control" id="lastname" name="lastname" placeholder="lastname">
      <label for="lastname">lastname</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Password">
      <label for="rpassword">Repeat Password</label>
    </div>
    <button class="btn btn-primary w-100 py-2 mt-5" id='submitButton' type="submit">Sign up</button>
  </form>
</main>
<script>
</script>
<?php include __DIR__ . '/../footer.php'; ?>