<?php
function isPost()
{
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function getPrixTotal($panier,$Quantité=1)
{
    $total = 0;
   
    foreach ($panier as $key => $item) {
        $total += $item['prix']*$Quantité;
    }
    return $total;
}

function getPoidsTotal($panier,$Quantité=1)
{
    $total = 0;
   
    foreach ($panier as $key => $item) {
        $total += $item['poids']*$Quantité;
    }
    return $total;
}

function getQuantiy($panier){
    $quantite =0;
    foreach ($panier as $key => $item) {
        $quantite+= intval($item['quantity']); 
    }
    return $quantite;
}
//code here