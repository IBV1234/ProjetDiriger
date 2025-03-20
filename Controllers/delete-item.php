<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'Models/ItemModel.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$panier = $itemModel->selectAllInerJoin($_SESSION['user']->getId());

$id = (int)$_GET['id'];

if(!empty($panier)){
    deleteItemSessionById($id );
}
redirect("/panier-achat");
