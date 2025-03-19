<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/session.php';
require 'Models/panier-model.php';
require 'Models/UserModel.php';

sessionStart();

//temporary thing -- simulates puting the item in the session........
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();
$_SESSION['item'] = $items[10];
$userModel = new UserModel($pdo);
$user = $userModel->getUserByEmail("monsieurtesteur@gmail.com");
$_SESSION['user'] = $user;

//get item from index.................................................
if(!isset($_SESSION['item']))
    redirect("error");

$item = $_SESSION['item'];

//send item to cart...................................................
if(isPost()){
    $panierModel = new PanierModel($pdo);
    $panierModel->insert($_SESSION['item']->getIdItem(), 1, $_SESSION['user']->getId());
    //add popup showing success...
}

require 'views/item.php';       