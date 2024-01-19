<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeatpassword'])) {
    require_once __DIR__ . '/../../services/loginservice.php';
    require_once __DIR__ . '/../../modules/login.php';
    $loginservice = new LoginService();
    if($_POST['password'] === $_POST['repeatpassword']) {
        $check = $loginservice->AddNewLogin($_POST['username'], $_POST['password']);
        if($check){
            $errorMessage = 'Username already exists.';
        }
        else{
        header('Location: http://localhost/login');
        exit;
        }
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<main class="form-signin w-100 m-auto mt-5">
  <form class ='container' method='post'>
    <h1 class="h3 mb-3 fw-normal">Register</h1>
    <div class="form-floating">
      <input class="form-control" id="username" name="username" placeholder="name@example.com">
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="repeatpassword" name="repeatpassword" placeholder="Password">
      <label for="repeatpassword">Repeat Password</label>
    </div>
    <button class="btn btn-primary w-100 py-2 mt-5" id='submitButton' disabled type="submit">Sign up</button>
  </form>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script>
    // Select the form inputs and the button
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const repeatPasswordInput = document.getElementById('repeatpassword');
    const submitButton = document.getElementById('submitButton');

    // Function to check if the inputs are empty
    function checkInputs() {
        if (usernameInput.value && passwordInput.value && repeatPasswordInput.value) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }

    // Add event listeners to the inputs
    usernameInput.addEventListener('input', checkInputs);
    passwordInput.addEventListener('input', checkInputs);
    repeatPasswordInput.addEventListener('input', checkInputs);

    // Call the function initially to set the button state
    checkInputs();
</script>
</body>
</html>