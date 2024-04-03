<?php include __DIR__ . '/../header.php'; ?>
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
</div>
<script>
</script>