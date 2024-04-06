<?php 
namespace App\Repositories;
use App\Modules\Order;
use App\Modules\OrderItem;
use PDO;
class OrderRepository extends Repository{
    public function getAllOrders(){
        $statement = $this->connection->prepare("SELECT orders.id, orders.userId, orders.totalPrice, orders.orderDate, users.email FROM orders join users on orders.userId = users.id");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Order::class);
        return $statement->fetchall();
    }
    public function getOrderItems($id){
        $statement = $this->connection->prepare("SELECT id, orderId, productId, quantity, price FROM order_items WHERE orderId = :orderId");
        $statement->bindParam(':orderId', $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, OrderItem::class);
        return $statement->fetchall();
    }
}