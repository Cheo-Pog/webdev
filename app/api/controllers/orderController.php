<?php namespace App\Api\Controllers;

use App\Services\OrderService;
use App\Services\ProductService;

class OrderController{
    private $orderService;
    private $productService;
    public function __construct(){
        $this->orderService = new OrderService();
        $this->productService = new ProductService();
    }
    public function index(){
        $orders = $this->orderService->getAllOrders();
        require __DIR__ . "/../../views/admin/orders/index.php";
    }
    public function view($id){
        $orderItems = $this->orderService->getOrderItems($id);
        foreach($orderItems as $orderItem){
            $product = $this->productService->getProductById($orderItem->productId);
            if($product == null){
                $orderItem->productName = "Product not found";
                continue;
            }
            $orderItem->productName = $product->name;
        }
        require __DIR__ . "/../../views/admin/orders/view.php";
    }
}