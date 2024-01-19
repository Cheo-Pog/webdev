<?php
require_once __DIR__ . '/../services/productservice.php';

class ProductController{
    private $ProductService;

    public function __construct() {
        $this->ProductService = new ProductService();
    }

    public function product($category){
        $products = $this->ProductService->getProductByCategory($category);
        require_once __DIR__ . "/../views/products/product.php";
    }

    public function manageproduct(){
        $products = $this->ProductService->getAllProducts();
        require_once __DIR__ . "/../views/products/manageproduct.php";
    }
    public function addproduct(){
        require_once __DIR__ . "/../views/products/addproduct.php";
    }
    public function editproduct($id){
        $product = $this->ProductService->getProductById($id);
        require_once __DIR__ . "/../views/products/editproduct.php";
    }
}