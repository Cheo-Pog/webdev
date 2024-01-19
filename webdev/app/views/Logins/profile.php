<?php
require_once __DIR__ . '/../../modules/login.php';
require_once __DIR__ . '/../../modules/product.php';
require_once __DIR__ . '/../../services/productservice.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include '../Qol/navbar.php'; ?>
<div class="container">
        <div class="row">
            <div class = "col-4 container">
                <h1 class="text-center">Profile</h1>
                <p class="">Username: <?php echo $_SESSION['currentuser']->getUsername(); ?></p>
                <p class="">Rank: <?php echo $_SESSION['currentuser']->getRank(); ?></p>
                <?php
                if($_SESSION['currentuser']->getRank() == "admin"){
                    ?><button class="btn btn-primary mb-2" href="#" onclick="onManage()">manage products</button><?php
                    ?><button class="btn btn-primary mb-2 float-end" href="#" onclick="onUser()">manage Users</button><?php
                }
                ?>
            </div>
            <div class = "col-8 container">
                <h1 class="text-center">Orders</h1>
                <?php
                $total = 0;
                foreach( $orders as $order ){
                    $product = $productservice->getProductById($order->productId);
                    echo "<div class='row border-top border-2 border-dark'>";
                    echo "<div class='col-2'>";
                    echo "<p>" . $product->name . "</p>";
                    echo "</div>";
                    echo "<div class='col-4'>";
                    echo "<p>" . $product->description . "</p>";
                    echo "</div>";
                    echo "<div class='col-2'>";
                    echo "<p> €" . $product->price . "</p>";
                    echo "</div>";
                    echo "<div class='col-2'>";
                    echo "<input type='number' name='quantity' id=".$order->orderId."' value='" . $order->quantity . "' min='1' class='quantity-input form-control' onkeydown='return false'>";
                    echo "</div>";
                    echo "<div class='col-1'>
                        <button class='btn btn-danger' onClick='remove(". $order->orderId .")'>remove</button>
                    </div>";
                    echo "</div>";
                    $total += $product->price * $order->quantity;
                }
                ?>
                <p class="text-end">Total: €<?php echo $total; ?></p>
                <button class="btn btn-primary mb-2 float-end" href="#" onclick="onClick()">check out</button>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>
<script>
    function onClick(){
        var ordersExist = <?php echo $orders != null ? 'true' : 'false'; ?>;
        if(ordersExist){
        location.href = "http://localhost/checkout";
            alert("You have checked out (current version doesnt support any payment methods)");
        }
        else{
            alert("You need to have items in your cart to checkout");
        }
    }
    function onManage(){
        location.href = "http://localhost/manageproduct";
    }
    function onUser(){
        location.href = "http://localhost/manageuser";
    }
    function remove(orderId){
        window.location.href = "http://localhost/removefromcart/?orderId=" + orderId;
    }

    document.querySelectorAll('.quantity-input').forEach(function(input) {
    input.addEventListener('input', function(event) {
        if (event.target.value) {
            // Input field is filled in, update the page
            window.location.href = "http://localhost/updatequantity/?order=" + event.target.id + "&quantity=" + event.target.value;
        } 
    });
});
</Script>
</body>
</html>