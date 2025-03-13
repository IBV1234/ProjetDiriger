<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'Models/ItemModel.php';
require 'Models/panier-model.php';

sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$panierModel = new PanierModel($pdo);

$items = $itemModel->selectAll();
// $panier = $panierModel->selectAll();
// sessionDestroy();

if (!isset($_SESSION['panier'])) {// dans la page detail, on m'envoi le id de l'item
    $_SESSION['panier'][] = [
        'id' => $items[0]->getIdItem(), 
        'nom' => $items[0]->getNom(),
        'prix' => $items[0]->getPrix(),
        'quantite' => $items[0]->getQteStock(),
        'description' => $items[0]->getDescription(),
        'poids' => $items[0]->getPoids(),
        'lienphoto' => $items[0]->getLienPhoto(),
        'estDisponible' => $items[0]->getEstDisponible()
    ];
}

if(!empty($_SESSION['panier'])){
    $panier = $_SESSION['panier'];
    $prixTotal = getPrixTotal($panier);
}
require 'views/panier-achat.php';