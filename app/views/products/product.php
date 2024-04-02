<?php include __DIR__ . '/../header.php'; ?>
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
                                <a href="product/addtocart/id?<?= $product->id ?>" class="btn btn-primary" id="add">+</a>
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
    document.getElementById('add').addEventListener('click', function(event){
        event.preventDefault();
        fetch('product/addtocart'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: <?= $product->id ?>
            }),
        }
        .then(response => response.json())
        .then(data => {
                if (response.ok) {
                    window.location.href = '/';
                } else {
                    alert('Login failed');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });
</script>