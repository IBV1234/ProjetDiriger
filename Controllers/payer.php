<?php

if(isPost()){

    require 'src/session.php';
    require 'src/class/Database.php';
    require 'Models/panier-model.php';
    require 'Models/UserModel.php';

    sessionStart();

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $lePanier =  new PanierModel($pdo);
    $userModel = new UserModel($pdo);


    // Récupération des valeurs
    $maxPoids = intval($_POST['maxPoids']);
    $poids = floatval($_POST['poidsTotal']);
    $prix = floatval($_POST['prixTotal']);
    $items = $_POST['items'] ?? [];


    // $panier = $_SESSION['panier'];

    $prixTotal = getPrixTotalPayer(   $items);
    $poidsSacDos = $lePanier->getPoidsSacDos($_SESSION['user']->getId());
    $caps =  $_SESSION['user']->getBalance();
    $soldeFinal = $caps - $prixTotal;
    $userModel ->nouveauSolde( $soldeFinal ,$_SESSION['user']->getId());
    $_SESSION['user']->setSolde($soldeFinal );

        $dexterite = intval($_SESSION['user']->getDexterite());

        if ($poidsSacDos > $maxPoids) {
            $dexterite -= 1;
            $userModel->nouvelleDexterite($dexterite,$_SESSION['user']->getId());
            $_SESSION['user']->setDexterite($dexterite);
        }
    

    $lePanier->insertSacADos((int)$_SESSION['user']->getId());


    // Enregistrer la commande 
    $_SESSION['last_order'] = [
        'prixTotal' => $prixTotal,
        'poidsTotal' => $poidsTotal,
        'items' => $items
    ];
    
    $lastOrderJson = json_encode($_SESSION['last_order']);
    file_put_contents('Logs/last-order.txt', $lastOrderJson . PHP_EOL, FILE_APPEND);
    

    redirect("/panier-achat");

}else{
    redirect("/");

}

