<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>
<div class="container-gros-index">
    <!-- aleatoire -->
    <div class="container-index">
        <p>Question aléatoire</p>
        <img src="/public/images/dice.png" alt="des" style="width:50%; height: 50%;" >
    </div>

    <!-- difficultes -->
    <div class="container-index">
        <p>Question selon la difficulté</p>
        <div>
            <a>
                <img src="/public/images/golden-star.png" alt="etoile-facile" style="width:90px; height: 90px;" >
            </a>
            <a>
                <img src="/public/images/golden-star.png" alt="etoile-moyenne" style="width:90px; height: 90px;" >
            </a>
            <a>
                <img src="/public/images/golden-star.png" alt="etoile-difficile" style="width:90px; height: 90px;" >
            </a>
        </div>
    </div>
</div>

<?php require 'partialsEnigma/footer.php' ?>