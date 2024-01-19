<?php
    require_once __DIR__ . '/../../services/loginservice.php';
    $loginLogic = new Login();
    $loginservice = new LoginService();
    $allLogins = $loginservice->GetAllLogins();
    
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $validCredentials = false;

    foreach ($allLogins as $login) {
        if ($login->getUsername() === $_POST['username'] && $login->getPassword() === $_POST['password']) {
            $loginLogic->setCurrentUser($login->getId(), $login->getUsername(), $login->getPassword(), $login->getRank());
            $_SESSION['currentuser'] = $login->getCurrentUser();
            $validCredentials = true;
            break;
        }
    }

    if ($validCredentials) {
        header('Location: http://localhost');
        exit;
    } else {
        $errorMessage = 'Invalid username or password.';
    }
  }
$errorMessage = '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">

    <main class="form-signin w-100 m-auto">
        <form class='container' method='post'?>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="username" placeholder="username">
                <label for="username">Username</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
            </div>
            <p id="errorMessage" class="text-danger"><?php echo $errorMessage; ?></p>
            <div class="form-check text-start my-3">
                <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    Remember me
                </label>
            </div>
            <button class="btn btn-primary w-100 py-2" id="submitButton" type="submit">Sign in</button>
            <p class="mt-5 mb-3 text-muted">Don't have an account? <a href="http://localhost/register">Sign up</a></p>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script>
    // Select the form inputs and the button
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const submitButton = document.getElementById('submitButton');

    // Function to check if the inputs are empty
    function checkInputs() {
        if (usernameInput.value && passwordInput.value) {
            submitButton.disabled = false;
        } else {
            submitButton.disabled = true;
        }
    }
    // Add event listeners to the inputs
    usernameInput.addEventListener('input', checkInputs);
    passwordInput.addEventListener('input', checkInputs);


    // Call the function initially to set the button state
    checkInputs();
    </script>

</body>

</html>