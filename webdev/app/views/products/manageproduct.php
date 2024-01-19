<?php
require_once __DIR__ . '/../../modules/login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include '../Qol/navbar.php'; ?>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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