<?php

use app\services\ProductService;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <main>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
                aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsExample03">
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/home/about">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="true">Products</a>
                        <ul class="dropdown-menu">
                            <?php
                            $productservice = new ProductService();
                            $categories = $productservice->getUniqueCategories();
                            foreach ($categories as $category) {
                                ?>
                            <li><a class="dropdown-item"
                                    href="http://localhost/product/?category=<?= $category->category ?>">
                                    <?= $category->category ?>
                                </a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (!isset($_SESSION['currentUser'])): ?>
                    <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="dropdown"
                        data-bs-target="#exampleModal">Login</button>
                    <ul class="dropdown-menu float_end dropdown-menu-end">
                        <li><a class="dropdown-item" href="/login/">login</a></li>
                        <li><a class="dropdown-item" href="/login/register">register</a></li>
                    </ul>
                    <?php else: ?>
                    <button type="button" class="btn btn-outline-light me-2" data-bs-toggle="dropdown"
                        data-bs-target="#exampleModal">
                        <?= $_SESSION['currentUser']->firstname; ?>
                    </button>
                    <ul class="dropdown-menu float_end dropdown-menu-end">
                        <li><a class="dropdown-item" href="/user/edit">profile</a></li>
                        <li><a class="dropdown-item" href="/user/logout">logout</a></li>
                    </ul>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="">