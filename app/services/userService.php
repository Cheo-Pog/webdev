<?php
namespace App\Services;

use App\Repositories\UserRepository;
use App\Modules\User;
use Exception;

class UserService
{
    private $UserRepository;

    public function __construct()
    {
        $this->UserRepository = new UserRepository;
    }

    public function GetUserByEmail($email): User|bool
    {
        return $this->UserRepository->GetUserByEmail($email);
    }
    public function GetUserById($id): User|bool
    {
        return $this->UserRepository->GetUserById($id);
    }
    public function GetAllUsers()
    {
        return $this->UserRepository->GetAllUsers();
    }

    public function editProfile($email, $firstname, $lastname, $Cpassword, $password)
    {
        $user = $this->UserRepository->GetUserByEmail($email);
        if ($user && password_verify($Cpassword, $user->password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $this->UserRepository->editProfile($email, $firstname, $lastname, $hash);
            return $this->UserRepository->GetUserByEmail($email);
        }
        throw new Exception("Invalid password");
    }
    public function editProfileNoPassword($email, $firstname, $lastname, $Cpassword)
    {
        $user = $this->UserRepository->GetUserByEmail($email);
        if ($user && password_verify($Cpassword, $user->password)) {
            $this->UserRepository->editProfileNoPassword($email, $firstname, $lastname);
            return $this->UserRepository->GetUserByEmail($email);
        }
        throw new Exception("Invalid password");
    }
    public function editUser($id, $firstname, $lastname, $email, $rank)
    {
        $this->UserRepository->editUser($id, $firstname, $lastname, $email, $rank);
    }

    public function removeUser($id)
    {
        $this->UserRepository->removeUser($id);
    }
}