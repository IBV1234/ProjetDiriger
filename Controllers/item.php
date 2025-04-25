<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/PanierModel.php';
require 'models/UserModel.php';
require 'models/CommentaireModel.php';

sessionStart();

//db..................................................................
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$commentairesModel = new CommentaireModel($pdo);

//get item from index.................................................

if(!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
    $comentaires = $commentairesModel->selectByItem((int)$_GET['id']);
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
    redirect("/");
}

require 'views/item.php';