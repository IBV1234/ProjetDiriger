<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="row">
    <div class="col d-flex align-items-end flex-column mb-3"> <!-- header -->
        <a class="btn bg-dark-yellow-fallout" href="/">Retour</a>
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
                                    <div class="bg-dark-yellow-fallout px-2 rounded-circle"
                                        style="transform: skew(0deg, 5deg);">
                                        <div style="transform: skew(0deg, -5deg);" class="d-flex">
                                            <h2><?= $item->getPrix() ?></h2>
                                            <img src="/public/images/caps_icon.webp" alt="caps" width="30" height="30"
                                                class="mt-2 ms-1">
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
                        <button class="flex-row bg-light-green-fallout cart-button btn" type="submit" <?php echo $item->getQteStock() > 0 ? "" : "disabled" ?>>
                            <i class="bi bi-cart-check m-2"></i>Ajouter au panier
                            <!-- make this add the item to the cart in the SESSION -->
                        </button>
                        <div class="flex-row bg-light-blue-fallout p-1 rounded mt-1">Quantité en stock :
                            <?php echo $item->getQteStock() ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-comments">
        <!-- comment container {NOT TO DO IN SPRINT 1} -->
        <div id="icon-message" class="<?= $visibilityIconAddMessageIcon ? '' : 'hide-add-message' ?>"
            style="position: absolute; right: 20px; top:10px;" title="Ajouter un commentaire">
            <button type="button" style="background: none; border: none;"
                onclick="showTextAerea(this)"><!-- lorsqu'on clique on mettra visible le textarea afin on puisse écrire et lorsqu'on apuui enter on rend invisible, et on l'nevoi au controller-->
                <img width="30px" height="30px" src="public/images/Add-message.png">

            </button>
        </div>
        <div class="add-comment">
            <form method="post" style="width: 100%;" id="ajoutCommentaire" action="/ajout-commentaire">
                <input type="hidden" name="idItem" value="<?= $_SESSION['item']->getIdItem() ?>">
                <textarea style="width: 80%;" name="comment" id="comment" placeholder="Entrez votre commentaire"
                    maxlength="35"></textarea>
                <div>
                    <label class="h5" id="labelQt" for="quantity">Nombre d'étoile :</label>
                    <input type="number" id="quantity" name="evaluation" id="evaluation" value="" min="0" max="5">
                </div>
            </form>
        </div>
        <div class="container-body-comment">

            <?php if (!empty($comentaires)): ?>

                <?php foreach ($comentaires as $key => $commentaire): ?>
                    <div class="container-icon-comment">
                        <div style="border-right: 2px solid black;">
                            <img class="img-icon" src="public/images/icon-user.png" class="icon-User">
                        </div>
                        <div>
                            <p style="font-weight: bold; color:blue;"> <?= $commentaire->getAlias(); ?> a dit:</p>

                        </div>
                        <div>
                            <p style="font-weight: bold;text-decoration: underline;"> <?= $commentaire->getLeCommentaire(); ?>
                            </p>
                        </div>
                        <?php if ($visibilityIconAddMessageIcon): ?>
                            <div class="<?= $commentaire->getIdJoueur() === $_SESSION['user']->getId() ? '':'hide-add-message'?>">
                                <a href="/delete-comment?id=<?= $commentaire->getIdItem() ?>">
                                    <img style="height:30px; height: 30px;" src="public/images/delete-icon.png" class="icon-User">

                                </a>
                            </div>
                        <?php endif ?>

                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <div class="noComment">
                    <p> l'item n'a aucun commentaire pour l'instant</p>
                </div>
            <?php endif ?>
        </div>

    </div>
</div>

<?php

require 'partials/footer.php';
?>