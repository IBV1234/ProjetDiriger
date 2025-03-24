<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'Models/ItemModel.php';
require 'src/class/User.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$items = $itemModel->selectByInventory($_SESSION['user']->getId());

require 'views/inventaire.php';

/* NOTES PERSONELLES:
    -   mettre une icone sac a dos a cote de la quantite
    -   mettre "votre inventaire est vide !" quand il n'y a pas d'item
    -   considerer la logique d'items essentiels dans le sac a dos
    -   ajouter des boutons comme "consommer" pour la nourriture/medicaments
    -   Ajouter un bouton supprimer
    -   Ajouter un bouton vendre
*/