<?php
require 'src/session.php';
require 'src/class/Database.php';
require 'Models/ItemModel.php';
require 'Models/panier-model.php';
require 'Models/JoueurModel.php';


sessionStart();
$db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
$pdo = $db->getPDO();
$itemModel = new ItemModel($pdo);
$panierModel = new PanierModel($pdo);
$joueurModel = new JoueurModel($pdo);
$items = $itemModel->selectAll();
$joueur = $joueurModel->selectAll();
// $panier = $panierModel->selectAll();
//  sessionDestroy();


if (!isset($_SESSION['panier'])) {
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

if (!isset($_SESSION['joueur'])) {
    $_SESSION['joueur'][] = [
        'id' => $joueur[0]->getId(), 
        'alias' => $joueur[0]->getAlias(),
        'nom' => $joueur[0]->getLastName(),
        'prenom' => $joueur[0]->getFirstName(),
        'courriel' => $joueur[0]->getEmail(),
        'pwd' => $joueur[0]->getPassword(),
        'isAdmin' => $joueur[0]->getIsAdmin(),
        'solde' => $joueur[0]->getBalance(),
        'ptsVie' => $joueur[0]->getHp()
    ];
}

const maxPoids =20;
if(!isset($_SESSION["sessionDex"])){
    $_SESSION["sessionDex"] =20;
}
$dexteriter = $_SESSION["sessionDex"];

if(!empty($_SESSION['panier']) ){
    $_SESSION["isEmptyPanier"] = false;
    $panier = $_SESSION['panier'];
    $prixTotal = getPrixTotal($panier);
    $poidsTotal = getPoidsTotal($panier);
}else{
    $_SESSION["isEmptyPanier"] = true;
}
require 'views/panier-achat.php';