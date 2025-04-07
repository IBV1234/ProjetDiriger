<?php
  if(isPost()){

    require 'src/session.php';
    require 'src/class/Database.php';
    require 'Models/panier-model.php';
 
    sessionStart();
    header('Content-Type: application/json');
 
    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $PanierModel =  new PanierModel($pdo);
    // file_get_contents('php://input'):lit tout le contenu brut du corps de la requête.
    $data = json_decode(file_get_contents('php://input'), true); 
 
    if (isset($data['quantite'])) {
        $idItem = (int)$data['id'];
        $newQuantity = (int)$data['quantite'];
        $PanierModel-> UpdateQtPanier($_SESSION['user']->getId(),$newQuantity,  $idItem);
         redirect("/panier-achat");
 
    }
 
  }
   redirect("/panier-achat");



