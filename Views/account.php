<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="container-sm rounded-3 pb-5 bg-yellow-fallout">
    <div class="pt-4 d-flex justify-content-between align-items-center">
        <div></div><div></div>
        <p class="fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1 ms-5">Profil</p>
        <a class="mb-3 bg-lightblue-fallout account-display-modify px-2 pt-1 pb-1" href="/account-modify"><i class="bi bi-pencil-square"></i></a>
        <div></div>
    </div>
    <div class="container-sm px-4 py-5 rounded-3 bg-lightblue-fallout max-width-profil pb-4">
        <div class="mx-auto">
            <div class="d-flex mb-4 mt-n5"> 
                <img class="pfp-image mx-auto" src="public/images/placeholder-square.jpg">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Nom d'utilisateur<br>
                <input type="text" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Poid Maximum<br>
                <input type="text" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div><div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Capital<br>
                <input type="text" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div>
            <div class="mb-3 account-display mx-auto bg-lightblue-fallout-contrast p-2">
                Points de vie<br>
                <input type="text" class="form-control mt-1" disabled value="PLACEHOLDER">
            </div>
        </div>
    </div>
</div>

<?php require 'partials/footer.php' ?>