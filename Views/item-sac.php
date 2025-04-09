<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="row">
    <div class="col d-flex align-items-end flex-column mb-3"> <!-- header -->
        <a class="btn bg-dark-yellow-fallout" href="/inventaire">Retour</a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="bg-blue-fallout d-flex m-3 item-container"> <!-- body item container -->
            <div class="row item-row-container">
                <div class="col d-flex align-items-center flex-column m-3 mt-5 position-relative">
                    <img src="<?php echo $item->getLienPhoto() ?>" class="item-image image-bg" alt="placeholder">
                    <img src="<?php echo getItemTypeIcon($item->getType()) ?>" class="img-fluid item-type-icon m-2">
                    <div class="col d-flex justify-content-center stars">
                        <div class="pb-2" data-coreui-size="lg" data-coreui-precision="0.10"
                            data-coreui-read-only="true" data-coreui-toggle="rating"
                            data-coreui-value="<?php echo $item->getEvaluation() ?>"></div>
                    </div>
                </div>

                <div class="col d-flex align-items-center flex-column">
                    <div class="bg-dark-yellow-fallout px-2 py-4 rounded-circle" style="transform: skew(0deg, 3deg);">
                        <div style="transform: skew(0deg, -3deg);">
                            <h2><?php echo $item->getNom() ?></h2>
                        </div>
                    </div>
                    <div class="bg-light-blue-fallout rounded m-3 mt-5">
                        <div class="m-3">
                            <p class="fs-4 fw-semibold"><?php echo $item->getDescription() ?></p>
                            <div class="m-3 pt-3">
                                <div class="d-flex justify-content-around align-items-center w-100 mt-2">
                                <div class="bg-dark-yellow-fallout px-2 rounded-circle" style="transform: skew(0deg, 5deg);">
                                        <div style="transform: skew(0deg, -5deg);">
                                            <h2>
                                                <img src="/public/images/sac.png" class="bag" alt="panier" />
                                                <span></span>
                                                <?= $itemQt ?>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="bg-dark-yellow-fallout px-3 rounded-circle"
                                        style="transform: skew(0deg, 3deg);">
                                        <div style="transform: skew(0deg, -3deg);" class="d-flex">
                                            <img src="/public/images/weight.png" alt="caps"
                                                class="me-1 ratio ratio-1x1 caps-icon-index">
                                            <h2 class="price-weight"><?= $item->getPoids() ?></h2>
                                        </div>
                                    </div>
                                    <div class="bg-dark-yellow-fallout px-3 rounded-circle"
                                        style="transform: skew(0deg, 3deg);">
                                        <div style="transform: skew(0deg, -3deg);" class="d-flex">
                                            <img src="/public/images/utility-icon.png" alt="utility"
                                                class="me-1 ratio ratio-1x1 caps-icon-index">
                                            <h2 class="price-weight"><?= $item->getUtilite() ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100"></div>
                <form method="POST">
                    <div class="col d-flex align-items-center flex-column m-3">
                        <?php if($item->getType() == 'nourriture' || $item->getType() == 'medicament') : ?>
                            <button class="flex-row bg-light-green-fallout cart-button btn" type="submit" <?php echo $itemQt > 0 ? "" : "disabled" ?>>
                            <i class="m-2"><img src="../public/images/food-icon.png" width="25"></i>Consommer
                        </button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php

require 'partials/footer.php';
?>