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
    if($item == null)
        redirect("error");
    $_SESSION['item'] = $item;
}
if(!isset($_SESSION['item']))
    redirect("error");

require 'views/item-sac.php';