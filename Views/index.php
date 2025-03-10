<?php

require 'partials/head.php';
require 'partials/header.php';
$pdo = $instance->getPDO();
$userModel = new UserModel($pdo);
$user = $userModel->selectAll();
?>

        <div class="row">
            <div class="col-md-3">
                <h1>Hello World</h1>
            </div>
            <div class="col-md-3">
                <?php echo htmlTag("h1", [], "Hello world with helper") ?>
            </div>
            <div class="col-md-3">
                <?php echo $user[0]; ?>
            </div>
           
        </div>

<?php require 'partials/footer.php' ?>
