<?php
require_once __DIR__ . '/../repositories/loginrepository.php';

class LoginService
{
    private $loginRepository;

    public function __construct()
    {
        $this->loginRepository = new LoginRepository;
    }

    public function GetAllLogins()
    {
        return $this->loginRepository->GetAllLogins();
    }

    public function AddNewLogin($username, $password)
    {
        $check = $this->loginRepository->GetLoginByUsername($username);
        if ($check == null) {
            $this->loginRepository->AddNewLogin($username, $password);
            return false;
        } else {
            return true;
        }
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