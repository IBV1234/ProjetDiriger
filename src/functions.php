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

function getPoidPanier($items){
    $poids = 0;
   
    foreach ($items as $key => $item) {
        $poids += $item['poids']*$item['quantite'];
    }
    return $poids;
}