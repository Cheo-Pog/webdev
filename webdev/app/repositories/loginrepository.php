<?php
require_once __DIR__ . '/../modules/login.php';
class LoginRepository{

    private $connection;   
    
    public function __construct(){
        $this->connection =  new PDO("mysql:host=mysql;dbname=developmentdb", "developer", "secret123");
    }

    public function AddNewLogin($username, $password){
        $statement = $this->connection->prepare("INSERT INTO Login (username, password) VALUES (:username, :password)");
        $statement->execute(['username' => $username, 'password' => $password]);
    }

    public function GetAllLogins(){
        $statement = $this->connection->prepare("SELECT * FROM Login");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, "Login");
        return $statement->fetchAll();
    }

    public function GetLoginByUsername($username){
        $statement = $this->connection->prepare("SELECT * FROM Login WHERE username = :username");
        $statement->execute(['username' => $username]);
        $statement->setFetchMode(PDO::FETCH_CLASS, "Login");
        return $statement->fetch();
    }
    public function promoteUser($id){
        $statement = $this->connection->prepare("UPDATE Login SET rank = 'admin' WHERE id = :id");
        $statement->execute(['id' => $id]);
    }
    public function demoteUser($id){
        $statement = $this->connection->prepare("UPDATE Login SET rank = 'customer' WHERE id = :id");
        $statement->execute(['id' => $id]);
    }
    public function removeUser($id){
        $statement = $this->connection->prepare("DELETE FROM Login WHERE id = :id");
        $statement->execute(['id' => $id]);
    }
}