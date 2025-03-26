<?php

require 'partials/head.php';
require 'partials/header.php';

?>

        <div class="bg-yellow-fallout rounded rounded-3 p-2">
            <div class="row">
<!-- À copier pour chaque item -->
                <?php foreach ($items as $item) : ?>
                    <div class="col-sm-6 col-md-4 col-xl-3 px-4 py-3" data-filter="<?= $item->getType()?>-<?= $item->getRating()?>">
                        <a href="/item?id=<?= $item->getId() ?>" class="text-decoration-none text-black">
                            <div class="ratio ratio-1x1">
                                <div class="d-flex flex-column justify-content-between align-items-center p-4 bg-blue-fallout rounded rounded-3">
                                    <h4 class="text-white"><?= $item->getNom() ?></h4>
                                    <img src="<?= $item->getLienPhoto() ?>" class="img-fluid" alt="placeholder">
                                    <div class="bg-dark-yellow-fallout px-2 rounded-circle" style="transform: skew(0deg, 5deg);">
                                        <div style="transform: skew(0deg, -5deg);" class="d-flex">
                                            <h2><?= $item->getPrix() ?></h2>
                                            <img src="/public/images/caps_icon.webp" alt="caps" width="30" height="30" class="mt-2 ms-1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="d-flex justify-content-center align-items-center p-2">
                            <h3 class="pe-2"><?= $item->getRating() ?></h3>
                            <div class="pb-2" data-coreui-size="lg" data-coreui-precision="0.10" data-coreui-read-only="true" data-coreui-toggle="rating" data-coreui-value="<?= $item->getRating() ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
<!-- /À copier pour chaque item -->
            </div>
        </div>

        <script src="/public/scripts/index.js"></script>

<?php require 'partials/footer.php' ?>