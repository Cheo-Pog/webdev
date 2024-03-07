<?php
namespace App\Services;

use App\Repositories\LoginRepository;

class LoginService
{
    private $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new LoginRepository;
    }

    public function LoginUser($email, $password)
    {
        $user = $this->loginRepository->GetLogin($email);
        if (password_verify($password, $user->password)) {
            return $user;
        }
    }

    public function GetAllLogins()
    {
        return $this->loginRepository->GetAllLogins();
    }

    public function AddNewLogin($email, $firstname, $lastname, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->loginRepository->AddNewLogin($email, $firstname, $lastname, $hash);
    }
    public function promoteUser($id)
    {
        $this->loginRepository->promoteUser($id);
    }
    public function demoteUser($id)
    {
        $this->loginRepository->demoteUser($id);
    }
    public function removeUser($id)
    {  
         $this->loginRepository->removeUser($id);
    }
}