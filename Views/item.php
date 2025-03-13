<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="row">
    <div class="col d-flex align-items-end flex-column mb-3"> <!-- header -->
        <a class="btn bg-dark-yellow-fallout    " href="/">Retour</a>
    </div>
    <div class="w-100">
        <div class="bg-blue-fallout d-flex rounded m-2"> <!-- body item container -->
            <div class="row">
                <div class="col d-flex align-items-center flex-column m-2">
                    <img src="/public/images/placeholder-16x9.png" class="img-fluid" alt="placeholder">
                </div>
                <div class="col d-flex align-items-center flex-column m-2">
                    <div> <!-- title -->
                    </div>
                    <div class="bg-light-blue-fallout m-2">
                        <p>
                            text
                        <!-- Desc and stuff -->
                        </p>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col d-flex m-2">
                    <div class="pb-2" data-coreui-size="lg" data-coreui-precision="0.10" data-coreui-read-only="true" data-coreui-toggle="rating" data-coreui-value="5"></div>
                </div>
                <div class="col d-flex align-items-center flex-column m-2">
                    <div class="flex-row bg-light-green-fallout cart-button btn">
                        <i class="bi bi-cart-check m-2"></i><a href="/panier">Ajouter au panier</a> <!-- make sure this sends the item id -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div> <!-- comment container {NOT TO DO IN SPRINT 1} -->

    </div>
</div>

<?php

require 'partials/footer.php';
?>