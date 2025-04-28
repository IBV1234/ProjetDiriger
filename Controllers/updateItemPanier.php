<?php
  require 'src/session.php';
  require 'src/class/Database.php';
  require 'models/UserModel.php';
  require 'models/PanierModel.php';

  if(isPost()){

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

        //MAJ de la session
        $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
        $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

         redirect("/panier-achat");
 
    }
 
  }

  //MAJ de la session
  $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
  $pdo = $db->getPDO();

  $_SESSION['user'] = (new UserModel($pdo))->selectById($_SESSION['user']->getId());
  $_SESSION['poidsSac'] = (new PanierModel($pdo))->getPoidsSacDos($_SESSION['user']->getId());

   redirect("/panier-achat");