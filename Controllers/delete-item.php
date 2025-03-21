<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'Models/panier-model.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$PanierModel =  new PanierModel($pdo);
$idJoueur = (int)$_GET['idJoueur'];
$Panier = $PanierModel->selectAllInerJoin($idJoueur);

$id = (int)$_GET['id'];
if(!empty($Panier)){
    $PanierModel->deleteItemPanier($id,$idJoueur);
}
redirect("/panier-achat");
