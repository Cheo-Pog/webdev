<?php
require_once __DIR__ . '/../services/productservice.php';
require_once __DIR__ . '/../services/loginservice.php';
class LoginController{

    public function login() {
        require_once __DIR__ . "/../views/logins/login.php";
    }

    public function register() {
        require_once __DIR__ . "/../views/logins/register.php";
    }

    public function profile() {
        $productService = new ProductService();
        $orders = $productService->getCartByUserId();
        require_once __DIR__ . "/../views/logins/profile.php";
    }

    public function manageuser() {
        $loginservice = new LoginService();
        $users = $loginservice->GetAllLogins();
        require_once __DIR__ . "/../views/logins/manageuser.php";
    }
}

?>