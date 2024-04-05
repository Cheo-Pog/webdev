<?php
namespace App\Api\Controllers;

use App\Services\ProductService;
use Exception;

class ProductController
{
    private $productService;
    public function __construct()
    {
        $this->productService = new ProductService();
    }
    public function index()
    {
        $categories = $this->productService->getCategories();
        require __DIR__ . "/../../views/admin/category/index.php";
    }
    public function createProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $this->productService->getCategories();
            require __DIR__ . "/../../views/admin/products/edit.php";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'];
            $price = $data['price'];
            $description = $data['description'];
            // $image = $data['image'];
            $category = $data['category'];

            if (!isset($name, $price, $description, $category) || empty($name) || empty($price) || empty($description) || empty($category)) {
                http_response_code(400);
                return;
            }

            try {
                $this->productService->addProduct($name, $price, $description, $category);
                http_response_code(201);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
                return;
            }
        }
    }
    public function editProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $this->productService->getCategories();
            $product = $this->productService->getProductById($id);
            require __DIR__ . "/../../views/admin/products/edit.php";
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'];
            $price = $data['price'];
            $description = $data['description'];
            // $image = $data['image'];
            $category = $data['category'];

            if (!isset($name, $price, $description, $category) || empty($name) || empty($price) || empty($description) || empty($category)) {
                http_response_code(400);
                return;
            }

            try {
                $this->productService->editProduct($id, $name, $price, $description, $category);
                http_response_code(200);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
                return;
            }
        }
    }
    public function createCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            require __DIR__ . "/../../views/admin/category/edit.php";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'];
            if (!isset($name) || empty($name)) {
                http_response_code(400);
                return;
            }
            try {
                $this->productService->addCategory($name);
                http_response_code(201);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
                return;
            }
        }
    }
    public function editCategory($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $category = $this->productService->getCategoryById($id);
            $products = $this->productService->getProductByCategory($category->name);
            require __DIR__ . "/../../views/admin/category/edit.php";
        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'];
            if (!isset($id) || empty($name)) {
                http_response_code(400);
                return;
            }
            try {
                $this->productService->editCategory($id, $name);
                http_response_code(200);
                return;
            } catch (Exception $e) {
                http_response_code(500);
                echo json_encode($e->getMessage());
                return;
            }
        }
    }
    public function deleteProduct($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->productService->removeProduct($id);
            http_response_code(200);
            return;
        }
    }
    public function deleteCategory($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            $this->productService->removeCategory($id);
            http_response_code(200);
            return;
        }
    }
}