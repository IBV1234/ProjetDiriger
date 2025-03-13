<header class="header-height px-3 py-1 position-relative">
  <div
    class="d-flex flex-column flex-sm-row flex-wrap justify-content-between align-items-center p-2 mt-2 bg-yellow-fallout rounded rounded-3">
    <a href="/" class="text-decoration-none text-yellow-fallout">
      <div class="bg-black py-2 px-3 rounded-circle">
        <h2>Knapsack</h2>
      </div>
    </a>
    <?php if (!isset($_SESSION['joueur'])): ?>

      <ul class="nav nav-underline p-2">
        <li class="nav-item">
          <a class="nav-link text-black fw-semibold" href="/inscription">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-black fw-semibold" href="/connexion">Connexion</a>
        </li>
      </ul>
    <?php else: ?>
        
        <a class="user-img" href="#">
          <i class='bx bx-user-pin fs-1' type='solid'></i>
          <?php  echo  $_SESSION['joueur'][0]['prenom']?> <?php echo $_SESSION['joueur'][0]['nom']?>
        </a>

    <?php endif ?>
    
  </div>
  <div class="img-nav p-1 d-none d-sm-block position-absolute bottom-0 start-50 translate-middle-x">
    <a href="/">
      <img src="/public/images/VaultBoy-Nav.png" class="img-fluid" alt="VaultBoy">
    </a>
  </div>
</header>


<main
  class="<?= !empty($_SESSION['panier']) ? 'bg-yellow-fallout rounded rounded-3 p-2 mx-3 ' : 'bg-yellow-fallout rounded rounded-3 p-2 mx-3 main-panier' ?>">