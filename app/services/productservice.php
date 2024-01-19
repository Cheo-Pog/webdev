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

    public function removeProduct($id) {
        $this->ProductRepository->removeProduct($id);
    }
    public function editProduct($id, $name, $price, $description, $image, $category) {
        $this->ProductRepository->editProduct($id, $name, $price, $description, $image, $category);
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
    public function getUniqueCategories(){
        return $this->ProductRepository->getUniqueCategories();
    }

    public function addToCart($productId){
        $this->ProductRepository->addToCart($productId, $_SESSION['currentuser']->getId());
    }
    public function updateQuantity($orderId, $quantity){
        $order = $this->ProductRepository->getOrderById($orderId);
        $this->ProductRepository->updateQuantity($order, $quantity);
    }
    public function removeFromCart($orderId){
        $this->ProductRepository->removeFromCart($orderId, $_SESSION['currentuser']->getId());
    }
    public function getCartByUserId(){
        return $this->ProductRepository->getCartByUserId($_SESSION['currentuser']->getId());
    }
    public function getOrderById($orderId){
        return $this->ProductRepository->getOrderById($orderId);
    }
    public function checkout(){
        $this->ProductRepository->checkout($_SESSION['currentuser']->getId());
    }

}