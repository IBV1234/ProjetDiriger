<?php
require 'src/session.php';
require 'src/class/Database.php';
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
$idJoueur = (int)$_GET['idJoueur'];

$Panier = $PanierModel->selectAllInerJoin($idJoueur);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    //MAJ de la session
    $_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());
    //
    redirect("/panier-achat");
}
is_numeric($id) ? $id = (int)$id : $id = null;
$_GET['id'] == "all" ? $all = $_GET['id'] : null;

if(!empty($Panier) && $id!=null){

    $PanierModel->deleteItemPanier($id,$idJoueur);
}
if(!empty($Panier) && !empty($all)){

    $PanierModel->deleteAllItemPanier($idJoueur);

}

//MAJ de la session
$_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
$_SESSION['poidsSac'] = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());

redirect("/panier-achat");
