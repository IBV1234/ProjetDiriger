<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'Models/panier-model.php';

sessionStart();

////////////////////////////////////////
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$PanierModel =  new PanierModel($pdo);
$idJoueur = (int)$_GET['idJoueur'];

$Panier = $PanierModel->selectAllInerJoin($idJoueur);

$id = (int)$_GET['id'] ?? null;
$all = $_GET['id']?? null;

if(!empty($Panier) && is_null(($all) && $id!=null)){

    $PanierModel->deleteItemPanier($id,$idJoueur);
}
if(!empty($Panier) && !empty($all)){

    $PanierModel->deleteAllItemPanier($idJoueur);

}

redirect("/panier-achat");
