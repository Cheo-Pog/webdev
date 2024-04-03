<?php
include __DIR__ . '/../header.php';
?>
<div class="container">
        <div class="col-12 text-center"><h1>manage products</h1></div>
        <div class="col-12 text-center">
                <div class="row">
                <div class="col-2">
                        <p>id</p>
                    </div>
                    <div class="col-2">
                        <p>name</p>
                    </div>
                    <div class="col-2">
                        <p>description</p>
                    </div>
                    <div class="col-2">
                        <p>price</p>
                    </div>
                    <div class="col-2">
                        <p>category</p>
                    </div>
                    <div class="col-2">
                        <a class="btn btn-primary" href="">Add product</a>
                    </div>
                </div>
            </div>
        <?php
        foreach($products as $product){
            ?>
            <div class="col-12 text-center border-top border-2 border-dark pt-2">
                <div class="row">
                <div class="col-2">
                        <p><?php echo $product->id; ?></p>
                    </div>
                    <div class="col-2">
                        <p><?php echo $product->name; ?></p>
                    </div>
                    <div class="col-2">
                        <p><?php echo $product->description; ?></p>
                    </div>
                    <div class="col-2">
                        <p><?php echo $product->price; ?></p>
                    </div>
                    <div class="col-2">
                        <p><?php echo $product->category; ?></p>
                    </div>
                    <div class="col-1">
                        <a class="btn btn-primary" href="">edit</a>
                    </div>
                    <div class="col-1">
                        <a class="btn btn-danger" href="">remove</a>
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
