<?php

require 'partialsEnigma/head.php';
require 'partialsEnigma/header.php';

?>

<div class="container-egnime">
    <!-- premier message -->
    <p>
        <?= $messageAvant ?>
    </p>

    <!-- second message -->
    <p>
        <?= $messageApres ?>
    </p>
    
    <!-- image -->
    <img src="<?=$srcImage?>">

    <!-- retour a l'accueil -->
    <button type="submit" name="reponse" value="<?= $reponse->getIdReponse();?>" class="bouton-reponse">Retour à l'accueil</button>
</div>

<?php require 'partialsEnigma/footer.php' ?>