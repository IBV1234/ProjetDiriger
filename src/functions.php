<?php
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getPrixTotalPayer($items)
{
    $total = 0;
   
    foreach ($items as $key => $item) {
        $total += $item['prix']*$item['quantite'];
    }
    return $total;
}

function getPrixTotal($items)
{
    $total = 0;
   
    foreach ($items as $key => $item) {
        $total += $item['prix'];
    }
    return $total;
}

function getPoidsTotal($panier)
{

    $total = 0;
   
    foreach ($panier as $key => $item) {
        $total += $item['poids']*$item['quantite'];
    }
    return $total;
}


function setSolde($PrixTotal){
$caps = (int)$_SESSION['joueur'][0]['solde'];
$solde = $caps-$PrixTotal;
$_SESSION['joueur'][0]['solde'] = $solde;

}
