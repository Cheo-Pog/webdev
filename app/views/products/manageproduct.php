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
                        <button class="btn btn-primary" onClick="Add()">Add product</button>
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
                        <button class="btn btn-primary" onClick="Edit(<?= $product->id ?>)">edit</button>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-danger" onClick="Remove(<?= $product->id ?>)">remove</button>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
function Add(){
    window.location.href = "http://localhost/addproduct";
}
function Remove($id){
    window.location.href = "http://localhost/removeproduct/?productId=" + $id;
}
function Edit($id){
    window.location.href = "http://localhost/editproduct/?productId=" + $id;
}
</script>
</body>
</html>