<?php
namespace App\Controllers;
use App\Services\CartService;
use Exception;
class CartController
{
    private $CartService;

    public function __construct()
    {
        $this->CartService = new CartService();
    }
    public function index(){
    }
    public function success(){
        if($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            require_once __DIR__ . "/../views/cart/success.php";
        }
    }
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];

            if (isset($_SESSION['currentUser'])) {
                $this->CartService->addToCart($id);
                    http_response_code(200);
                    return;
            } else {
                http_response_code(401);
                return;
            }
        }
    }
    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $cart = $this->CartService->getCartByUserId($_SESSION['currentUser']->id);
            require_once __DIR__ . "/../views/cart/cart.php";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $cart = $this->CartService->getCartByUserId($_SESSION['currentUser']->id);

            $subtotal = $data['subtotal'];
            if (!isset($subtotal)){
                http_response_code(400);
                return;
            }

            if (isset($_SESSION['currentUser'], $cart)){
                try{
                    $this->CartService->checkout($cart, $subtotal);
                    http_response_code(200);
                    return;
                } catch (Exception $e) {
                    http_response_code(500);
                    return;
                }
            } else {
                http_response_code(401);
                return;
            }
        }
    }
    public function removeFromCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            if (!isset($id)){
                http_response_code(400);
                return;
            }

            if (isset($_SESSION['currentUser'])) {
                $this->CartService->removeFromCart($id);
                http_response_code(200);
                return;
            } else {
                http_response_code(401);
                return;
            }
        }
    }
}