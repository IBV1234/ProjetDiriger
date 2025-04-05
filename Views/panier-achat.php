<?php
require "views/Partials/head.php";
require "views/Partials/header.php";
?>

<div class="container custom-container">

    <input type="hidden" id="sessionEmpty" value="<?= $_SESSION['isEmptyPanier'] ? 'true' : 'false' ?>">
    <?php if (!empty($panier)): ?>

        <form method="post" id="payerForm" action="/payer">
            <div class="container-info-inventaire sticky">
                <div clas="deleteAllItem"> <a href="/delete-item?id=all&idJoueur=<?= $_SESSION['user']->getId()?>" a> Abandoner le panier </a> </div>

                <div class="text-decoration">
                    <img src="/public/images/caps.png" class="bag" alt="caps" />
                    <span id="caps" name="caps"><?= $caps ?></span>
                </div>
                <div class="text-decoration">Dex: <span id="Dex" name="Dex"><?= $dexteriter ?></span></div>

                <input type="hidden" id="maxPoids" name="maxPoids" value="<?= maxPoids ?>">
                <div class="text-decoration">Max: <?= maxPoids ?> lbs</div>
                <div class="text-decoration">
                    <img src="/public/images/panier.png" class="bag" alt="panier" />
                    <span id="poidsTotal"><?= $poidsTotal ?></span> lbs
                    <input type="hidden" name="poidsTotal" id="hiddenPoidsTotal" value="<?= $poidsTotal ?>">
                </div>
                <div class="text-decoration">
                    <img src="/public/images/sac.png" class="bag" alt="sac" />
                    <span id="poidsSacDos" name="sac"><?= $poidsSacDos ?></span>
                    lbs
                </div>
                <input type="hidden" id="utilite" value="<?= $UtiliteInSac ?>">

            </div>

            <div class="row">
                <?php foreach ($panier as $key => $item): ?>
                    <div class="col">
                        <div class="mb-3">
                            <div class="mb-3 text-decoration"> <?= $item->getNom() ?>
                            </div>

                            <div class="containe-info">
                                <input type="hidden" name="items[<?= $key ?>][id]" value="<?= $item->getIdItem() ?>">
                                <input type="hidden" name="items[<?= $key ?>][poids]" value="<?= $item->getPoids() ?>">
                                <input type="hidden" name="items[<?= $key ?>][prix]" value="<?= $item->getPrix() ?>">
                                <input type="hidden" name="items[<?= $key ?>][utilites]" id="utilites"
                                    value="<?= $item->getUtilite() ?>">

                                <div class="mb-3">
                                    <img src="<?= $item->getLienPhoto() ?>" class="img" alt="épée">
                                </div>

                                <div>
                                    <label class="text-decoration" for="quantity-<?= $key ?>">Quantité :</label>
                                    <input type="number" id="quantity-<?= $key ?>" name="items[<?= $key ?>][quantite]" value="<?=$item->getQuantitePanier()?>"
                                        min="1" max="<?= $item->getQteStock() ?>" data-price="<?= $item->getPrix() ?>">
                                </div>
                                <div class="text-decoration">Prix Unitaire:
                                    <?= $item->getPrix() ?>$
                                </div>
                                <div class="content">
                                    <a
                                        href="/delete-item?id=<?= $item->getIdItem() ?>&idJoueur=<?= $_SESSION['user']->getId()?>">
                                        <i class='bx bx-x-circle'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3 text-decoration">Poids: <span
                                    id="poids"><?= $item->getPoids() ?></span> lb</div>
                        </div>
                    </div>
                <?php endforeach ?>

                <div class="text-decoration stickyPrice">Prix total: <span class="text-decoration"
                        id="prixTotal"><?= $prixTotal ?></span>$</div>
                <input type="hidden" name="prixTotal" id="hiddenPrixTotal"
                    value="<?= $prixTotal ?>">

                <div class="button-container">
                    <button class="btn btn-success button stickyBtn" type="button" onclick="pay()" id="payer"
                        name="payer">Payer</button>
                </div>
                <div><a class="acceuil" href="/">Accueil</a></div>
            </div>
        </form>

    <?php else: ?>
        <div class="container-empty">
            <div>
                <p class="text-decoration"> Votre panier est vide </p>
            </div>
            <div> <a class="acceuil" href="/"> Acceuil</a></div>
        </div>
        </form>
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