<header class="header-enigma my-2">
    <!-- logo -->
    <div class="col">
        <a href="/enigma" class="link-icon" >
            <div class="cercle">
                <div class="cercle-text-1">
                    ?
                </div>
                <div class="cercle-text-2">
                    Enigma
                </div>
            </div>
        </a>
    </div>
    <!-- alias joueur -->
    <div class="col cercle-text-2" style="font-size: 20px;">
        <?=$_SESSION['user']->getAlias();?>
    </div>
    <!-- menu -->
    <div class="dropdown col">
        <a href="#" class="d-block link-body-emphasis text-decoration-none " data-bs-toggle="dropdown" aria-expanded="false">
            <img src="/public/images/bars.png" alt="bars" style="width:50px; height: 50px;" />
        </a>
        <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="/">Knapsack</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/deconnexion">Déconnection</a></li>
        </ul>
    </div> 
</header>
<main class="mx-3">