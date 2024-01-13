<?php
require_once __DIR__ . '/../services/productservice.php';
class ProductController{
    private $ProductService;

    public function __construct() {
        $this->ProductService = new ProductService();
    }

    public function productshirts(){
        $products = $this->ProductService->getProductByCategory("shirts");
        require_once __DIR__ . "/../views/products/productshirts.php";
    }

    public function producthats(){
        $products = $this->ProductService->getProductByCategory("hats");
        require_once __DIR__ . "/../views/products/producthats.php";
    }

    public function productcats(){
        $products = $this->ProductService->getProductByCategory("cats");
        require_once __DIR__ . "/../views/products/productcats.php";
    }

}