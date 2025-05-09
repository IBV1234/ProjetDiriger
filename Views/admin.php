<?php

require 'partials/head.php';
require 'partials/header.php';

?>

<div class="bg-yellow-fallout rounded rounded-3 p-2">
            <div class="row">
<!-- À copier pour chaque user -->
                <?php if($users != null) foreach ($users as $user) : ?>
                    <div class="col-sm-6 col-md-4 col-xl-3 px-4 py-3">
                        <div class="ratio ratio-1x1">
                            <div class="d-flex flex-column justify-content-between align-items-center p-4 bg-blue-fallout rounded rounded-3">
                                <div class="d-flex flex-column align-items-center">
                                    <h3 class="text-white"><?= $user->getAlias() ?></h3>
                                    <h5 class="text-muted"><?= $user->getFirstName() . " " . $user->getLastName() ?></h5>
                                </div>
                                <img src="../public/images/img-profile.png" class="img-fluid" alt="placeholder">
                                <form method="POST">
                                    <input type="hidden" name="userId" value="<?= $user->getId() ?>">
                                    <button class="btn bg-dark-yellow-fallout px-2 rounded-3" type="submit" <?php echo $userModel->getOfferCaps($user->getId()) > 0 ? "" : "disabled" ?>>
                                        <div class="d-flex">
                                            <p class="fs-5 me-1 m-auto">Offrir <?= $userModel->getOfferCaps($user->getId()) ?></p>
                                            <img src="public/images/caps_icon.webp" class="caps-icon-index m-auto"></img>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
<!-- /À copier pour chaque user -->
                <?php if($users == null) :?>
                    <div class="pt-4 d-flex justify-content-center">
                        <p class="d-inline-block fw-semibold fs-2 bg-color-yellow-text px-2 rounded-1">Il n'y a pas de joueur !</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>





<?php require 'partials/footer.php' ?>