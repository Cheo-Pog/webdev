<?php

require_once __DIR__ . '/../repositories/productrepository.php';
class ProductService {

    private $ProductRepository;

    public function __construct() {
        $this->ProductRepository = new ProductRepository;
    }

    public function getAllProducts() {
        return $this->ProductRepository->getAllProducts();
    }

    public function getProductByCategory($category) {
        return $this->ProductRepository->getProductByCategory($category);
    }

}