<?php include __DIR__ . '/../header.php'; ?>

<div class=container>
    <h1>Welcome to my website</h1>
</div>
<h2 class="text-center">Check out some of our products!</h2>
<div class="container">
    <div class="row">
        <?php
        foreach ($randomProducts as $product) {
            ?>
            <div class="col-md-4 col-lg-2 col-6 mt-3">
                <div class="card h-100">
                    <img src="../<?= $product->image ?>" alt="<?= $product->name ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <?= $product->name ?>
                        </h5>
                        <p class="card-text">
                            <?= $product->description ?>
                        </p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-top pt-2 card-footer">
                        <span class="h4">€
                            <?= number_format($product->price, 2, '.', ',') ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center border-top pt-2 card-footer">
                        <button value="<?= $product->id ?>" class="btn btn-primary add-btn col-12" id="add">add to cart</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script src="js/product.js"></script>

<?php
include __DIR__ . '/../footer.php';
?>