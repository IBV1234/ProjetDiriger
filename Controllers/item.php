<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

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
    $panierModel->insert($item->getIdItem(), 1, $_SESSION['user']->getId());

    //MAJ de la session
    $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = $panierModel->getPoidsSacDos($_SESSION['user']->getId());

    redirect("/");
}

//MAJ de la session
if (isset($_SESSION['user'])) {
    $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());
}

require 'views/item.php';