<?php

require_once __DIR__ . '/../controllers/homecontroller.php';   
require_once __DIR__ . '/../controllers/productcontroller.php';

$url =  $_SERVER['REQUEST_URI'];

try{
switch ($url) {
    case '/':
        $HomeController = new HomeController();
        $HomeController->index();
        break;
    case '/about':
        $HomeController = new HomeController();
        $HomeController->about();
        break;
     case '/productshirts':
        $ProductController = new ProductController();
        $ProductController->productshirts();
        break;
        case '/producthats':
            $ProductController = new ProductController();
            $ProductController->producthats();
            break;
            case '/productcats':
                $ProductController = new ProductController();
                $ProductController->productcats();
                break;
    default:
        http_response_code(404);
        break;
}
}catch(Exception $e){
    echo "whoops" . $e->getMessage();
} 

?>