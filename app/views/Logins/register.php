<?php include __DIR__ . '/../header.php'; ?>
<div class=container>
  <h1 class="h3 mb-3 fw-normal">Register</h1>
  <form action="/login/RegisterUser" method='post' id="register-form">
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
    <div class="error my-3">
      <p id="error"></p>
    </div>
    <button class="btn btn-primary w-100 py-2 mt-5" id='submitButton' type="submit">Sign up</button>
  </form>
  <script>
    Document.getElementById('register-form').addEventListener('submit', function (event) {
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
        document.getElementById(error).innerText = 'Passwords do not match';
        return false;
      }
      return true;
    }
    async function register(email, firstname, lastname, password) {
      const response = await fetch('/login/RegisterUser', {
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
        window.location.href = '/login';
      } else {
        document.getElementById(error).innerText = 'Registration failed';
      }
    }

  </script>
  <?php include __DIR__ . '/../footer.php'; ?>