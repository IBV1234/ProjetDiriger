<?php
require "views/Partials/head.php";
require "views/Partials/header.php";
?>

<div class="container custom-container">

<input type="hidden" id="sessionEmpty" value="<?= $_SESSION['isEmptyPanier'] ? 'true' : 'false' ?>">
    <?php if (!empty($_SESSION['panier'])): ?>

        <form method="post" id="payerForm" action="/payer">
            <div class="container-info-inventaire sticky">
                <div class="text-decoration">Caps:  <span id="caps" name="caps"><?= $caps ?></span></div>
                <div class="text-decoration">Dex: <span id="Dex" name="Dex"><?= $dexteriter ?></span></div>

                <input type="hidden" id="maxPoids" name="maxPoids" value="<?= maxPoids ?>">
                <div class="text-decoration">Max: <?= maxPoids ?> lbs</div>
                <div class="text-decoration">
                    <img src="/public/images/sac.png" class="bag" alt="backpack" />
                    <span id="poidsTotal"><?= $poidsTotal ?></span> lbs
                    <input type="hidden" name="poidsTotal" id="hiddenPoidsTotal" value="<?= $poidsTotal ?>">
                </div>
            </div>

            <div class="row">
                <?php foreach ($_SESSION['panier'] as $key => $item): ?>
                    <div class="col">
                        <div class="mb-3">
                            <div class="mb-3 text-decoration"> <?= $item['nom'] ?></div>

                            <div class="containe-info">
                                <input type="hidden" name="items[<?= $key ?>][id]" value="<?= $item['id'] ?>">
                                <input type="hidden" name="items[<?= $key ?>][utilite]" id="utilite" value="<?= $item['utilite'] ?>">
                                <input type="hidden" name="items[<?= $key ?>][poids]" value="<?= $item['poids'] ?>">
                                <input type="hidden" name="items[<?= $key ?>][prix]" value="<?= $item['prix'] ?>">


                                <div class="mb-3">
                                    <img src="<?= $item['lienphoto'] ?>" class="img" alt="épée">
                                </div>

                                <div >
                                    <label class="text-decoration" for="quantity-<?= $key ?>">Quantité :</label>
                                    <input type="number"  id="quantity-<?= $key ?>" name="items[<?= $key ?>][quantite]" value="1"
                                        min="1" max="<?=$item['quantite']?>" data-price="<?= $item['prix'] ?>">
                                </div>
                                <div class="text-decoration">Prix Unitaire: <?= $item['prix'] ?>$</div>
                                <div class="content">
                                    <a href="/delete-item/?id=<?= $item['id'] ?>">
                                        <i class='bx bx-x-circle'></i>
                                    </a>
                                </div>
                            </div>
                            <div class="mb-3 text-decoration">Poids: <span id="poids"><?= $item['poids'] ?></span> lb</div>
                        </div>
                    </div>
                <?php endforeach ?>

                <div class="text-decoration stickyPrice">Prix total: <span class="text-decoration"
                        id="prixTotal"><?= $prixTotal ?></span>$</div>
                <input type="hidden" name="prixTotal" id="hiddenPrixTotal" value="<?= $prixTotal ?>">

                <div class="button-container">
                    <button class="btn btn-success button stickyBtn" type="button" onclick="pay()"  id ="payer"name="payer">Payer</button>
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

<?php
require "views/Partials/footer.php";
?>