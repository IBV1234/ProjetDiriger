<?php

require 'src/session.php';
require 'src/class/Database.php';
require 'Models/ItemModel.php';
require 'Models/panier-model.php';
require 'Models/UserModel.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();
$lePanier =  new PanierModel($pdo);

// sessionDestroy();

//  $lePanier->insert(14,  1 ,2); //  for test
const maxPoids = 15;

 $caps =  $_SESSION['user']->getBalance();


$poidsSacDos = $lePanier->getPoidsSacDos($_SESSION['user']->getId());


$dexteriter = $_SESSION['user']->getDexterite();


$panier = $itemModel->selectAllInerJoin($_SESSION['user']->getId());

$UtiliteInSac = $lePanier->UtiliteInSac($_SESSION['user']->getId());

if(!empty($panier)){

    $_SESSION["isEmptyPanier"] = false;
    $prixTotal = $lePanier->getPrixPanier($_SESSION['user']->getId());
    $poidsTotal = $lePanier->getPoidsPanier($_SESSION['user']->getId());

}else{
    
    $_SESSION["isEmptyPanier"] = true;
}

require 'views/panier-achat.php';