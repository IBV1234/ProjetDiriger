<header>
    <div class="container-head">
        <div class="col">
            <a href="#" style="text-decoration: none; color: black;" >
                <div class="cercle">
                    <div class="cercle-text-1">
                        ?
                    </div>
                    <div class="cercle-text-2">
                        Enigma
                    </div>
                </div>
            </a>
        </div> <!-- Ajout de mr-3 pour une marge à droite -->
        <div class="col cercle-text-2" style="font-size: 20px;"><?=$_SESSION['user']->getAlias();?></div>
            <div class="col cercle-text-2" style="font-size: 30px; "> 
                <a href="#">
                    <img src="/public/images/bars.png" alt="bars" style="width:50px; height: 50px;" />

                </a>
            </div>
        </div>
    </div>
</header>
<main class="mx-3 body-enigma">