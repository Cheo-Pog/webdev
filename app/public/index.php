<?php
use App\Services\ProductService;
require '../vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
session_start();

$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new App\PatternRouter();
$router->route($uri);

$productservice = new ProductService();
$_SESSION['categories'] = $productservice->getUniqueCategories();