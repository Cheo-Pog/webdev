<?php
namespace App\Repositories;

use App\Modules\Login;
use PDO;
class LoginRepository{

    private $connection;   
    
    public function __construct(){
        $this->connection =  new PDO("mysql:host=mysql;dbname=developmentdb", "developer", "secret123");
    }

    public function AddNewLogin($email, $firstname, $lastname, $hash){
        $statement = $this->connection->prepare("INSERT INTO Login (email, firstname, lastname, password) VALUES (:email, :firstname, :lastname, :password)");
        $statement->execute(['email' => $email, 'firstname' => $firstname, 'lastname' => $lastname, 'password' => $hash]);
    }
    public function GetLogin($email){
        $statement = $this->connection->prepare("SELECT id, email, firstname, lastname, password FROM Login WHERE email = :email");
        $statement->execute(['email' => $email]);
        $statement->setFetchMode(PDO::FETCH_CLASS, Login::class);
        return $statement->fetch();
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