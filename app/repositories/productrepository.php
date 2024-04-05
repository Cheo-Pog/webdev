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

}