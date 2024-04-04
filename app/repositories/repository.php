<?php
namespace App\Repositories;

use PDO;
class Repository{
    protected $connection;   
    
    public function __construct(){
        $this->connection =  new PDO("mysql:host=mysql;dbname=developmentdb", "developer", "secret123");
    }
}