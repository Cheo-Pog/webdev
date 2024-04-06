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
        $statement->bindParam(':category', $category);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Product::class);
        return $statement->fetchAll();
    }

    public function removeProduct($id)
    {
        $statement = $this->connection->prepare("DELETE FROM products WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }
    public function removeCategory($id)
    {
        $statement = $this->connection->prepare("DELETE FROM category WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
    }

    public function editProduct($id, $name, $price, $image, $description, $category)
    {
        $statement = $this->connection->prepare("UPDATE products SET name = :name, price = :price, image=:image, description = :description, category = :category WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':category', $category);
        $statement->execute();
    }
    public function addProduct($name, $price, $image, $description, $category)
    {
        $statement = $this->connection->prepare("INSERT INTO products (name, price, image, description, category) VALUES (:name, :price, :image, :description, :category)");
        $statement->bindParam(':name', $name);
        $statement->bindParam(':price', $price);
        $statement->bindParam(':image', $image);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':category', $category);
        $statement->execute();
    }
    public function getCategories(): array
    {
        $statement = $this->connection->prepare("SELECT id, name FROM category");
        $statement->setFetchMode(PDO::FETCH_CLASS, Category::class);
        $statement->execute();
        return $statement->fetchAll();
    }
    public function getCategoryById($id)
    {
        $statement = $this->connection->prepare("SELECT id, name FROM category WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, Category::class);
        return $statement->fetch();
    }
    public function editCategory($id, $name)
    {
        $statement = $this->connection->prepare("UPDATE category SET name = :name WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':name', $name);
        $statement->execute();
    }
    public function addCategory($name)
    {
        $statement = $this->connection->prepare("INSERT INTO category (name) VALUES (:name)");
        $statement->bindParam(':name', $name);
        $statement->execute();
    }

}