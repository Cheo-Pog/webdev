<?php
namespace App\Controllers;

class AdminController
{

    public function index()
    {
        require_once __DIR__ . "/../views/admin/dashboard.php";
    }

    public function upload()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadedFileHash = md5_file($_FILES['image']['tmp_name']);
            $filesInDirectory = scandir($uploadDirectory);
            $fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            $fileName = uniqid() . '.' . $fileExtension;
            $targetPath = $uploadDirectory . $fileName;

            foreach ($filesInDirectory as $file) {
                if (!is_dir($uploadDirectory . $file)) {
                    $currentFileHash = md5_file($uploadDirectory . $file);

                    if ($uploadedFileHash === $currentFileHash) {
                        echo '/uploads/' . $file;
                        return;
                    }
                }
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                echo '/uploads/' . $fileName;
            } else {
                echo 'Error uploading file.' . '/uploads/' . $fileName;
            }
        } else {
            echo null;
        }
    }
}