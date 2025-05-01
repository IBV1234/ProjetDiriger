<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'src/session.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';
require 'models/CommentaireModel.php';
require 'models/historiqueAchatsModel.php';
sessionStart();

//db..................................................................
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$commentairesModel = new CommentaireModel($pdo);
$panierModel = new panierModel($pdo);
$historiqueAchatsModel = new HistoriqueAchatsModel($pdo);

//get item from index.................................................
$visibilityIconAddMessageIcon = false;
$visibilityIconDeleteMessageIcon = false;
$isInAchats = false;
$isTherUserComment = false;
if(!isset($_GET['id']))
    redirect("error");
else {
    $item = $itemModel->selectById($_GET['id']);
    if(isset($_SESSION['user']))$isInAchats = $historiqueAchatsModel->isIn($_SESSION['user']->getId(),(int)$_GET['id']);

    $comentaires = $commentairesModel->selectByItem((int)$_GET['id']);
    if(isset($_SESSION['user']))$isTherUserComment = UserComment($comentaires,$_SESSION['user']->getId());
    if(!$isInAchats && empty($comentaires)) $visibilityIconAddMessageIcon = false; $visibilityIconDeleteMessageIcon = false;
    if($isInAchats && empty($comentaires)) $visibilityIconAddMessageIcon = true; $visibilityIconDeleteMessageIcon = true;
    if($isInAchats && !empty($comentaires)) $visibilityIconAddMessageIcon = true;$visibilityIconDeleteMessageIcon = true;
    if($isInAchats && !empty($comentaires) && $isTherUserComment) $visibilityIconAddMessageIcon = false; $visibilityIconDeleteMessageIcon = true;


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