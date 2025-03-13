<?php 
require "views/Partials/head.php" ; 
require "views/Partials/header.php" ; 
?>

    <div class="container custom-container">
    <input type="hidden" id="sessionEmpty" value="<?php echo (bool)$_SESSION["isEmptyPanier"];?>">
    <?php if (!empty($_SESSION['panier'])): ?>
        <div class="container-info-inventaire">
            <div class="text-decoration">Dex: <span id="Dex"><?= $dexteriter ?></span></div>

            <input type="hidden" id="maxPoids" name="maxPoids" value="20">
            <div class="text-decoration">Max: <?= maxPois ?> lbs</div>
            <div class="text-decoration">
                <img src="/public/images/sac.png"  class="bag" alt="backpack" />
                <span id="poidsTotal"><?= $poidsTotal ?></span> lbs
            </div>
        </div>
        <div class="row">
          

                <?php foreach ($_SESSION['panier'] as $key => $item): ?>

                    <div class="col">
                        <div class="mb-3">
                            <form id="x" method="post">

                                <div class="mb-3 text-decoration"> <?= $item['description'] ?></div>

                                <div class="containe-info">

                                    <input type="hidden" id="itemId" name="itemId" value="<?= $item['id'] ?? ''; ?>">

                                    <div class="mb-3"> <img src="<?= $item['lienphoto'] ?>" class="img" alt="épée">
                                    </div>

                                    <div>

                                        <label class="text-decoration" for="quantity-<?= $key ?>">Quantité :</label>
                                        <input type="number" id="quantity-<?= $key ?>" name="quantity" value="1" min="1"
                                            max="10" data-price="<?= $item['prix'] ?>">
                                    </div>
                                    <div class="text-decoration">Prix Unitaire: <?= $item['prix'] ?>$</div>

                                    <div class="content">
                                        <a href="/delete-item/?id=<?= $item['id'] ?>">
                                            <i class='bx bx-x-circle'></i>
                                        </a>
                                    </div>

                                </div>

                                <div class="mb-3 text-decoration">Poids: <span id="poids"> <?= $item['poids'] ?></span>lb</div>
                            </form>
                        </div>

                    </div>
                <?php endforeach ?>
                <!-- span: Isoler le texte du prix total pour qu'il puisse être modifié dynamiquement par JavaScript. -->

                <div class="text-decoration">Prix total:<span class="text-decoration" id="prixTotal"><?= $prixTotal ?></span>$
                </div>
                <div class="button-container">
                    <form method="post" action="/payer">

                        <button class="btn btn-success button" type="submit" name="payer">Payer</button>
                    </form>
                </div>
                <div> <a class="acceuil" href="/"> Acceuil</a></div>
            <?php else: ?>
                <div class="container-empty">
                    <div>
                        <p class="text-decoration"> Votre panier est vide </p>
                    </div>
                    <div> <a class="acceuil" href="/"> Acceuil</a></div>
                </div>
            <?php endif ?>
        </div>

    </div>

    <?php
    require "views/Partials/footer.php";
    ?>