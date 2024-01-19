<?php
require_once __DIR__ . '/../modules/product.php';
require_once __DIR__ . '/../modules/login.php';
require_once __DIR__ . '/../modules/order.php';
class ProductRepository
{

    private $connection;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=mysql;dbname=developmentdb", "developer", "secret123");
    }

    public function getAllProducts()
    {
        $statement = $this->connection->prepare("SELECT * FROM products");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $statement->fetchAll();
    }

    public function getProductById($id)
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE id = :id");
        $statement->execute(['id' => $id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $statement->fetch();
    }

    public function getProductByCategory($category)
    {
        $statement = $this->connection->prepare("SELECT * FROM products WHERE category = :category");
        $statement->execute(['category' => $category]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
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
    public function getUniqueCategories()
    {
        $statement = $this->connection->prepare("SELECT DISTINCT category FROM products");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $statement->fetchAll();
    }

    public function addToCart($id, $userid)
    {
        $cart = $this->getCartByUserId($userid);
        if ($cart != null) {
            foreach ($cart as $item) {
                if ($item->productId == $id) {
                    $statement = $this->connection->prepare("UPDATE shoppingcart SET quantity = :quantity WHERE productid = :productid AND userid = :userid");
                    $statement->execute(['productid' => $id, 'userid' => $userid, 'quantity' => $item->quantity + 1]);
                    return;
                }
            }
        }
            $statement = $this->connection->prepare("INSERT INTO shoppingcart (productid, userid, quantity) VALUES (:productid, :userid, :quantity)");
            $statement->execute(['productid' => $id, 'userid' => $userid, 'quantity' => 1]); 
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