<?php
require "views/partials/head.php";
require "views/partials/header.php";
?>



<div class="container-egnime-body">
    <div class="container-head">
        <div class="col">
        <a href="#" style="text-decoration: none; color: black;" >
        <div class="cercle">
                <div class="cercle-text-1">
                    ?
                </div>
                <div class="cercle-text-2">
                        Enigma
                 
                </div>
            </div>
        </a>
        </div> <!-- Ajout de mr-3 pour une marge à droite -->
        <div class="col cercle-text-2" style="font-size: 20px;">Monsieur Testeur</div>
        <div class="col cercle-text-2" style="font-size: 30px; "> 
            <a href="#">
                <img src="/public/images/bars.png" alt="bars" style="width:50px; height: 50px;" />

            </a>
        </div>

    </div>

    <div class="container-egnime">
        <div>
            <p style="font-weight: bold; font-size: 17px; color:#b9b3b3;;"> Question
                <span><?= $questions[0]->getdifficulteInLetters() ?></span>
            </p>
        </div>
        <div style="justify-content: center; text-align: center;">
            <p style="font-weight: bold; font-size: 17px;"><?= $questions[0]->getEnonce() ?></p>
        </div>

        <div style="width:100%; justify-content: center; align-items: center; margin-left: 35%;">
            <form method="POST">
                <input type="hidden" name="idEgnime" value="<?= $questions[0]->getIdEgnime() ?>">
                <!-- en attent de la procédure réponse <?php foreach ($questions as $key => $question): ?>
                    <div class="col-4"style="font-weight: bold; font-size: 17px;">
                        <p> <?= $question->getEnonce() ?></p>
                    </div>
                    <?php endforeach; ?> -->
                <button type="submit" name="reponse" value="vert" class="container-reponses">
                    <p> Vert</p>
                </button>
                <button type="submit" name="reponse" value="rouge" class="container-reponses">
                    <p> rouge</p>
                </button>
            </form>
        </div>
    </div>
</div>

<?php
require "views/partials/footer.php";
?>