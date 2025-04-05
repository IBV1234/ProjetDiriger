<?php

    require "views/Partials/head.php";
    require "views/Partials/header.php";

?>

    <?php if (!empty($panier)): ?>
        <form method="post" id="payerForm" action="/payer">

            <div class="p-2 bg-white sticky-top d-flex flex-column flex-md-row justify-content-end align-items-center">
                <a class="btn btn-warning mx-2" href="/delete-item?id=all&idJoueur=<?= $_SESSION['user']->getId()?>">Abandoner le panier</a>
                <div class="d-flex align-items-center mx-2">
                    <img src="/public/images/caps_icon.webp" class="me-1 ratio ratio-1x1" height="25" alt="caps">
                    <h5 class="mt-1" id="caps" name="caps"><?= $caps ?></h5>
                </div>
                <h5 class="mx-2 mt-1">Dex: <span id="Dex" name="Dex"><?= $dexteriter ?></span></h5>
                <h5 class="mx-2 mt-1">Max: <?= maxPoids ?> lbs</h5>
                <div class="d-flex align-items-center mx-2">
                    <img src="/public/images/panier.png" class="me-1 ratio ratio-1x1" height="25" alt="panier">
                    <h5 class="mt-1" id="poidsTotal"><?= $poidsTotal ?>&nbsp;lbs</h5>
                </div>
                <div class="d-flex align-items-center mx-2">
                    <img src="/public/images/sac.png" class="me-1 ratio ratio-1x1" height="25" alt="sac">
                    <h5 class="mt-1" id="poidsSacDos" name="sac"><?= $poidsSacDos ?>&nbsp;lbs</h5>
                </div>

                <input type="hidden" name="poidsTotal" id="hiddenPoidsTotal" value="<?= $poidsTotal ?>">
                <input type="hidden" id="maxPoids" name="maxPoids" value="<?= maxPoids ?>">
                <input type="hidden" id="utilite" value="<?= $UtiliteInSac ?>">
            </div>

            <div class="px-5 d-flex flex-column justify-content-center align-items-center">
                <?php foreach ($panier as $key => $item): ?>
                    <div class="p-2 mb-3 bg-light-blue-fallout rounded rounded-3 d-flex justify-content-between align-items-center w-100 shadow">
                        <div class="d-flex flex-column justify-content-between align-items-center">
                            <h5><?= $item->getNom() ?></h5>
                            <img src="<?= $item->getLienPhoto() ?>" class="ratio ratio-16x9" height="150" alt="épée">
                            <h5>Poids: <?= $item->getPoids() ?> lb</h5>
                        </div>
                        <div>
                            <label class="h5" for="quantity-<?= $key ?>">Quantité :</label>
                            <input type="number" id="quantity-<?= $key ?>" name="items[<?= $key ?>][quantite]" value="<?=$item->getQuantitePanier()?>" min="1" max="<?= $item->getQteStock() ?>" data-price="<?= $item->getPrix() ?>">
                        </div>
                        <h5>Prix Unitaire: <?= $item->getPrix() ?>$</h5>
                        <a href="/delete-item?id=<?= $item->getIdItem() ?>&idJoueur=<?= $_SESSION['user']->getId()?>">
                            <i class="bx bx-x-circle" style="font-size: 30px;"></i>
                        </a>
                    </div>

                    <input type="hidden" name="items[<?= $key ?>][id]" value="<?= $item->getIdItem() ?>">
                    <input type="hidden" name="items[<?= $key ?>][poids]" value="<?= $item->getPoids() ?>">
                    <input type="hidden" name="items[<?= $key ?>][prix]" value="<?= $item->getPrix() ?>">
                    <input type="hidden" name="items[<?= $key ?>][utilites]" id="utilites" value="<?= $item->getUtilite() ?>">
                <?php endforeach ?>
            </div>

            <div class="p-2 d-flex justify-content-between align-items-center w-100">
                <input type="hidden" name="prixTotal" id="hiddenPrixTotal" value="<?= $prixTotal ?>">
                <h5 class="mx-2">Prix total: <?= $prixTotal ?>$</h5>

                <a class="text-black mx-2" href="/">Accueil</a>

                <button class="btn btn-success text-white p-3 mx-2" type="button" onclick="pay()" id="payer" name="payer">Payer</button>
            </div>
        </form>

    <?php else: ?>
        <div class="d-flex flex-column justify-content-center align-items-center p-5">
                <h5> Votre panier est vide </h5>
                <a class="h5 text-black" href="/"> Acceuil</a>
        </div>
    <?php endif ?>
</div>

</div>
<!-- htmlspecialchars:
ENT_QUOTES : Ce paramètre indique que les guillemets simples (') et doubles (")
 doivent être convertis en entités HTML. Par exemple, ' devient &#039; et " devient &quot;. 
 Cela aide à prévenir les injections de code malveillant dans les attributs HTML. 

'UTF-8':
 garantit que les caractères spéciaux sont correctement encodés et affichés, 
 surtout pour les applications multilingues.
-->
<?php

    require "views/Partials/footer.php";

?>