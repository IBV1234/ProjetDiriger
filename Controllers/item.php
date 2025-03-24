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

/*
if(!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
}
*/

if(!isset($_SESSION['item']))
    redirect("error");
$item = $_SESSION['item'];

//send item to cart...................................................
if(isPost()){
    $panierModel = new PanierModel($pdo);
    if($panierModel->isItemInPanier($_SESSION['user']->getId(),$item->getIdItem()))
        $panierModel->insert($item->getIdItem(), 1, $_SESSION['user']->getId());
    //else
        //tell user item is already in cart
}

require 'views/item.php';       