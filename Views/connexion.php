<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="container-sm rounded-3 pb-5 bg-yellow-fallout">
    <div class="pt-4 d-flex justify-content-center">
        <p class="d-inline-block fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1">Connexion</p>
    </div>
    <div class="container-sm px-4 py-5 rounded-3 bg-blue-fallout max-width-connexion pb-4">
        <div class="mx-auto">
            <form method="post">
                <div class="mb-3">
                    <?php if($isRemembered): ?>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Courriel" required value=<?=$email?>>
                    <?php else: ?>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Courriel" required>
                    <?php endif;?>
                </div>
                <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="mb-3 form-check">
                    <?php if($isRemembered): ?>
                        <input class="form-check-input" type="checkbox" value="remember" name="rememberBox" id="rememberBox" checked="true">
                    <?php else: ?>
                        <input class="form-check-input" type="checkbox" value="remember" name="rememberBox" id="rememberBox">
                    <?php endif;?>
                    <label class="form-check-label" for="rememberBox">
                        Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="btn btn-dark btn-block w-100">Se connecter</button>
            </form>
            <div class="pt-5">
                <p class="text-center mt-3 p-2 rounded-3" style="background: white;">Pas encore inscrit ? Inscris-toi !</p>
                <a href="/inscription" class="btn btn-dark btn-block w-100">Inscription</a>
            </div>
        </div>
        <?php if($_SESSION['error']): ?>
            <div class="alert alert-danger mt-3" role="alert"><?=$_SESSION['error']?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>
</div>

<?php require 'partials/footer.php' ?>