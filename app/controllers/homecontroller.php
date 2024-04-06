<?php
namespace App\Controllers;

use App\Services\ProductService;

require_once __DIR__ . '/../services/productservice.php';

class HomeController
{
    private $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index()
    {
        $products = $this->productService->getAllProducts();
        if (count($products) < 6) {
            $randomProducts = $products;
        }else{
            $randomKeys = array_rand($products, 6);
            $randomProducts = array_intersect_key($products, array_flip($randomKeys));
        }
        $_SESSION['categories'] = $this->productService->getCategories();

        require __DIR__ . "/../views/home/index.php";
    }
    public function about()
    {
        require __DIR__ . "/../views/home/about.php";
    }
}
?>