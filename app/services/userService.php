<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Modules\User;

class UserService
{
    private $UserRepository;

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
    }

    public function GetUserByEmail($email) : User | bool
    {
        return $this->UserRepository->GetUserByEmail($email);
    }
    public function GetAllUsers()
    {
        return $this->UserRepository->GetAllUsers();
    }

    public function promoteUser($id)
    {
        $this->UserRepository->promoteUser($id);
    }
    public function demoteUser($id)
    {
        $this->UserRepository->demoteUser($id);
    }
    public function removeUser($id)
    {  
         $this->UserRepository->removeUser($id);
    }
}