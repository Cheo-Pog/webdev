<?php

require_once __DIR__ . '/../services/productservice.php';

class HomeController {


        public function index() {
            require_once __DIR__ . "/../views/home/index.php";
        }

        public function about() {
            require_once __DIR__ . "/../views/home/about.php";
        }
}


?>