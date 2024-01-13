<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShirtStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <div class=container>
    <p>Here are some of my shirts:</p>
    <?php
        foreach($products as $product){
            echo "<h2>" . $product->name . "</h2>";
            echo "<p>" . $product->description . "</p>";
            echo "<p>" . "$" . $product->price . "</p>";
            echo "<p>" . $product->category . "</p>";
        }
        ?>
        </div>
</body>
</html>