<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'models/PanierModel.php';
require 'models/UserModel.php';

sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();



$itemModel = new ItemModel($pdo);
$items = $itemModel->selectActive();
$sumPanier = null;
if(isset($_SESSION['user'])){
    $panierModel = new PanierModel($pdo);
    $sumPanier = $panierModel->SumPanier($_SESSION['user']->getId());
    $userModel = new UserModel($pdo);
    $_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = $panierModel->getPoidsSacDos($_SESSION['user']->getId());
}

if (!$items) {
    http_response_code(404);
}

require 'views/index.php';