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

function getQtPanier($items){
    $quantite = 0;
   
    foreach ($items as $key => $item) {
        $quantite += $item['quantite'];
    }
    return $quantite;
}

function getItemTypeIcon($string): string{
    switch ($string){
        case "arme" :
            return "../public/images/sword-icon.png";
        case "armure" :
            return "../public/images/armor-icon.png";
        case "nourriture":
            return "../public/images/food-icon.png";
        case "munition":
            return "../public/images/munition-icon.png";
        case "medicament":
            return "../public/images/medicine-icon.png";
    }
    return "error";
}