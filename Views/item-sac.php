<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="row">
    <div class="col d-flex align-items-end flex-column mb-3"> <!-- header -->
        <a class="btn bg-dark-yellow-fallout" href="/inventaire">Retour</a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="bg-blue-fallout d-flex m-3 item-container pt-2"> <!-- body item container -->
            <div class="row item-row-container">
                <div class="col d-flex align-items-center flex-column m-3 mt-5 position-relative">
                    <img src="<?php echo $item->getLienPhoto() ?>" class="item-image image-bg" alt="placeholder">
                    <img src="<?php echo getItemTypeIcon($item->getType()) ?>" class="img-fluid item-type-icon m-2">
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
                                    <div class="bg-dark-yellow-fallout px-2 rounded-circle"
                                        style="transform: skew(0deg, 5deg);">
                                        <div style="transform: skew(0deg, -5deg);">
                                            <h2>
                                                <img src="/public/images/sac.png" class="bag" alt="panier" />
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
                <form method="POST" id="sell_eat_form">
                    <div class="col d-flex justify-content-around align-items-center m-3">
                        <!-- donné à envyoyer au fichier js controller-dexteriter -->
                        <input type="hidden" name="dexteriter" id="dexteriter"
                            value="<?= $_SESSION['user']->getDexterite() ?>">
                        <input type="hidden" name="vie" id="vie" value="<?= $_SESSION['user']->getHp() ?>">
                        <input type="hidden" name="idItem" id="idItem" value="<?= $item->getIdItem() ?>">
                        <!-- ---------------------------------------------------------------- -->

                        <input type="hidden" name="action" id="action">
                        <button class="flex-row bg-light-red-fallout cart-button btn" type="button" id="sell"
                            onclick="sell_eat_btn('sell')" name="action" value="sell" <?php echo $itemQt > 0 ? "" : "disabled" ?>>

                            <div class="sell-button"><i class="m-1 bi bi-cash-coin"> </i> Vendre </div>

                            <div class="bg-light-dark-red-fallout p-1 rounded mt-1 sell-button border border-black">
                                <p class="fw-bold m-2"><?php echo round($item->getPrix() / 3, 0) ?></p>
                                <img src="/public/images/caps_icon.webp" alt="caps" class="mb-2 caps-icon-index"
                                    width="25">
                            </div>

                            <?php if ($item->getType() == 'nourriture' || $item->getType() == 'medicament'): ?>
                                <button class="flex-row bg-light-green-fallout cart-button btn" type="button" id="use"
                                    onclick="sell_eat_btn('use')" name="action" value="use" <?php echo $itemQt > 0 ? "" : "disabled" ?>>
                                    <i class="m-2"><img src="../public/images/food-icon.png" width="25"></i>Consommer
                                </button>

                            <?php endif; ?>

                            <button class="flex-row bg-danger cart-button btn" type="submit" name="action"
                                value="delete" <?php echo $itemQt > 0 ? "" : "disabled" ?> <?php echo $userModel->canSellItem($_SESSION['user']->getId(), $item->getIdItem()) ? "" : "disabled" ?>>
                                <i class="m-2 bi bi-trash"></i>Jeter
                            </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <div>
                <p style="font-weight: bold;" id="message"></p>
            </div>
            <div>
                <button type="button" id="okBtn">Continuer</button>
                <button type="button" id="cancelBtn"> Annuler</button>
            </div>
        </div>
    </div>
</div>
<?php

require 'partials/footer.php';
?>