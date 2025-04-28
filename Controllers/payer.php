<?php

if(isPost()){
    require 'src/session.php';
    require 'src/class/Database.php';
    require 'models/UserModel.php';
    require 'models/PanierModel.php';

    sessionStart();

    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();
    $PanierModel =  new PanierModel($pdo);
    $userModel = new UserModel($pdo);


    // Récupération des valeurs
    $maxPoids = intval($_POST['maxPoids']);
    $items = $_POST['items'] ?? [];

    $prixTotal = getPrixTotalPayer($items);
    $poidPanier = getPoidPanier($items);
    $poidsSacDos = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());
    $poidAutoriser =  $poidPanier + $poidsSacDos;

    $caps =  $_SESSION['user']->getBalance();
    $soldeFinal = $caps - $prixTotal;

    $PanierModel->insertSacADos($_SESSION['user']->getId());
    $userModel ->nouveauSolde( $soldeFinal ,$_SESSION['user']->getId());
    $_SESSION['user']->setBalance($soldeFinal);

        $dexterite = intval($_SESSION['user']->getDexterite());

        if ($poidAutoriser > $maxPoids) {
            $dexterite -= 1;
            $userModel->nouvelleDexterite($dexterite,$_SESSION['user']->getId());
            $_SESSION['user']->setDexterite($dexterite);
        }

    // Enregistrer la commande 
    $_SESSION['last_order'] = [
        'prixTotal' => $prixTotal,
        'poidsTotal' => $poidsTotal,
        'items' => $items
    ];
    
    $lastOrderJson = json_encode($_SESSION['last_order']);
    file_put_contents('Logs/last-order.txt', $lastOrderJson . PHP_EOL, FILE_APPEND);
    
    //MAJ de la session
    $_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());

    redirect("/panier-achat");

}else{
    //MAJ de la session
    require 'src/session.php';
    require 'src/class/Database.php';
    require 'models/UserModel.php';
    require 'models/PanierModel.php';

    sessionStart();
    $db = Database::getInstance(CONFIGURATIONS['database'], DB_PARAMS);
    $pdo = $db->getPDO();

    $userModel = new UserModel($pdo);
    $PanierModel =  new PanierModel($pdo);

    $_SESSION['user'] = $userModel->selectById($_SESSION['user']->getId());
    $_SESSION['poidsSac'] = $PanierModel->getPoidsSacDos($_SESSION['user']->getId());

    redirect("/");
}
