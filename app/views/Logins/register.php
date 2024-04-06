<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12 col-lg-6">
      <div class="card">
        <div class="card-body">
          <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
          <form id="register-form">
            <div class="form-floating mb-3">
              <input class="form-control" id="email" name="email" placeholder="name@example.com">
              <label for="email">Email</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" id="firstname" name="firstname" placeholder="Firstname">
              <label for="firstname">Firstname</label>
            </div>
            <div class="form-floating mb-3">
              <input class="form-control" id="lastname" name="lastname" placeholder="Lastname">
              <label for="lastname">Lastname</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
              <label for="password">Password</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="rpassword" name="rpassword" placeholder="Repeat Password">
              <label for="rpassword">Repeat Password</label>
            </div>
            <div class="alert alert-danger" id="alert" style="display: none;">
              <p id="error" class=""></p>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-5" type="submit">Sign up</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('register-form').addEventListener('submit', function (event) {
    event.preventDefault();
    var email = document.getElementById('email').value;
    var firstname = document.getElementById('firstname').value;
    var lastname = document.getElementById('lastname').value;
    var password = document.getElementById('password').value;
    var rpassword = document.getElementById('rpassword').value;
    if (checkPasswords(password, rpassword)) {
      register(email, firstname, lastname, password);
    }
  });

  function checkPasswords(password, rpassword) {
    if (password != rpassword) {
      document.getElementById("alert").setAttribute("style", "display: block;");
      document.getElementById("error").innerText = 'Passwords do not match';
      return false;
    }
    return true;
  }
  async function register(email, firstname, lastname, password) {
    const response = await fetch('/login/Register', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        email,
        firstname,
        lastname,
        password
      }),
    });
    if (response.ok) {
      <?= $isApi ? 'window.location.href = "/api/user";' : 'window.location.href = "/login";' ?>
    } else if (response.status === 401) {
      document.getElementById("alert").setAttribute("style", "display: block;");
      document.getElementById("error").innerText = 'Email already in use';
    } else {
      document.getElementById("alert").setAttribute("style", "display: block;");
      document.getElementById("error").innerText = 'Registration failed';
    }
  }

</script>
<?php include __DIR__ . '/../footer.php'; ?>