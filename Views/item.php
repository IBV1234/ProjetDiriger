<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="row">
    <div class="col d-flex align-items-end flex-column mb-3"> <!-- header -->
        <a class="btn bg-dark-yellow-fallout" href="/">Retour</a>
    </div>
    <div class="w-100">
        <div class="bg-blue-fallout d-flex rounded m-3"> <!-- body item container -->
            <div class="row">
                <div class="col d-flex align-items-center flex-column m-3">
                    <img src="<?php echo $item->getLienPhoto() ?>" class="img-fluid item-image image-bg" alt="placeholder">
                </div>
                <div class="col d-flex align-items-center flex-column m-3">
                <div class="bg-dark-yellow-fallout px-2 py-4 rounded-circle" style="transform: skew(0deg, 3deg);">
                        <div style="transform: skew(0deg, -3deg);">
                            <h2><?php echo $item->getNom() ?></h2>
                        </div>
                    </div>
                    <div class="bg-light-blue-fallout rounded m-3 mt-5">
                        <div class="m-3">
                            <p>Prix : <?php echo $item->getPrix() ?>$</p>
                            <p><?php echo $item->getDescription() ?></p>
                            <p><?php echo $item->getNom() ?> est de type : <?php echo $item->getType() ?></p>
                            <p>Poids : <?php echo $item->getPoids()?> lbs</p>
                            <p>Utilité : <?php echo $item->getUtilite()?></p>
                            <p>Rating : <?php echo $item->getEvaluation()?></p>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col d-flex m-3">
                    <div class="pb-2" data-coreui-size="lg" data-coreui-precision="0.10" data-coreui-read-only="true" data-coreui-toggle="rating" data-coreui-value="<?php echo $item->getEvaluation()?>"></div>
                </div>
                <form method="POST">
                    <div class="col d-flex align-items-center flex-column m-3">
                        <button class="flex-row bg-light-green-fallout cart-button btn" type="submit" <?php if($item->getQteStock() <= 0) {echo 'disabled';} ?>>   
                            <i class="bi bi-cart-check m-2"></i>Ajouter au panier <!-- make this add the item to the cart in the SESSION -->
                        </button>
                        <div class="flex-row bg-light-blue-fallout p-1 rounded mt-1">Quantité en stock : <?php echo $item->getQteStock()?></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div> 
<!-- comment container {NOT TO DO IN SPRINT 1} -->
    </div>
</div>

<?php

require 'partials/footer.php';
?>