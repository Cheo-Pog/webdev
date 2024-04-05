<?php
namespace App\Services;
use App\Repositories\UserRepository;
use App\Modules\User;

class Loginservice{
    private $UserRepository;

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
    }
    public function LoginUser($email, $password) : User | bool
    {
        $user = $this->UserRepository->GetUserByEmail($email);
        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
    public function AddNewLogin($email, $firstname, $lastname, $password)
    {
        $user = $this->UserRepository->GetUserByEmail($email);
        if ($user) {
            return false;
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->UserRepository->AddNewUser($email, $firstname, $lastname, $hash);
    }
}