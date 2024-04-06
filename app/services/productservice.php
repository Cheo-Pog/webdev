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
    public function addProduct($name, $price, $image ,$description, $category) {
        $this->ProductRepository->addProduct($name, $price, $image, $description, $category);
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
    public function getCategoryById($id){
        return $this->ProductRepository->getCategoryById($id);
    }
    public function editCategory($id, $name){
        $this->ProductRepository->editCategory($id, $name);
    }
    public function addCategory($name){
        $this->ProductRepository->addCategory($name);
    }
    public function editProduct($id, $name, $price, $image, $description, $category){
        $this->ProductRepository->editProduct($id, $name, $price, $image, $description, $category);
    }
    public function removeProduct($id){
        $this->ProductRepository->removeProduct($id);
    }
    public function removeCategory($id){
        $this->ProductRepository->removeCategory($id);
    }
}