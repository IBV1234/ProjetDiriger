<?php if ($controllerFile == "Controllers/index.php"): ?>
  <header class="px-3 py-1 position-relative">
<?php else: ?>
  <header class="header-height px-3 py-1 position-relative">
<?php endif; ?>
    <div class="d-flex flex-column flex-sm-row flex-wrap justify-content-between align-items-center p-2 mt-2 bg-yellow-fallout rounded rounded-3">
      <a href="/" class="text-decoration-none text-yellow-fallout">
        <div class="bg-black py-2 px-3 rounded-circle">
          <h2>Knapsack</h2>
        </div>
      </a>
<!-- Disconnected only -->
<?php if(!isset($_SESSION['user'])): ?>

      <ul class="nav nav-underline p-2">
        <li class="nav-item">
          <a class="nav-link text-black fw-semibold" href="/inscription">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black fw-semibold" href="/connexion">Connexion</a>
        </li>
      </ul>

<?php endif; ?>
<!-- /Disconnected only -->
<!-- Connected only -->
<?php if(isset($_SESSION['user'])): ?>
  <?php if ($controllerFile) : ?>
      <div class="d-flex justify-content-between align-items-center flex-row">
        <a href="/panier-achat" class="text-decoration-none text-black pe-4">
          <i class="bi bi-cart-fill d-flex cart-icon" style="font-size: 35px;">
            <?php if($sumPanier)
                    if($sumPanier >= 10)
                      echo htmlTag("i", ["class" => "notification-num"], htmlTag("p", ["class" => "mt-3 notification-num-text fs-6"], "9+" . ""));
                    else
                      echo htmlTag("i", ["class" => "notification-num"], htmlTag("p", ["class" => "ps-1 mt-3 notification-num-text"], $sumPanier . "")) ?>
          </i>
        </a>
  <?php endif; ?>
        <a href="/enigma" class="text-decoration-none text-black pe-4">
          <i class="bi bi-question-circle d-flex" style="font-size: 35px;"></i>
        </a>
        <?= $_SESSION['user']->isAdmin() ?
          htmlTag("a", ["href" => "/admin", "class" => "text-decoration-none text-black pe-4"], htmlTag("img", ["src" => "public/images/admin-icon.png", "style" => "height:30px; width: 30px;"], ""))
          : "" ?>
        <div class="dropdown">
          <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <?= $_SESSION['user']->getAlias()  ?>
          </button>
          <ul class="dropdown-menu text-small" style="z-index: 1050;">
            <li><a class="dropdown-item" href="/account">Profil</a></li>
            <li><a class="dropdown-item" href="/inventaire">Sac a dos</a></li>
            <li><hr class="dropdown-divider"></li>
            <li></li>
            <li>
              <a href="/account" class="d-flex align-items-center dropdown-item">
                <img src="/public/images/caps_icon.webp" class="me-1" height="20" alt="caps">
                <?= $_SESSION["user"]->getBalance() ?>
              </a>
            </li>
            <li>
              <a href="/account" class="dropdown-item">Dex: <?= $_SESSION["user"]->getDexterite() ?></a>
            </li>
            <li>
              <a href="/inventaire" class="d-flex align-items-center dropdown-item">
                <img src="/public/images/sac.png" class="me-1" height="25" alt="sac">
                <?= $_SESSION["poidsSac"] ?> lbs
              </a>
            </li>
            <li>
              <a href="/inventaire" class="dropdown-item">Max: <?= $_SESSION["user"]->getPoidsMax() ?> lbs</a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/deconnexion">Déconnexion</a></li>
          </ul>
        </div> 
      </div>
<?php endif; ?>
<!-- /Connected only -->

    </div>
<!-- Index seulement -->
    <?php if ($controllerFile == "Controllers/index.php") : ?>
      <div class="d-flex justify-content-between align-items-center">
        <div class="row ms-3">
          <div class="col-12 col-md-auto form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="armesSwitch" value="arme">
            <label class="form-check-label" for="armesSwitch">Armes</label>
          </div>
          <div class="col-12 col-md-8 col-lg-auto form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="nourritureSwitch" value="nourriture">
            <label class="form-check-label" for="nourritureSwitch">Nourriture</label>
          </div>
          <div class="col-12 col-md-auto col-lg-6 form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="medicamentsSwitch" value="medicament">
            <label class="form-check-label" for="medicamentsSwitch">Médicaments</label>
          </div>
          <div class="col-12 col-md-8 col-lg-auto form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="armuresSwitch" value="armure">
            <label class="form-check-label" for="armuresSwitch">Armures</label>
          </div>
          <div class="col-12 col-md-auto form-check form-check-inline form-switch">
            <input class="form-check-input" type="checkbox" id="munitionsSwitch" value="munition">
            <label class="form-check-label" for="munitionsSwitch">Munitions</label>
          </div>
        </div>
        <div class="me-3 mt-2">
          <select class="form-select-sm" aria-label="Note d'évaluation" id="starSelect">
            <option selected>Nombre d'étoiles</option>
            <option value="1">1 Étoile et plus</option>
            <option value="2">2 Étoiles et plus</option>
            <option value="3">3 Étoiles et plus</option>
            <option value="4">4 Étoiles et plus</option>
            <option value="5">5 Étoiles</option>
          </select>
        </div>
      </div>
    <?php endif; ?>
<!-- /Index seulement -->
    <div class="img-nav d-none d-sm-block position-absolute top-0 start-50 translate-middle-x">
      <a href="/">
        <img src="/public/images/VaultBoy-Nav.png" class="img-fluid" alt="VaultBoy">
      </a>
    </div>
  </header>

  <main class="mx-3">
