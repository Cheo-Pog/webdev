<?php
$dropdownlogic = '<button type="button" class="btn btn-outline-light me-2" data-bs-toggle="dropdown"
data-bs-target="#exampleModal">Login</button>
<ul class="dropdown-menu float_end dropdown-menu-end">
        <li><a class="dropdown-item" href="http://localhost/login">login</a></li>
        <li><a class="dropdown-item" href="http://localhost/register">register</a></li>
</ul>';	
if (session_status() == PHP_SESSION_ACTIVE) { 
    if(isset($_SESSION['currentuser'])){
        $currentuser = $_SESSION['currentuser'];
            $dropdownlogic = '<button type="button" class="btn btn-outline-light me-2" data-bs-toggle="dropdown"
    data-bs-target="#exampleModal">'.$currentuser->getUsername().'</button>
    <ul class="dropdown-menu float_end dropdown-menu-end">
            <li><a class="dropdown-item" href="http://localhost/profile">profile</a></li>
            <li><a class="dropdown-item" href="http://localhost/logout">logout</a></li>
    </ul>';	
    }} 

    if (isset($_POST['logout'])) {
        session_destroy();
        header('Location: http://localhost');
        exit;
    }
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark" aria-label="Third navbar example">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03"
            aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample03">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/about">About</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                        aria-expanded="true">Products</a>
                    <ul class="dropdown-menu">
                        <?php
                            require_once '../services/productservice.php';
                            $productservice = new ProductService();
                            $categories = $productservice->getUniqueCategories();
                        foreach ($categories as $category) {
                            ?>
                            <li><a class="dropdown-item" href="http://localhost/product/?category=<?= $category->category ?>"><?= $category->category?></a></li>
                            <?php
                        }
                        ?>
                    </ul>
                </li>
            </ul>
            <li class="nav-item dropdown">
                <?php echo $dropdownlogic; ?>
            </li>
        </div>
    </div>
</nav>
