<?php
if(isPost()){

    require 'src/session.php';
    sessionStart();
    if(!empty($_SESSION['panier'])){
        PayerItemSession();
    }
    redirect("/");
}
redirect("/");

