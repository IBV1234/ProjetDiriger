<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/session.php';

sessionStart();

//temporary thing -- simulates puting the item in the session
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();
$itemTest = $items[10];
$_SESSION['Item'] = $itemTest;

//get item from index
if(!isset($_SESSION['Item']))
    redirect("error.php");
$item = $_SESSION['Item'];

//send item to cart
if(isPost())
    redirect("panier");

require 'views/item.php';       