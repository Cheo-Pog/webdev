<?php
namespace App\Modules;
class Cart{
    public int $id;
    public int $userId;
    public int $productId;
    public int $quantity;
    public float $price;
    public $name;
    public function totalprice(){
        return $this->price * $this->quantity;
    }

}