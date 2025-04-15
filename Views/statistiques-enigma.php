<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>

<div class="container-index">
    <p class="text-titre">Vos statistiques personnelles !</p>
    <p>Vous avez eu <span class="text-titre"><?=$bonnesReponses?></span> bonnes réponses.</p>
    <p>Vous avez eu <span class="text-titre"><?=$mauvaisesReponses?></span> mauvaises réponses.</p>
</div>

<?php require 'partialsEnigma/footer.php' ?>