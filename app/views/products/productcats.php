<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CatStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class=container>
        <div class="row">
            <h1 class="col-12 text-center">Here are some of my cats:</h1>
            <?php
            foreach ($products as $product) {
                ?>
                <div class='col-sm-12 col-md-6 col-xl-4 col-xxl-2 mb-5'>
                    <div class="card-body h-100">
                        <img src="<?= $product->image ?>" alt="<?= $product->name ?>" class="card-img-top">
                        <h5 class="card-title"><?= $product->name ?></h5>
                        <p class="card-text"><?= $product->description ?></p>
                    </div>
                    <div class="card-footer">
                        <button class="float-end btn btn-primary">+</button>
                        <span><?= number_format($product->price, 2, '.') ?></span>
                    </div>
                </div>
                <?php
                }
            ?>
        </div>
    </div>
</body>
</html>