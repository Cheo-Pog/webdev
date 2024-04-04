<?php
namespace App\Services;

use App\Repositories\ProductRepository;
class ProductService {

    private $ProductRepository;

    public function __construct() {
        $this->ProductRepository = new ProductRepository;
    }
    public function getAllProducts() {
        return $this->ProductRepository->getAllProducts();
    }
    public function addProduct($name, $price, $description, $image, $category) {
        $this->ProductRepository->addProduct($name, $price, $description, $image, $category);
    }
    public function getProductByCategory($category) {
        return $this->ProductRepository->getProductByCategory($category);
    }
    public function getProductById($id){
        return $this->ProductRepository->getProductById($id);
    }
    public function getCategories(): array
    { 
        return $this->ProductRepository->getCategories();
    }
}