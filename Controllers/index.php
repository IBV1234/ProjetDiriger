<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$items = $itemModel->selectAll();

$_SESSION['controller'] = 'index';

require 'views/index.php';