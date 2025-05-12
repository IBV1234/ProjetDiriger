<?php

require 'src/class/Database.php';
require 'src/session.php';
require 'src/class/Item.php';
require 'models/ItemModel.php';
require 'models/UserModel.php';
require 'models/PanierModel.php';

////////////////////////////////////////
sessionStart();
if (!isset($_SESSION['user'])) {
    redirect("/connexion");
}
///////////////////////////////////////

$_SESSION['controller'] = 'inventaire';
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();

$itemModel = new ItemModel($pdo);
$panierModel = new PanierModel($pdo);
$items = $itemModel->selectByInventory($_SESSION['user']->getId());
$poidsSac = $panierModel->getPoidsSacDos($_SESSION['user']->getId());
$sumPanier = $panierModel->SumPanier($_SESSION['user']->getId());

//MAJ de la session
$_SESSION['poidsSac'] = $poidsSac;
$userModel = new UserModel($pdo);
$_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());

require 'views/inventaire.php';

/* NOTES PERSONELLES:
    DANS DETAILS (A FAIRE SPRINT 2)
    -   Considerer la logique d'items essentiels
    -   Ajouter des boutons comme "consommer" pour la nourriture/medicaments
    -   Ajouter un bouton supprimer
    -   Ajouter un bouton vendre
*/