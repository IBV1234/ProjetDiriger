<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>
<div class="container-gros-index">

    <!-- aleatoire -->
    <a class="container-index" href="/random-question" style="text-decoration: none;">
        <p class="h2"  style="color: black;">Question aléatoire</p>
        <img src="/public/images/dice.gif" alt="des"  style="width:50%; height: 50%;" >
    </a>

    <!-- difficultes -->
    <div class="container-index border-gradient border-gradient-purple"  >
        <p class="h2">Question selon la difficulté</p>
        <div >
            <a href="/question?difficulty=easy" title="Facile" >
                <img src="/public/images/golden-star.png" alt="etoile-facile" class="star-green" style="width:90px; height: 90px;">
            </a>
            <a href="/question?difficulty=medium"title="Moyenne" >
                <img src="/public/images/golden-star.png" alt="etoile-moyenne" class="star-yellow" style="width:90px; height: 90px;">
            </a>
            <a href="/question?difficulty=hard" title="Difficile" >
                <img src="/public/images/golden-star.png" alt="etoile-difficile"  class="star-red" style="width:90px; height: 90px;">
            </a>
        </div>
    </div>
</div>

<?php require 'partialsEnigma/footer.php' ?>