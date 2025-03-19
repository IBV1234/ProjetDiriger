<?php

require 'src/session.php';
require 'src/class/Database.php';
require 'Models/ItemModel.php';


sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();

// sessionDestroy();


if (!isset($_SESSION['panier'])) {

 foreach($items as $key=>$item){

    $_SESSION['panier'][] = [

        'id' => $item->getIdItem(),
        'typeitem' => $item->getTypeItem(),
        'nom' => $item->getNom(),
        'prix' => $item->getPrix(),
        'quantite' => $item->getQteStock(),
        'poids' => $item->getPoids(),
        'lienphoto' => $item->getLienphoto(),
        'utilite' => $item->getUtilite(),
        'estDisponible' => $item->getEstDisponible(),
        'descriprion' =>$item->description()
    ];
 }

}

if (!isset($_SESSION['user'])) {

    $_SESSION['user'][] = [

        'id' => 1, 
        'alias' => 'theGood',
        'nom' => 'Deval',
        'prenom' => 'Marc',
        'courriel' => 'MarcDeval@Gmail.com',
        'pwd' => '1234',
        'isAdmin' =>0,
        'solde' => 500,
        'ptsVie' => 20
    ];

}

const maxPoids = 15;

$caps =  $_SESSION['user'][0]['solde']??0;


if(!isset($_SESSION["sessionDex"])){

    $_SESSION["sessionDex"] = 10;
}


$dexteriter = $_SESSION["sessionDex"];


if(!empty($_SESSION['panier']) ){

    $_SESSION["isEmptyPanier"] = false;
    $panier = $_SESSION['panier'];
    $prixTotal = getPrixTotal($panier);
    $poidsTotal = getPoidsTotal($panier);

}else{

    $_SESSION["isEmptyPanier"] = true;

}
require 'views/panier-achat.php';