<?php
namespace App\Api\Controllers;
use App\Services\ProductService;
class ProductController{
    private $productService;
    public function __construct(){
        $this->productService = new ProductService();
    }
    public function index(){
        $categories = $this->productService->getCategories();
        require __DIR__ . "/../../views/admin/category/index.php";
    }
    public function create(){
        require_once __DIR__ . "/../views/products/create.php";
    }
    public function update($id){
        require_once __DIR__ . "/../views/products/update.php";
    }
        public function delete($id){
        require_once __DIR__ . "/../views/products/delete.php";
    }
}