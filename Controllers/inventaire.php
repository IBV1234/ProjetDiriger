<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/class/User.php';

$_SESSION['controller'] = 'inventaire';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$items = $itemModel->selectByInventory($_SESSION['user']->getId());

require 'views/inventaire.php';

/* NOTES PERSONELLES:
    DANS DETAILS (A FAIRE SPRINT 2)
    -   Considerer la logique d'items essentiels
    -   Ajouter des boutons comme "consommer" pour la nourriture/medicaments
    -   Ajouter un bouton supprimer
    -   Ajouter un bouton vendre
*/