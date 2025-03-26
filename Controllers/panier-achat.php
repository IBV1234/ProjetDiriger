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
$PanierModel =  new PanierModel($pdo);

//sessionDestroy();
//$PanierModel->insert(9,  1 ,5); //  for test
const maxPoids = 15;

 $caps =  $_SESSION['user']->getBalance();


$poidsSacDos = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());


$dexteriter = $_SESSION['user']->getDexterite();


$panier = $PanierModel->selectAllInerJoin($_SESSION['user']->getId());

$UtiliteInSac = $PanierModel->UtiliteInSac($_SESSION['user']->getId());

if(!empty($panier)){

    $_SESSION["isEmptyPanier"] = false;
    $prixTotal = $PanierModel->getPrixPanier($_SESSION['user']->getId());
    $poidsTotal = $PanierModel->getPoidsPanier($_SESSION['user']->getId());

}else{
    
    $_SESSION["isEmptyPanier"] = true;
}

require 'views/panier-achat.php';