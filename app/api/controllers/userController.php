<?php
namespace App\Api\Controllers;
use App\Services\UserService;
use Exception;
class UserController{
    private $userService;
    public function __construct(){
        $this->userService = new UserService();
    }
    public function index(){
        $users = $this->userService->GetAllUsers();
        require __DIR__ . "/../../views/admin/users/index.php";
    }
    public function create(){
        $isApi = true;
        require __DIR__ . "/../../views/logins/register.php";
    }
    public function edit($id){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $this->userService->GetUserById($id);
            require __DIR__ . "/../../views/users/edit.php";
        }

        if($_SERVER['REQUEST_METHOD'] == 'PUT'){
            $data = json_decode(file_get_contents('php://input'), true);
            $id = $data['id'];
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $data['email'];
            $rank = $data['rank'];

            if (!isset($id, $firstname, $lastname, $email, $rank) || empty($firstname) || empty($lastname) || empty($email) || empty($rank) || empty($id)) {
                http_response_code(400);
                return;
            }

            try {
                $this->userService->editUser($id, $firstname, $lastname, $email, $rank);
                http_response_code(200);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
                return;
            }
        }
    }
        public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
            $this->userService->removeUser($id);
            http_response_code(200);
            return;
        }
    }
}