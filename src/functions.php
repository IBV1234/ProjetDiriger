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
//code here