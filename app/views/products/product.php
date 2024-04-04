<?php include __DIR__ . '/../header.php'; ?>
<div class="container">
    <div class="row">
        <h1 class="col-12 text-center">Here are some of my
            <?= $products[0]->category ?>
        </h1>
        <?php foreach ($products as $product) { ?>
            <div class="col-md-4 col-lg-2 col-6">
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
        <?php } ?>
    </div>
</div>

<script src="js/product.js"></script>

<?php include __DIR__ . '/../footer.php'; ?>