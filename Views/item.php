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
                    <img src="<?php echo $item->getLienPhoto() ?>" class="img-fluid item-image" alt="placeholder">
                </div>
                <div class="col d-flex align-items-center flex-column m-3">
                <div class="bg-dark-yellow-fallout px-2 rounded-circle" style="transform: skew(0deg, 5deg);">
                        <div style="transform: skew(0deg, -5deg);">
                            <h2><?php echo $item->getNom() ?></h2>
                        </div>
                    </div>
                    <div class="bg-light-blue-fallout rounded m-3 mt-5">
                        <div class="m-3">
                            <p>Prix : <?php echo $item->getPrix() ?></p>
                            <p><?php echo $item->getDescription() ?></p>
                            <p><?php echo $item->getNom() ?> est de type : <?php echo $itemModel->translateType($item->getTypeItem()) ?></p>
                            <p>Poids : <?php echo $item->getPoids()?></p>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col d-flex m-3">
                    <div class="pb-2" data-coreui-size="lg" data-coreui-precision="0.10" data-coreui-read-only="true" data-coreui-toggle="rating" data-coreui-value="5"></div>
                </div>
                <div class="col d-flex align-items-center flex-column m-3">
                    <div class="flex-row bg-light-green-fallout cart-button btn">   
                        <i class="bi bi-cart-check m-2"></i><a href="/panier-achat">Ajouter au panier</a> <!-- make this add the item to the cart in the SESSION -->
                    </div>
                </div>
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