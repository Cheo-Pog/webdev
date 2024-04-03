<?php
namespace App\Controllers;

use App\Services\ProductService;

class ProductController
{
    private $ProductService;

    public function __construct()
    {
        $this->ProductService = new ProductService();
    }

    public function index()
    {
        $category = $_GET['category'];
        $products = $this->ProductService->getProductByCategory($category);
        require_once __DIR__ . "/../views/products/product.php";
    }

    public function manageproduct()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $products = $this->ProductService->getAllProducts();
            require_once __DIR__ . "/../views/products/manageproduct.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
        }
    }
    public function addproduct()
    {
        require_once __DIR__ . "/../views/products/addproduct.php";
    }
    public function editproduct($id)
    {
        $product = $this->ProductService->getProductById($id);
        require_once __DIR__ . "/../views/products/editproduct.php";
    }
    public function addToCart()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require_once __DIR__ . "/../views/products/addtocart.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];

            if (isset($_SESSION['currentuser'])) {
                $this->ProductService->addToCart($id);
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        }
    }
}