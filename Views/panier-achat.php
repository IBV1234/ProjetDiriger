<?php
require "views/Partials/head.php";
require "views/Partials/header.php";
?>

<div class="container custom-container">

    <input type="hidden" id="sessionEmpty" value="<?= $_SESSION['isEmptyPanier'] ? 'true' : 'false' ?>">
    <?php if (!empty($panier)): ?>

        <form method="post" id="payerForm" action="/payer">
            <div class="container-info-inventaire sticky">
            <div clas="deleteAllItem"> <a href="/delete-item/?id=all" a> Abandoner le panier </a> </div>

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
                            <div class="mb-3 text-decoration"> <?= htmlspecialchars($item->getNom(), ENT_QUOTES, 'UTF-8') ?>
                            </div>

                            <div class="containe-info">
                                <input type="hidden" name="items[<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>][id]"
                                    value="<?= htmlspecialchars($item->getIdItem(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="items[<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>][poids]"
                                    value="<?= htmlspecialchars($item->getPoids(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="items[<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>][prix]"
                                    value="<?= htmlspecialchars($item->getPrix(), ENT_QUOTES, 'UTF-8') ?>">
                                <input type="hidden" name="items[<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>][utilites]"
                                    id="utilites" value="<?= htmlspecialchars($item->getUtilite(), ENT_QUOTES, 'UTF-8') ?>">

                                <div class="mb-3">
                                    <img src="<?= htmlspecialchars($item->getLienPhoto(), ENT_QUOTES, 'UTF-8') ?>" class="img"
                                        alt="épée">
                                </div>

                                <div>
                                    <label class="text-decoration"
                                        for="quantity-<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>">Quantité :</label>
                                    <input type="number" id="quantity-<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>"
                                        name="items[<?= htmlspecialchars($key, ENT_QUOTES, 'UTF-8') ?>][quantite]" value="1"
                                        min="1" max="<?= htmlspecialchars($item->getQteStock(), ENT_QUOTES, 'UTF-8') ?>"
                                        data-price="<?= htmlspecialchars($item->getPrix(), ENT_QUOTES, 'UTF-8') ?>">
                                </div>
                                <div class="text-decoration">Prix Unitaire:
                                    <?= htmlspecialchars($item->getPrix(), ENT_QUOTES, 'UTF-8') ?>$</div>
                                <div class="content">
                                    <a
                                        href="/delete-item/?id=<?= htmlspecialchars($item->getIdItem(), ENT_QUOTES, 'UTF-8') ?>&idJoueur=<?= htmlspecialchars($_SESSION['user']->getId(), ENT_QUOTES, 'UTF-8') ?>">
                                        <i class='bx bx-x-circle'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3 text-decoration">Poids: <span
                                    id="poids"><?= htmlspecialchars($item->getPoids(), ENT_QUOTES, 'UTF-8') ?></span> lb</div>
                        </div>
                    </div>
                <?php endforeach ?>

                <div class="text-decoration stickyPrice">Prix total: <span class="text-decoration"
                        id="prixTotal"><?= htmlspecialchars($prixTotal, ENT_QUOTES, 'UTF-8') ?></span>$</div>
                <input type="hidden" name="prixTotal" id="hiddenPrixTotal"
                    value="<?= htmlspecialchars($prixTotal, ENT_QUOTES, 'UTF-8') ?>">

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