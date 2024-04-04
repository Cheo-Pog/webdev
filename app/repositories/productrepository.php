<?php
namespace App\Repositories;

use App\Repositories\Repository;
use App\Modules\Product;
use App\Modules\Category;
use PDO;
use Exception;
class ProductRepository extends Repository
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProducts()
    {
        $statement = $this->connection->prepare("SELECT * FROM products");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        return $statement->fetchAll();
    }

    public function getProductById($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        return $statement->fetch();
    }

    public function getProductByCategory($category)
    {
        $statement = $this->connection->prepare("SELECT products.id, products.name, products.price, products.description, products.image, category.name as category FROM products join category on products.category = category.id WHERE category.name = :category");
        $statement->execute(['category' => $category]);
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        return $statement->fetchAll();
    }

    public function removeProduct($id)
    {
        $statement = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $statement->execute(['id' => $id]);
    }

    public function editProduct($id, $name, $price, $description, $image, $category)
    {
        $statement = $this->connection->prepare("UPDATE products SET name = :name, price = :price, description = :description, image = :image, category = :category WHERE id = :id");
        $statement->execute(['id' => $id, 'name' => $name, 'price' => $price, 'description' => $description, 'image' => $image, 'category' => $category]);
    }
    public function addProduct($name, $price, $description, $image, $category)
    {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($image["name"]);
        if (move_uploaded_file($image["tmp_name"], $targetFile)) {
            $statement = $this->connection->prepare("INSERT INTO products (name, price, description, image, category) VALUES (:name, :price, :description, :image, :category)");
            $statement->execute(['name' => $name, 'price' => $price, 'description' => $description, 'image' => $targetFile, 'category' => $category]);
        } else {
            throw new Exception("Failed to upload file.");
        }
    }
    public function getCategories(): array
{
    $statement = $this->connection->prepare("SELECT id, name FROM category");
    $statement->setFetchMode(PDO::FETCH_CLASS, Category::class);
    $statement->execute();
    return $statement->fetchAll();
}


    public function addToCart($id, $userid)
    {  
        $cart = $this->getCartByUserId($userid);
        if ($cart != null) {
            foreach ($cart as $item) {
                if ($item->productId == $id) {
                    $quantity = $item->quantity + 1;
                    $statement = $this->connection->prepare("UPDATE shoppingcart SET quantity = :quantity WHERE productid = :productid AND userid = :userid");
                    $statement->bindParam(':quantity', $quantity);
                    $statement->bindParam(':productid', $id);
                    $statement->bindParam(':userid', $userid);
                    $statement->execute();
                    return;
                }
            }
        }
            $statement = $this->connection->prepare("INSERT INTO shoppingcart (productid, userid) VALUES (:productid, :userid)");
            $statement->bindParam(':productid', $id);
            $statement->bindParam(':userid', $userid);
            $statement->execute(); 
    }
    public function removeFromCart($orderId, $userid){
        $statement = $this->connection->prepare("DELETE FROM shoppingcart WHERE orderId = :orderId AND userId = :userid");
        $statement->execute(['orderId' => $orderId, 'userid' => $userid]);
    }
    public function updateQuantity($order, $quantity){
        $statement = $this->connection->prepare("UPDATE shoppingcart SET quantity = :quantity WHERE orderId = :orderId");
        $statement->execute(['orderId' => $order->orderId, 'quantity' => $quantity]);
    }
    public function getCartByUserId($userId)
    {
        $statement = $this->connection->prepare("SELECT * FROM shoppingcart WHERE userid = :userid");
        $statement->execute(['userid' => $userId]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Order");
        return $statement->fetchAll();
    }
    public function getOrderById($orderId)
    {
        $statement = $this->connection->prepare("SELECT * FROM shoppingcart WHERE orderId = :orderId");
        $statement->execute(['orderId' => $orderId]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Order");
        return $statement->fetch();
    }

    public function checkout($userId)
    {
        $statement = $this->connection->prepare("DELETE FROM shoppingcart WHERE userid = :userid");
        $statement->execute(['userid' => $userId]);
    }
}