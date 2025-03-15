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
            <form action="index.php?action=login" method="post">
                <div class="mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Courriel" required>
                </div>
                <div class="mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="mb-3 form-check">
                    <input class="form-check-input" type="checkbox" value="remember" id="rememberBox">
                    <label class="form-check-label" for="rememberBox">
                        Se souvenir de moi
                    </label>
                </div>
                <button type="submit" class="btn btn-dark btn-block w-100">Se connecter</button>
            </form>
            <div class="pt-5">
                <p class="text-center mt-3 p-2 rounded-3" style="background: white;">Pas encore inscrit ? Inscris-toi !</p>
                <button type="submit" class="btn btn-dark btn-block w-100">Inscription</button>
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php' ?>