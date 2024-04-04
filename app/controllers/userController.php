<?php
namespace App\Controllers;

use App\Services\UserService;

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

    public function manageuser()
    {
        $loginservice = new UserService();
        $users = $loginservice->GetAllLogins();
        require_once __DIR__ . "/../views/users/manageuser.php";
    }
}

?>