<?php
namespace App\Repositories;

use App\Repositories\Repository;
use App\Modules\Cart;
use PDO;
use Exception;

class CartRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCartByUserId($userId) : array
    {
        $statement = $this->connection->prepare("SELECT shoppingcarts.id, shoppingcarts.userId, shoppingcarts.productId, shoppingcarts.quantity, products.price, products.name FROM shoppingcarts JOIN products on shoppingcarts.productId = products.id WHERE userId = :userId");
        $statement->bindParam(':userId', $userId);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Cart::class);
        return $statement->fetchall();
    }
    public function addToCart($productId, $userId)
    {
        $statement = $this->connection->prepare("INSERT INTO shoppingcarts (userId, productId) VALUES (:userId, :productId)");
        $statement->bindParam(':userId', $userId);
        $statement->bindParam(':productId', $productId);
        $statement->execute();
    }
    public function removeFromCart($id, $userid){
        $statement = $this->connection->prepare("DELETE FROM shoppingcarts WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
    public function updateQuantity($id, $quantity){
        $statement = $this->connection->prepare("UPDATE shoppingcarts SET quantity = :quantity WHERE id = :id");
        $statement->bindParam(':quantity', $quantity);
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
    public function checkout($cart, $subtotal) : bool
    {
        try{
        $statement = $this->connection->prepare("INSERT INTO orders (userId, totalPrice) value (:userId, :totalPrice)");
        $statement->bindParam(':userId', $cart[0]->userId);
        $statement->bindParam(':totalPrice', $subtotal);
        $statement->execute();

        $orderId = $this->connection->lastInsertId();

        foreach ($cart as $item) {
            $statement = $this->connection->prepare("INSERT INTO order_items (orderId, productId, quantity, price) VALUES (:orderId, :productId, :quantity, :price)");
            $statement->bindParam(':orderId', $orderId);
            $statement->bindParam(':productId', $item->productId);
            $statement->bindParam(':quantity', $item->quantity);
            $statement->bindParam(':price', $item->price);
            $statement->execute();

            $statement = $this->connection->prepare("DELETE FROM shoppingcarts WHERE userId = :userId");
            $statement->bindParam(':userId', $item->userId);
            $statement->execute();
        }
    }catch(Exception $e){
        return false;
    }
        return true;
    }
}
