<?php
require 'src/session.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$panierModel = new PanierModel($pdo);

$items = $itemModel->selectAll();
// $panier = $panierModel->selectAll();

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'][] = [
        'id' => $items[0]->getIdItem(), 
        'nom' => $items[0]->getNom(),
        'prix' => $items[0]->getPrix(),
        'quantite' => $items[0]->getQteStock(),
        'poids' => $items[0]->getPoids()
    ];
}


require 'views/panier-achat.php';