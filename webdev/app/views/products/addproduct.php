<?php
require_once __DIR__ . '/../../modules/login.php';
require_once __DIR__ . '/../../services/productservice.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // Check if an image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
    } else {
        $image = null;
    }

    $productService = new ProductService();
    $productService->addProduct($name, $price, $description, $image, $category);
    header('Location: http://localhost/manageproduct');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AddOrEdit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <?php include '../Qol/navbar.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1>add product</h1>
            </div>
            <div class="col-12 text-center">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <label for="name">name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="description">description</label>
                            <input type="text" name="description" id="description" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="price">price</label>
                            <input type="price" name="price" id="price" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="category">category</label>
                            <input type="text" name="category" id="category" class="form-control">
                        </div>
                        <div class="col-12 text-center">
                            <input class="tm-2" type="file" name="image" id="image">
                        </div>
                        <div class="col-12 text-center">
                            <input type="submit" value="submit" class="btn btn-primary mt-2">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script>

        </script>
</body>

</html>