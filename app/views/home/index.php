<?php
include __DIR__ . '/../header.php';
use App\Services\ProductService;

?>

<div class=container>
    <h1>Welcome to my website</h1>
</div>
<?php
$productservice = new ProductService();
$products = $productservice->getAllProducts();
$randomKeys = array_rand($products, 6);
$randomProducts = array_intersect_key($products, array_flip($randomKeys)); ?>
<h2 class="text-center">Check out some of our products!</h2>
<div class="container">
    <div class="row">
        <?php
        foreach ($randomProducts as $product) {
            ?>
            <div class='col-sm-12 col-md-6 col-xl-4 col-xxl-2 mb-5 mt-5'>
                <div class="card d-flex flex-column h-100">
                    <img src="../<?= $product->image ?>" alt="<?= $product->name ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <?= $product->name ?>
                        </h5>
                        <p class="card-text">
                            <?= $product->description ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center border-top border-2 pt-2 mt-auto">
                            <span class="h4">
                                <?= number_format($product->price, 2, '.', ',') ?> €
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
<script>
</script>
<?php
include __DIR__ . '/../footer.php';
?>