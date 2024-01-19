<?php
require_once __DIR__ . '/../controllers/homecontroller.php';
require_once __DIR__ . '/../controllers/productcontroller.php';
require_once __DIR__ . '/../controllers/logincontroller.php';
require_once __DIR__ . '/../services/productservice.php';

$url = $_SERVER['REQUEST_URI'];
$get = explode('?', $url);
session_start();

try {
    switch ($url) {
        case '/':
            $HomeController = new HomeController();
            $HomeController->index();
            break;
        case '/about':
            $HomeController = new HomeController();
            $HomeController->about();
            break;
        case '/login':
            $LoginController = new LoginController();
            $LoginController->login();
            break;
        case '/register':
            $LoginController = new LoginController();
            $LoginController->register();
            break;
        case '/profile':
            $LoginController = new LoginController();
            $LoginController->profile();
            break;
        case '/logout':
            session_destroy();
            header('Location: http://localhost');
            break;
        case '/checkout':
            $productservice = new ProductService();
            $productservice->checkout();
            header('Location: http://localhost/profile');
            break;
        case '/manageproduct':
            $ProductController = new ProductController();
            $ProductController->manageproduct();
            break;
        case '/manageuser':
            $LoginController = new LoginController();
            $LoginController->manageuser();
            break;
        case '/addproduct':
            $ProductController = new ProductController();
            $ProductController->addproduct();
            break;
        case '/promoteuser/?' . $get[1]:
            $id = $_GET['userId'];
            $loginservice = new LoginService();
            $loginservice->promoteUser($id);
            header('Location: http://localhost/manageuser');
            break;
        case '/demoteuser/?' . $get[1]:
            $id = $_GET['userId'];
            $loginservice = new LoginService();
            $loginservice->demoteUser($id);
            header('Location: http://localhost/manageuser');
            break;
        case '/removeuser/?' . $get[1]:
            $id = $_GET['userId'];
            $loginservice = new LoginService();
            $loginservice->removeUser($id);
            header('Location: http://localhost/manageuser');
            break;
        case '/editproduct/?' . $get[1]:
            $id = $_GET['productId'];
            $ProductController = new ProductController();
            $ProductController->editproduct($id);
            break;
        case '/updatequantity/?' . $get[1]:
            case '/updatequantity':
                $order = $_GET['order'];
                $quantity = $_GET['quantity'];
                $productservice = new ProductService();
                $productservice->updateQuantity($order, $quantity);
                header('Location: http://localhost/profile');
                break;
        case '/removeproduct/?' . $get[1]:
            $id = $_GET['productId'];
            $productservice = new ProductService();
            $productservice->removeProduct($id);
            header('Location: http://localhost/manageproduct');
            break;
        case '/addtocart/?' . $get[1]:
            $productId = $_GET['productId'];
            $productservice = new ProductService();
            $productservice->addToCart($productId);
            header('Location: http://localhost/profile');
            break;
        case '/removefromcart/?' . $get[1]:
            $orderId = $_GET['orderId'];
            $productservice = new ProductService();
            $productservice->removeFromCart($orderId);
            header('Location: http://localhost/profile');
            break;
        case '/product/?' . $get[1]:
            $category = $_GET['category'];
            $ProductController = new ProductController();
            $ProductController->product($category);
            break;
        default:
            http_response_code(404);
            break;
    }
} catch (Exception $e) {
    echo "whoops" . $e->getMessage();
}