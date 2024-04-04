<?php
namespace App\Controllers;

class AdminController{

    function index(){
        require_once __DIR__ . "/../views/admin/dashboard.php";
    }
}