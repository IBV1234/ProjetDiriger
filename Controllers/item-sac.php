<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/PanierModel.php';
require 'models/UserModel.php';

sessionStart();

//db..................................................................
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$userModel = new UserModel($pdo);
$user = $_SESSION['user'];
$user = $userModel->selectById($user->getId());
$_SESSION['user'] = $user;

//get item from index.................................................

if(!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
    $items = $itemModel->selectByInventory($_SESSION['user']->getId());
    foreach ($items as $itemSac){
        if($itemSac->getIdItem() == $_GET['id']){
            $itemQt = $itemSac->getQteStock();
            break;
        }
    }
    if($itemQt == 0){
        redirect("error");
    }
    if($item == null)
        redirect("error");
    $_SESSION['item'] = $item;
}
if(!isset($_SESSION['item']))
    redirect("error");

//Eat item......................................................

if(isPost()){
    if($_POST['action'] === 'use') {
        if($_SESSION['user']->getHp() < 10){
            if (!isset($_SESSION['user']))
                redirect("/connexion");
            $userModel->useItem($_SESSION['user']->getId(), $_SESSION['item']->getIdItem());
        }
    }
    if($_POST['action'] === 'sell') {
        if (!isset($_SESSION['user']))
            redirect("/connexion");
        $userModel->sellItem($_SESSION['user']->getId(), $_SESSION['item']->getIdItem());
    }
    redirect("/inventaire");
}

require 'views/item-sac.php';