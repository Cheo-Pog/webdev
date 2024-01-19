<?php

class Login{
    private $id;
    private $username;
    private $password;
    private $rank;

    public function setCurrentUser($id,$username, $password, $rank){
        $this->id = $id;        
        $this->username = $username;
        $this->password = $password;
        $this->rank = $rank;
    }

    public function getCurrentUser(){
        if($this->username != null && $this->password != null && $this->rank != null){
            return $this;
        }
        return null;
    }
    public function getId(){
        return $this->id;
    }   

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function setRank($rank){
        $this->rank = $rank;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRank(){
        return $this->rank;
    }
}