<?php
require_once __DIR__ . '/../../modules/login.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../style.css">
</head>

<body>
    <!--include the navbar COPY PASTE THIS-->
    <?php include '../Qol/navbar.php'; ?>
    <div class=container>
        <div class="row">
            <h1 class="col-12 text-center">Here are some of my <?php echo $products[0]->category; ?>:</h1>
            <?php
            foreach ($products as $product) {
                ?>
                <div class='col-sm-12 col-md-6 col-xl-4 col-xxl-2 mb-5'>
                    <div class="card h-100" >
                        <img src="../<?= $product->image ?>" alt="<?= $product->name ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <?= $product->name ?>
                            </h5>
                            <p class="card-text">
                                <?= $product->description ?>
                            </p>
                            <div class="d-flex justify-content-between align-items-center border-top border-2 pt-2">
                                <span class="h4">
                                    € <?= number_format($product->price, 2, '.', ',') ?> 
                                </span>
                                <a href="#" onclick="onClick(<?= $product->id ?>)" class="btn btn-primary">+</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        function onClick(productId){
            if(<?php echo isset($_SESSION['currentuser']) ? 1 : 0 ?> == 0){
                alert("You need to be logged in to add to cart");
            }
            else{
                location.href = "http://localhost/addtocart/?productId=" + productId;
            }
        }
    </script>
</body>
</body>
</html>