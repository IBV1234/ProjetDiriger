<?php
require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';
?>

<div class="container-egnime">
    <!-- difficulte -->
    <div>
        <p style="font-weight: bold; font-size: 17px; color:#b9b3b3;;"> Question
            <span><?= $question->getdifficulteInLetters() ?></span>
        </p>
    </div>

    <!-- enonce -->
    <div style="justify-content: center; text-align: center;">
        <p style="font-weight: bold; font-size: 17px;"><?= $question->getEnonce() ?></p>
    </div>

    <!-- reponses multiples -->
    <div class="bouton-container">
        <form method="POST" class="bouton-container">
            <input type="hidden" name="idEgnime" value="<?= $question->getIdEgnime() ?>">
            <!-- en attent de la procédure réponse <?php foreach ($questions as $key => $question): ?>
                <div class="col-4"style="font-weight: bold; font-size: 17px;">
                    <p> <?= $question->getEnonce() ?></p>
                </div>
                <?php endforeach; ?> -->
            <button type="submit" name="reponse" value="vert" class="bouton-reponse">
                Vert
            </button>
            <button type="submit" name="reponse" value="rouges" class="bouton-reponse">
                Rouge
            </button>
        </form>
    </div>
</div>

<?php require 'partialsEnigma/footer.php' ?>