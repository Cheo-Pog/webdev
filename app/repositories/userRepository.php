<?php
namespace App\Repositories;

use App\Repositories\Repository;
use App\Modules\User;
use PDO;
use Exception;
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
    public function GetUserById($id) : User{
        $statement = $this->connection->prepare("SELECT id, email, firstname, lastname, rank FROM users WHERE id = :id");
        $statement->bindParam(':id', $id);
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
        $statement = $this->connection->prepare("SELECT id, email, firstname, lastname, rank FROM users WHERE firstname = :firstName");
        $statement->bindParam(':firstName', $firstName);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        return $statement->fetch();
    }
    public function editProfile($email, $firstname, $lastname, $hash){
        $statement = $this->connection->prepare("UPDATE users SET email = :email, firstname = :firstname, lastname = :lastname, password = :password WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':password', $hash);
        return $statement->execute();
    }
    public function editProfileNoPassword($email, $firstname, $lastname){
        $statement = $this->connection->prepare("UPDATE users SET email = :email, firstname = :firstname, lastname = :lastname WHERE email = :email");
        $statement->bindParam(':email', $email);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        return $statement->execute();
    }
    public function editUser($id, $firstname, $lastname, $email, $rank){
        $statement = $this->connection->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, rank = :rank WHERE id = :id");
        $statement->bindParam(':id', $id);
        $statement->bindParam(':firstname', $firstname);
        $statement->bindParam(':lastname', $lastname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':rank', $rank);
        $statement->execute();
    }
    public function removeUser($id){
        $statement = $this->connection->prepare("DELETE FROM users WHERE id = :id");
        $statement->execute(['id' => $id]);
    }
}