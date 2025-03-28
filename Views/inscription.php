<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="container-sm rounded-3 pb-5 bg-yellow-fallout">
    <div class="pt-4 d-flex justify-content-center">
        <p class="d-inline-block fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1">Inscription</p>
    </div>
    <div class="container-sm px-4 py-5 rounded-3 bg-light-blue-fallout max-width-connexion pb-4">
        <div class="mx-auto">
            <form method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" id="alias" name="alias" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prenom" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom" required>
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Courriel" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="passwordVerif" name="passwordVerif" placeholder="Confirmer le mot de passe" required>
                </div>
                <button type="submit" class="btn btn-dark btn-block w-100">S'inscrire</button>
            </form>
            <div class="pt-5">
                <p class="text-center mt-3 p-2 rounded-3" style="background: white;">Déjà inscrit ? Connecte-toi !</p>
                <a href="/connexion" class="btn btn-dark btn-block w-100">Connexion</a>
            </div>
        </div>
        <?php if($_SESSION['error']): ?>
            <div class="alert alert-danger mt-3" role="alert"><?=$_SESSION['error']?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
    </div>
</div>

<?php require 'partials/footer.php' ?>