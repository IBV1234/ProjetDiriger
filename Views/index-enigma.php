<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>
<div class="container-gros-index">

    <!-- aleatoire -->
    <a class="container-index" href="/random-question" style="text-decoration: none;">
        <p class="h2" style="color: black;">Question aléatoire</p>
        <img src="/public/images/dice.png" alt="des" style="width:50%; height: 50%;" >
    </a>

    <!-- difficultes -->
    <div class="container-index">
        <p class="h2">Question selon la difficulté</p>
        <div>
            <a href="/question?difficulty=easy">
                <img src="/public/images/golden-star.png" alt="etoile-facile" style="width:90px; height: 90px;">
            </a>
            <a href="/question?difficulty=medium">
                <img src="/public/images/golden-star.png" alt="etoile-moyenne" style="width:90px; height: 90px;">
            </a>
            <a href="/question?difficulty=hard">
                <img src="/public/images/golden-star.png" alt="etoile-difficile" style="width:90px; height: 90px;">
            </a>
        </div>
    </div>
</div>

<?php require 'partialsEnigma/footer.php' ?>