<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="container-sm rounded-3 pb-5 bg-yellow-fallout">
    <div class="pt-4 d-flex justify-content-center">
        <p class="d-inline-block fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1">Profil</p>
    </div>
    <div class="container-sm px-4 py-5 rounded-3 bg-lightblue-fallout max-width-profil pb-4">
        <div class="mx-auto">
            <div class="d-flex mb-4 mt-n5"> 
                <img class="pfp-image mx-auto" src="public/images/placeholder-square.jpg">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Nom & Prenom<br>
                <input type="text" class="form-control mt-1" disabled value="PLACEHOLDER PLACEHOLDER">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Nom d'utilisateur<br>
                <input type="text" class="form-control mt-1" value="PLACEHOLDER">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Email<br>
                <input type="email" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Mot de passe<br>
                <input type="password" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php' ?>