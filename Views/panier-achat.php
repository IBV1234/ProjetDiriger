<?php
require "views/Partials/head.php";
require "views/Partials/header.php";
?>

<div class="container custom-container">

    <div class="row">
        <?php if (!empty($_SESSION['panier'])): ?>

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
                                    <input type="number" id="quantity-<?= $key ?>" name="quantity" value="1" min="1" max="10"
                                        data-price="<?= $item['prix'] ?>">
                                </div>
                                <!-- span: Isoler le texte du prix total pour qu'il puisse être modifié dynamiquement par JavaScript. -->
                                <div class="text-decoration">Prix total: <?=$item['prix'] ?></div>

                                <div class="content">
                                    <a href="/delete-item/?id=<?= $item['id'] ?>">
                                        <i class='bx bx-x-circle'></i>
                                    </a>
                                </div>

                            </div>
                            <div class="mb-3 text-decoration">Poids: <?= $item['poids'] ?></div>
                        </form>
                    </div>

                </div>
            <?php endforeach ?>
            <div class="text-decoration">Prix total:<span class="text-decoration" id="prixTotal"><?=$prixTotal?></span>$</div>
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