<?php include __DIR__ . "/../header.php"; ?>
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
<?php include __DIR__ . "/../footer.php"; ?>