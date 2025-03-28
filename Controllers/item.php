<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/session.php';
require 'Models/panier-model.php';
require 'Models/UserModel.php';

sessionStart();

//db..................................................................
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);

//get item from index.................................................

if(!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
    $_SESSION['item'] = $item;
}
if(!isset($_SESSION['item']))
    redirect("error");

//send item to cart...................................................
if(isPost()){
    if(!isset($_SESSION['user']))
        redirect("/connexion");
    $panierModel = new PanierModel($pdo);
    if(!$panierModel->isItemInPanier($_SESSION['user']->getId(),$item->getIdItem()))
        $panierModel->insert($item->getIdItem(), 1, $_SESSION['user']->getId());
    redirect("/");
}

require 'views/item.php';