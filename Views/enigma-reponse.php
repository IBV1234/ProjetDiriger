<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>

<div class="container-egnime">
    <!-- premier message -->
    <p class="h5" style="text-align: center;"><?= $messageAvant ?></p>

    <!-- second message -->
    <p class="h5" style="text-align: center;"><?= $messageApres ?></p>
    
    <!-- image -->
    <img src="<?=$srcImage?>" style="width: 70%; height: auto;">

    <!-- retour a l'accueil -->
    <a href="/enigma" class="bouton-reponse" style="color:black; text-decoration-line: none;">Retour à l'accueil</a>
</div>

<?php require 'partialsEnigma/footer.php' ?>