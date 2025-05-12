<?php

require 'src/session.php';
require 'src/class/Database.php';
require 'models/ItemModel.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

sessionStart();

////////////////////////////////////////
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$PanierModel =  new PanierModel($pdo);
$userModel = new UserModel($pdo);
$user = $_SESSION['user'];
$user = $userModel->selectById($user->getId());
$_SESSION['user'] = $user;
$sumPanier = $PanierModel->SumPanier($_SESSION['user']->getId());

//$PanierModel->insert(9,  1 ,5); //  for test
$maxPoids = $_SESSION['user']->getPoidsMax();

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

//MAJ de la session
$_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());

require 'views/panier-achat.php';