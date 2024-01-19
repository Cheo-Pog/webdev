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
        <div class="col-12 text-center"><h1>manage users</h1></div>
        <div class="col-12 text-center">
                <div class="row">
                <div class="col-3">
                        <p>id</p>
                    </div>
                    <div class="col-3">
                        <p>username</p>
                    </div>
                    <div class="col-3">
                        <p>rank</p>
                    </div>
                </div>
            </div>
        <?php
        foreach($users as $user){
            ?>
            <div class="col-12 text-center border-top border-2 border-dark pt-2">
                <div class="row">
                <div class="col-3">
                        <p><?php echo $user->GetId(); ?></p>
                    </div>
                    <div class="col-3">
                        <p><?php echo $user->getUsername(); ?></p>
                    </div>
                    <div class="col-3">
                        <p><?php echo $user->getRank(); ?></p>
                    </div>
                    <div class="col-2">
                        <?php if ($user->getRank() == "admin"){?>
                            <button class="btn btn-primary" onClick="demote(<?= $user->GetId() ?>)">demote to customer</button>
                        <?php }else{ ?>
                            <button class="btn btn-primary" onClick="promote(<?= $user->GetId() ?>)">promote to admin</button>
                        <?php } ?>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-danger" onClick="Remove(<?= $user->GetId() ?>)">remove</button>
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
function promote(id){
    window.location.href = "http://localhost/promoteuser/?userId=" + id;
}
function demote(id){
    if(<?php echo $_SESSION['currentuser']->GetId(); ?> == id){
        alert("you cant demote yourself");
        return;
    }
    else{
        window.location.href = "http://localhost/demoteuser/?userId=" + id;
    }
}
function Remove(id){
    if(<?php echo $_SESSION['currentuser']->GetId(); ?> == id){
        alert("you cant remove yourself");
        return;
    }
    else{
    window.location.href = "http://localhost/removeuser/?userId=" + id;
    }
}
</script>
</body>
</html>