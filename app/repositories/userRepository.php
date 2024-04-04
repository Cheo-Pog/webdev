<?php
namespace App\Repositories;

use App\Repositories\Repository;
use App\Modules\User;
use PDO;
class UserRepository extends Repository{

    
    public function __construct(){
        parent::__construct();
    }

    public function AddNewUser($email, $firstname, $lastname, $hash) : bool{
        $statement = $this->connection->prepare("INSERT INTO users (email, firstName, lastName, password) VALUES (:email, :firstname, :lastname, :password)");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':password', $hash);
        return $statement->execute();
    }
    public function GetUserByEmail($email) : User | bool
    {
        $statement = $this->connection->prepare("SELECT id, email, firstname, lastname, password, rank FROM users WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $statement->fetch();
    }

    public function GetAllUsers(){
        $statement = $this->connection->prepare("SELECT  id, email, firstname, lastname, rank FROM users");
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $statement->fetchAll();
    }

    public function GetUserByFirstname($firstName){
        $statement = $this->connection->prepare("SELECT id, email, firstname, lastname, rank FROM Login WHERE firstname = :firstName");
        $statement->bindParam(':firstName', $firstName);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $statement->fetch();
    }
    public function removeUser($id){
        $statement = $this->connection->prepare("DELETE FROM Login WHERE id = :id");
        $statement->execute(['id' => $id]);
    }
}