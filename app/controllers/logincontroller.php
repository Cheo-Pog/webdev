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
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once __DIR__ . "/../views/logins/register.php";
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $email = $data['email'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $password = $data['password'];
            if ($this->LoginService->AddNewLogin($email, $firstname, $lastname, $password)) {
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        }
    }
    public function Login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once __DIR__ . "/../views/logins/login.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $email = $data['email'];
            $password = $data['password'];

            $user = $this->LoginService->LoginUser($email, $password);
            if ($user != null) {
                $_SESSION['currentUser'] = $user;
                http_response_code(200);
            } else {
                http_response_code(400);
            }
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