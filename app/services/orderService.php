<?php
namespace App\Services;
use App\Repositories\OrderRepository;
use App\Modules\Order;

class OrderService{
    private $orderRepository;

    public function __construct(){
        $this->orderRepository = new OrderRepository();
    }
    public function getAllOrders(){
        return $this->orderRepository->getAllOrders();
    }
    public function getOrderItems($id){
        return $this->orderRepository->getOrderItems($id);
    }
}
