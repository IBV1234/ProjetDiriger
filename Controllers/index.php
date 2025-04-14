<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/class/User.php';
require 'Models/panier-model.php';

sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$items = $itemModel->selectActive();
$sumPanier = null;
if(isset($_SESSION['user'])){
    $panierModel = new PanierModel($pdo);
    $sumPanier = $panierModel->SumPanier($_SESSION['user']->getId());
}

if (!$items) {
    http_response_code(404);
}

require 'views/index.php';