<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';

sessionStart();

$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$items = $itemModel->selectActive();

if (!$items) {
    http_response_code(404);
}

require 'views/index.php';