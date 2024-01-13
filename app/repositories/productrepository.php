<?php
require_once __DIR__ . '/../modules/product.php';
class ProductRepository{

    private $connection;   
    
    public function __construct(){
        $this->connection =  new PDO("mysql:host=mysql;dbname=developmentdb", "developer", "secret123");
    }

    public function getAllProducts(){
        $statement = $this->connection->prepare("SELECT * FROM products");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $statement->fetchAll();
    }

    public function getProductByCategory($category){
        $statement = $this->connection->prepare("SELECT * FROM products WHERE category = :category");
        $statement->execute(['category' => $category]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $statement->fetchAll();
    }

}