<?php

require 'src/class/Database.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/session.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();
$item = $items[0];

require 'views/item.php';       