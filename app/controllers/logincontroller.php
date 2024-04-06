<?php
namespace App\Controllers;

use App\Services\Loginservice;
use Exception;

class Logincontroller
{
    private $loginservice;

    public function __construct()
    {
        $this->loginservice = new Loginservice();
    }
    public function index()
    {
        require_once __DIR__ . "/../views/logins/login.php";
    }
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $isApi = false;
            require_once __DIR__ . "/../views/logins/register.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['email'], $data['firstname'], $data['lastname'], $data['password']) || empty($data['email']) || empty($data['firstname']) || empty($data['lastname']) || empty($data['password'])) {
                http_response_code(400);
                return;
            }
            $email = $data['email'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $password = $data['password'];

            try {
                $this->loginservice->AddNewLogin($email, $firstname, $lastname, $password);
                http_response_code(200);
                return;
            } catch (Exception $e) {
                http_response_code(400);
                return;
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
            if (!isset($data['email'], $data['password']) || empty($data['email']) || empty($data['password'])) {
                http_response_code(400);
                return;
            }
            $email = $data['email'];
            $password = $data['password'];

            $user = $this->loginservice->LoginUser($email, $password);
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
}