<?php
namespace App\Controllers;

use App\Services\ProductService;
use App\Services\CartService;

class ProductController
{
    private $ProductService;
    private $CartService;

    public function __construct()
    {
        $this->ProductService = new ProductService();
        $this->CartService = new CartService();
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
}