<?php
namespace App\Controllers;

use App\Services\LoginService;

class LoginController
{

    private $LoginService;
    public function __construct()
    {
        $this->LoginService = new LoginService();
    }
    public function index()
    {
        require_once __DIR__ . "/../views/logins/login.php";
    }

    public function register()
    {
        require_once __DIR__ . "/../views/logins/register.php";
    }
    public function LoginUser()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->LoginService->LoginUser($email, $password);
        if ($user != null) {
            $_SESSION['currentUser'] = $user;
            header("Location: /");
        } else {
            echo "Invalid email or password";
        }
    }
    public function RegisterUser()
    {
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        if ($password == $rpassword) {
            $this->LoginService->AddNewLogin($email, $firstname, $lastname, $password);
            header("Location: /login");
        }
        else {
            echo "Passwords do not match";
        }
    }
    public function LogoutUser()
    {
        session_destroy();
        header("Location: /");
    }

    public function profile()
    {
        require_once __DIR__ . "/../views/logins/profile.php";
    }

    public function manageuser()
    {
        $loginservice = new LoginService();
        $users = $loginservice->GetAllLogins();
        require_once __DIR__ . "/../views/logins/manageuser.php";
    }
}

?>