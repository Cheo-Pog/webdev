<?php
namespace App\Controllers;

use App\Services\UserService;
use Exception;

class UserController
{

    private $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function profile()
    {
        require_once __DIR__ . "/../views/users/profile.php";
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $this->userService->GetUserByEmail($_SESSION['currentUser']->email);
            require_once __DIR__ . "/../views/users/edit.php";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $_SESSION['currentUser']->email;
            $Cpassword = $data['Cpassword'];
            $password = $data['password'];

            if (!isset($firstname, $lastname, $email, $Cpassword) || empty($firstname) || empty($lastname) || empty($email) || empty($Cpassword)) {
                http_response_code(400);
                return;
            }
            if (!isset($password) || empty($password)) {
                try {
                    $this->userService->editProfileNoPassword($email, $firstname, $lastname, $Cpassword);
                    http_response_code(201);
                    return;
                } catch (Exception $e) {
                    http_response_code(500);
                    return;
                }
            }
            try {
                $this->userService->editProfile($email, $firstname, $lastname, $Cpassword, $password);
                http_response_code(200);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                return;
            }
        }
    }

    public function manageuser()
    {
        $loginservice = new UserService();
        $users = $loginservice->GetAllLogins();
        require_once __DIR__ . "/../views/users/manageuser.php";
    }
}

?>